<?php

namespace App\Http\Requests\Concerns;

trait ValidatesCpfCnpj
{
    protected function onlyDigits(?string $value): string
    {
        return preg_replace('/\D/', '', (string) $value);
    }

    protected function isValidCpf(string $cpf): bool
    {
        $cpf = $this->onlyDigits($cpf);

        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += ((int) $cpf[$c]) * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;

            if ((int) $cpf[$c] !== $d) {
                return false;
            }
        }

        return true;
    }

    protected function isValidCnpj(string $cnpj): bool
    {
        $cnpj = $this->onlyDigits($cnpj);

        if (strlen($cnpj) !== 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        $weights1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $weights2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += ((int) $cnpj[$i]) * $weights1[$i];
        }
        $rest = $sum % 11;
        $digit1 = $rest < 2 ? 0 : 11 - $rest;

        if ((int) $cnpj[12] !== $digit1) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 13; $i++) {
            $sum += ((int) $cnpj[$i]) * $weights2[$i];
        }
        $rest = $sum % 11;
        $digit2 = $rest < 2 ? 0 : 11 - $rest;

        return (int) $cnpj[13] === $digit2;
    }
}
