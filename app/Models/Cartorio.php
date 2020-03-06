<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartorio extends Model
{
    protected $fillable = [
      'cartorio_status',
      'cartorio_tipo_documento',
      'cartorio_nome',
      'cartorio_razao',
      'cartorio_documento',
      'cartorio_cep',
      'cartorio_endereco',
      'cartorio_bairro',
      'cartorio_cidade',
      'cartorio_uf',
      'cartorio_telefone',
      'cartorio_email',
      'cartorio_tabeliao'
    ];
}
