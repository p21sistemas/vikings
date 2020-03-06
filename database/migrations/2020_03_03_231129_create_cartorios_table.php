<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartorios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cartorio_status');//0:Desativado;1:Ativo;
            $table->integer('cartorio_tipo_documento');//1:CPF;2:CNPJ;
            $table->string('cartorio_nome', 255);
            $table->string('cartorio_razao', 255);
            $table->string('cartorio_documento', 18)->unique();
            $table->string('cartorio_cep', 10);
            $table->string('cartorio_endereco', 125);
            $table->string('cartorio_bairro', 80);
            $table->string('cartorio_cidade', 125);
            $table->string('cartorio_uf', 2);
            $table->string('cartorio_telefone', 15)->nullable();
            $table->string('cartorio_email', 125)->nullable();
            $table->string('cartorio_tabeliao', 125);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartorios');
    }
}
