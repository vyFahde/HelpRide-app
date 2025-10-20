<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Validação customizada para CPF
        Validator::extend('formato_cpf', function ($attribute, $value, $parameters, $validator) {
            // Remove caracteres não numéricos
            $cpf = preg_replace('/[^0-9]/', '', $value);
            
            // Verifica se tem 11 dígitos
            return strlen($cpf) === 11;
        });

        // Validação customizada para Celular
        Validator::extend('formato_celular', function ($attribute, $value, $parameters, $validator) {
            // Remove caracteres não numéricos
            $numero = preg_replace('/[^0-9]/', '', $value);
            
            // Celular deve ter 10 ou 11 dígitos (com DDD)
            return in_array(strlen($numero), [10, 11]);
        });

        // Mensagens personalizadas
        Validator::replacer('formato_cpf', function ($message, $attribute, $rule, $parameters) {
            return "O campo {$attribute} deve conter 11 dígitos.";
        });

        Validator::replacer('formato_celular', function ($message, $attribute, $rule, $parameters) {
            return "O campo {$attribute} deve conter 10 ou 11 dígitos.";
        });
    }
}