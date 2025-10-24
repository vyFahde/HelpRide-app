<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Passageiro extends Authenticatable
{
    use HasFactory;

    protected $table = 'passageiros';

    protected $fillable = [
        'nome',
        'cpf',
        'nascimento',
        'genero',
        'celular',
        'email',
        'senha',
        'foto',
        'status',
    ];

    protected $hidden = [
        'senha',
    ];

    protected $casts = [
        'nascimento' => 'date',
    ];
}
