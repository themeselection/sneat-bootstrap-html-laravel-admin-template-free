<?php

namespace App\Services\Comercial;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use RuntimeException;
use Smalot\PdfParser\Parser;

class LegacyVendaPdfParser
{
    /**
     * @return array{
     *   numero_externo:string|null,
     *   data_emissao:string,
     *   cliente_nome:string,
     *   cliente_cpf_cnpj:string|null,
     *   operador_nome:string|null,
     *   subtotal:float,
     *   desconto:float,
     *   total:float,
     *   forma_pagamento:string|null,
     *   itens:array<int,array{nome:string,ean:string|null,quantidade:float,unidade:string,preco_unitario:float,subtotal:float}>,
     *   texto:string
     * }
     */
    public function parse(UploadedFile $arquivo): array
    {
        $pdf = (new Parser())->parseFile($arquivo->getRealPath());
        $texto = preg_replace('/[ \t]+/', ' ', str_replace("\r", '', $pdf->getText() ?? ''));
        $texto = preg_replace('/\n{2,}/', "\n", trim((string) $texto));

        if ($texto === '') {
            throw new RuntimeException('Nao foi possivel extrair texto do PDF.');
        }

        $linhas = array_values(array_filter(array_map('trim', explode("\n", $texto)), fn ($l) => $l !== ''));

        $dataEmissao = $this->extractDataEmissao($texto);
        $numeroExterno = $this->extractNumeroExterno($texto);
        $clienteNome = $this->extractByRegex($texto, '/Cliente:\s*(.+)/i');
        $clienteDoc = $this->onlyDigits($this->extractByRegex($texto, '/CPF\/?CNPJ:\s*([0-9\.\/-]+)/i'));
        $operador = $this->extractByRegex($texto, '/Operador:\s*([^\(\n]+)/i');

        if (!$clienteNome) {
            throw new RuntimeException('Cliente nao identificado no PDF.');
        }

        [$itens, $subtotal, $desconto, $total, $formaPagamento] = $this->extractItensETotais($linhas, $texto);

        if (count($itens) === 0) {
            throw new RuntimeException('Nenhum item foi identificado no PDF.');
        }

        return [
            'numero_externo' => $numeroExterno,
            'data_emissao' => $dataEmissao,
            'cliente_nome' => $clienteNome,
            'cliente_cpf_cnpj' => $clienteDoc ?: null,
            'operador_nome' => $operador ?: null,
            'subtotal' => $subtotal,
            'desconto' => $desconto,
            'total' => $total,
            'forma_pagamento' => $formaPagamento,
            'itens' => $itens,
            'texto' => $texto,
        ];
    }

    private function extractDataEmissao(string $texto): string
    {
        if (preg_match('/(\d{2}\/\d{2}\/\d{4})\s+(?:às|as)\s+(\d{2})h(\d{2})m/i', $texto, $m)) {
            return Carbon::createFromFormat('d/m/Y H:i', "{$m[1]} {$m[2]}:{$m[3]}", 'America/Sao_Paulo')
                ->setTimezone(config('app.timezone'))
                ->format('Y-m-d H:i:s');
        }

        return now()->format('Y-m-d H:i:s');
    }

    private function extractNumeroExterno(string $texto): ?string
    {
        $numero = $this->extractByRegex($texto, '/N\.:\s*([^\n\r-]+(?:-[^\n\r]+)?)\s*-\s*\d{2}\/\d{2}\/\d{4}/i');
        if ($numero) {
            return trim($numero);
        }

        $prevenda = $this->extractByRegex($texto, '/PREVENDA\s+ID\/PDV:\s*([^\n\r]+)/i');
        return $prevenda ? trim($prevenda) : null;
    }

    private function extractByRegex(string $texto, string $regex): ?string
    {
        return preg_match($regex, $texto, $m) ? trim((string) ($m[1] ?? '')) : null;
    }

    /**
     * @return array{0:array<int,array{nome:string,ean:string|null,quantidade:float,unidade:string,preco_unitario:float,subtotal:float}>,1:float,2:float,3:float,4:string|null}
     */
    private function extractItensETotais(array $linhas, string $texto): array
    {
        $inicio = null;
        foreach ($linhas as $i => $linha) {
            if (stripos($linha, 'Produto Qtd Valor Unit Sub-Total') !== false) {
                $inicio = $i + 1;
                break;
            }
        }

        if ($inicio === null) {
            throw new RuntimeException('Secao de itens nao encontrada no PDF.');
        }

        $itens = [];
        $atual = null;

        for ($i = $inicio; $i < count($linhas); $i++) {
            $linha = trim($linhas[$i]);

            if (preg_match('/^Sub\s*Total\s+/i', $linha)) {
                break;
            }

            if (preg_match('/^\d+\s*-\s*(.+)$/', $linha, $m)) {
                if ($atual && isset($atual['quantidade'])) {
                    $itens[] = $atual;
                }

                $atual = [
                    'nome' => trim($m[1]),
                    'ean' => null,
                ];
                continue;
            }

            if (!$atual) {
                continue;
            }

            if (preg_match('/^EAN:\s*([^\s]+)$/i', $linha, $m)) {
                $atual['ean'] = $this->onlyDigits($m[1]);
                continue;
            }

            if (preg_match('/^(\d+(?:[\.,]\d+)?)\s+([A-Za-z]+)\s+(\d+[\.,]\d+)\s+(\d+[\.,]\d+)$/', $linha, $m)) {
                $atual['quantidade'] = $this->toQuantidade($m[1]);
                $atual['unidade'] = strtoupper($m[2]);
                $atual['preco_unitario'] = $this->toFloat($m[3]);
                $atual['subtotal'] = $this->toFloat($m[4]);
                continue;
            }
        }

        if ($atual && isset($atual['quantidade'])) {
            $itens[] = $atual;
        }

        $subtotal = $this->toFloat($this->extractByRegex($texto, '/Sub\s*Total\s+([0-9\.,]+)/i') ?? '0');
        $desconto = $this->toFloat($this->extractByRegex($texto, '/Desconto\s*R\$\s*([0-9\.,]+)/i') ?? '0');
        $total = $this->toFloat($this->extractByRegex($texto, '/Total\s*R\$\s*([0-9\.,]+)/i') ?? '0');
        $forma = $this->extractByRegex($texto, '/Pagamento\(s\)\s*=>\s*([A-Za-z0-9\s\-\.]+)R\$/i');

        return [$itens, $subtotal, $desconto, $total, $forma ? trim($forma) : null];
    }

    private function toFloat(string $valor): float
    {
        $valor = trim($valor);

        if (str_contains($valor, ',')) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
            return (float) $valor;
        }

        if (substr_count($valor, '.') > 1) {
            return (float) str_replace('.', '', $valor);
        }

        return (float) $valor;
    }

    private function toQuantidade(string $valor): float
    {
        $valor = trim($valor);

        if (!str_contains($valor, ',') && preg_match('/^\d+\.\d{3}$/', $valor)) {
            return (float) $valor;
        }

        return $this->toFloat($valor);
    }

    private function onlyDigits(?string $value): string
    {
        return preg_replace('/\D/', '', (string) $value) ?: '';
    }
}
