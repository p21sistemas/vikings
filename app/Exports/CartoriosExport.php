<?php

namespace App\Exports;

use App\Models\Cartorio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class CartoriosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{   
    public function headings(): array
    {
        return [
            'NOME',
            'RAZÃO',
            'DOCUMENTO',
            'CEP',
            'ENDEREÇO',
            'BAIRRO',
            'CIDADE',
            'UF',
            'TELEFONE',
            'E-MAIL',
            'TABELIÃO',
            'ATIVO',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cartorio::orderBy('cartorio_nome')->get();
    }   

    /**
    * @var Cartorio $cartorio
    */
    public function map($cartorio): array
    {
        return [
            $cartorio->cartorio_nome,
            $cartorio->cartorio_razao,
            "Nº" . $cartorio->cartorio_documento,
            "Nº" . $cartorio->cartorio_cep,
            $cartorio->cartorio_endereco,
            $cartorio->cartorio_bairro,
            $cartorio->cartorio_cidade,
            $cartorio->cartorio_uf,
            $cartorio->cartorio_telefone,
            $cartorio->cartorio_email,
            $cartorio->cartorio_tabeliao,
            ($cartorio->cartorio_status != "") ? "SIM" : "NÃO",
        ];
    }
}
