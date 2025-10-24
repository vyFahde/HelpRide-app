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
        Validator::extend('formato_cpf', function ($attribute, $value, $parameters, $validator) {
            $cpf = preg_replace('/[^0-9]/', '', $value);
            
            return strlen($cpf) === 11;
        });

        Validator::extend('formato_celular', function ($attribute, $value, $parameters, $validator) {
            $numero = preg_replace('/[^0-9]/', '', $value);
            
            return in_array(strlen($numero), [10, 11]);
        });

        Validator::replacer('formato_cpf', function ($message, $attribute, $rule, $parameters) {
            return "O campo {$attribute} deve conter 11 dígitos.";
        });

        Validator::replacer('formato_celular', function ($message, $attribute, $rule, $parameters) {
            return "O campo {$attribute} deve conter 10 ou 11 dígitos.";
        });
    }
}