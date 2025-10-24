<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Motorista extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf', 
        'nascimento',
        'genero',
        'celular',
        'email',
        'usuario',
        'senha',
        'foto',
        'cnh',
        'validade_cnh',
        'modelo_veiculo',
        'placa_veiculo', 
        'ano_veiculo',
        'cor_veiculo',
        'status',
    ];

    protected $hidden = [
        'senha',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    protected $casts = [
        'nascimento' => 'date',
        'validade_cnh' => 'date',
    ];
}