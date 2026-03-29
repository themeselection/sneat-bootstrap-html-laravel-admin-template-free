<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Validator;

class ImportVendasLegadoPdfRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'arquivos' => ['nullable', 'array'],
            'arquivos.*' => ['nullable', 'file', 'max:10240'],
            'pasta_arquivos' => ['nullable', 'array'],
            'pasta_arquivos.*' => ['nullable', 'file', 'max:10240'],
            'caminho_pasta' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $todosArquivos = $this->flattenFiles([
                $this->file('arquivos', []),
                $this->file('pasta_arquivos', []),
            ]);

            $pdfs = array_filter($todosArquivos, function ($arquivo): bool {
                if (!$arquivo) {
                    return false;
                }

                $mime = (string) $arquivo->getMimeType();
                $ext = strtolower((string) $arquivo->getClientOriginalExtension());

                return $mime === 'application/pdf' || $ext === 'pdf';
            });

            $caminhoPasta = trim((string) $this->input('caminho_pasta'));
            $temCaminhoPasta = $caminhoPasta !== '';

            if ($temCaminhoPasta && !is_dir($caminhoPasta)) {
                $validator->errors()->add('caminho_pasta', 'Pasta local nao encontrada.');
            }

            if ($temCaminhoPasta && is_dir($caminhoPasta) && !$this->pastaContemPdf($caminhoPasta)) {
                $validator->errors()->add('caminho_pasta', 'A pasta informada nao possui arquivos PDF.');
            }

            if (count($pdfs) === 0 && !$temCaminhoPasta) {
                $validator->errors()->add('arquivos', 'Selecione ao menos um arquivo PDF valido para importacao.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'arquivos.*.max' => 'Cada arquivo deve ter no maximo 10MB.',
            'pasta_arquivos.*.max' => 'Cada arquivo deve ter no maximo 10MB.',
        ];
    }

    private function flattenFiles(array $files): array
    {
        $flat = Arr::flatten($files);

        return array_values(array_filter($flat, fn ($file) => is_object($file)));
    }

    private function pastaContemPdf(string $path): bool
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && strtolower((string) $fileInfo->getExtension()) === 'pdf') {
                return true;
            }
        }

        return false;
    }
}
