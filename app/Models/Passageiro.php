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
        'usuario',
        'senha',
        'foto',
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
    ];
}
