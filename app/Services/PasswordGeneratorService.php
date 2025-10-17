<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PasswordGeneratorService
{

    /**
     * Gera palavra-passe usando Laravel + símbolos
     */
    public static function generate(int $tamanho = 14): string
    {
        try {
            $base = Str::random($tamanho - 2);
            $simbolos = '!@#$%^&*';
            $base .= $simbolos[random_int(0, strlen($simbolos) - 1)];
            $base .= random_int(0, 9);

            return str_shuffle($base);
        } catch (\Throwable $th) {
            Log::error('errors', [
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);

            return '';
        }
    }
}
