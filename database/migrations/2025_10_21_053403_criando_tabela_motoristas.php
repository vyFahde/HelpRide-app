<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->id();
            
            // Dados Pessoais
            $table->string('nome', 100);
            $table->string('cpf', 14)->unique();
            $table->date('nascimento');
            $table->enum('genero', ['masculino', 'feminino','prefiro_nao_informar'])
                  ->default('prefiro_nao_informar');
            $table->string('celular', 15);
            $table->string('email')->unique();
            $table->string('usuario', 20)->unique();
            $table->string('senha');
            $table->string('foto')->nullable();
            
            // Dados da CNH
            $table->string('cnh', 11)->unique();
            $table->date('validade_cnh');
            
            // Dados do Veículo
            $table->string('modelo_veiculo', 50);
            $table->string('placa_veiculo', 7);
            $table->integer('ano_veiculo');
            $table->string('cor_veiculo', 20);
            
            // Status do cadastro
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('motoristas');
    }
};