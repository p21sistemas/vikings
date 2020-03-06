<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartorio;
use App\Exports\CartoriosExport;
use Maatwebsite\Excel\Facades\Excel;

class CartorioController extends Controller
{
    const MESSAGES_ERRORS = [
        'cartorio_status.required' => 'O Status precisa ser informado. Por favor, '
        . 'você pode verificar isso?',

        'cartorio_nome.required' => 'O Nome precisa ser informado. Por favor, '
        . 'você pode verificar isso?',
        'cartorio_nome.max' => 'Ops, o Nome não precisa ter mais que 255 caracteres. '
        . 'Por favor, você pode verificar isso?',

        'cartorio_razao.required' => 'A Razão precisa ser informado. Por favor, '
        . 'você pode verificar isso?',
        'cartorio_razao.max' => 'Ops, a Razão não precisa ter mais que 255 caracteres. '
        . 'Por favor, você pode verificar isso?',

        'cartorio_tipo_documento.required' => 'O Tipo do Documento precisa ser informado. Por favor, '
        . 'você pode verificar isso?',

        'cartorio_documento.required' => 'O Documento precisa ser informado. Por favor, '
        . 'você pode verificar isso?',

        'cartorio_cep.required' => 'O CEP precisa ser informado. Por favor, '
            . 'você pode verificar isso?',
        'cartorio_cep.max' => 'Ops, o CEP não precisa ter mais que 10 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'cartorio_endereco.required' => 'O Endereço precisa ser informado. Por favor, '
            . 'você pode verificar isso?',
        'cartorio_endereco.max' => 'Ops, o Endereço não precisa ter mais que 125 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'cartorio_bairro.required' => 'O Bairro precisa ser informado. Por favor, '
            . 'você pode verificar isso?',
        'cartorio_bairro.max' => 'Ops, o Bairro não precisa ter mais que 80 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'cartorio_cidade.required' => 'A Cidade precisa ser informado. Por favor, '
            . 'você pode verificar isso?',
        'cartorio_cidade.max' => 'Ops, a Cidade não precisa ter mais que 125 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'cartorio_uf.required' => 'A UF precisa ser informado. Por favor, '
            . 'você pode verificar isso?',
        'cartorio_uf.max' => 'Ops, a UF não precisa ter mais que 2 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'cartorio_telefone.max' => 'Ops, o Telefone não precisa ter mais que 15 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'cartorio_email.max' => 'Ops, o Email não precisa ter mais que 120 caracteres. '
        . 'Por favor, você pode verificar isso?',
        'cartorio_email.email' => 'Ops, E-mail precisa ser um endereço de e-mail válido. Por favor, '
            . 'você pode verificar isso?',

        'cartorio_tabeliao.required' => 'O Tabelião precisa ser informado. Por favor, '
        . 'você pode verificar isso?',
        'cartorio_tabeliao.max' => 'Ops, o Tabelião não precisa ter mais que 125 caracteres. '
        . 'Por favor, você pode verificar isso?',

        'userfile.required' => 'O arquivo XML precisa ser informado. Por favor, '
        . 'você pode verificar isso?',

    ];
    const MESSAGE_ADD_SUCCESS = "Cartório adicionado com sucesso!";
    const MESSAGE_UPDATE_SUCCESS = "Cartório alterado com sucesso!";
    const MESSAGE_DESTROY_SUCCESS = "Cartório removido com sucesso!";
    const MESSAGE_IMPORT_SUCCESS = "Dados dos Cartórios importados com sucesso!";
    const MESSAGE_EXPORT_SUCCESS = "Dados dos Cartórios exportados com sucesso!";
    const STATUS_CARTORIO = [
        ["id" => 0, "nome" => "NÃO"],
        ["id" => 1, "nome" => "SIM"]
    ];
    const TIPOS_DOCUMENTOS = [
        ["id" => 1, "nome" => "CPF"],
        ["id" => 2, "nome" => "CNPJ"]
    ];
    const UFS = [
        ["sigla" => "AC"],
        ["sigla" => "AL"],
        ["sigla" => "AP"],
        ["sigla" => "AM"],
        ["sigla" => "BA"],
        ["sigla" => "CE"],
        ["sigla" => "DF"],
        ["sigla" => "ES"],
        ["sigla" => "GO"],
        ["sigla" => "MA"],
        ["sigla" => "MG"],
        ["sigla" => "MT"],
        ["sigla" => "MS"],
        ["sigla" => "PA"],
        ["sigla" => "PB"],
        ["sigla" => "PR"],
        ["sigla" => "PE"],
        ["sigla" => "PI"],
        ["sigla" => "RJ"],
        ["sigla" => "RN"],
        ["sigla" => "RS"],
        ["sigla" => "RO"],
        ["sigla" => "RR"],
        ["sigla" => "SC"],
        ["sigla" => "SP"],
        ["sigla" => "SE"],
        ["sigla" => "TO"]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartorios = Cartorio::orderBy('cartorio_nome')->paginate(25);

        return view('cartorios.index', compact('cartorios'));
    }

    /**
     * Search a resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $data = $request->except('_token');
        $data['name_email_psq'] = isset($data['name_email_psq']) ? $data['name_email_psq'] : '';
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : 25;
        $cartorios = $this->getcartorios($data);
        return view('cartorios.index', compact('cartorios', 'data'));
    }

    /**
     * Get cartorio list.
     *
     * @param Array $data
     * @return void
     */
    private function getcartorios(Array $data = null)
    {
        return Cartorio::where(function ($query) use ($data) {
                if (isset($data['name_email_psq'])) {
                    $query->where('cartorio_nome', 'LIKE', "%" . $data['name_email_psq'] . "%");
                    $query->orWhere('cartorio_documento', 'LIKE', "%" . $data['name_email_psq'] . "%");
                    $query->orWhere('cartorio_email', 'LIKE', "%" . $data['name_email_psq'] . "%");
                }
            })->orderBy('cartorio_nome')->paginate($data['totalPage']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statusCartorio = self::STATUS_CARTORIO;
        $tiposDocumentos = self::TIPOS_DOCUMENTOS;
        $ufs = self::UFS;
        return view('cartorios.create', compact('statusCartorio', 'tiposDocumentos', 'ufs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'cartorio_status'=>'required',
                'cartorio_nome'=>'required|max:125',
                'cartorio_razao'=>'required|max:255',
                'cartorio_tipo_documento'=>'required',
                'cartorio_documento'=>'required|unique:cartorios',
                'cartorio_cep'=>'required|max:10',
                'cartorio_endereco'=>'required|max:125',
                'cartorio_bairro'=> 'required|max:80',
                'cartorio_cidade'=> 'required|max:125',
                'cartorio_uf'=> 'required|max:2',
                'cartorio_telefone'=> 'nullable|max:15',
                'cartorio_email'=> 'nullable|email|max:125',
                'cartorio_tabeliao'=> 'required|max:125'
            ], self::MESSAGES_ERRORS);
            
        $cartorio = new Cartorio([
                'cartorio_status' => $request->cartorio_status,
                'cartorio_nome' => $request->cartorio_nome,
                'cartorio_razao' => $request->cartorio_razao,
                'cartorio_tipo_documento' => $request->cartorio_tipo_documento,
                'cartorio_documento' => $request->cartorio_documento,
                'cartorio_cep' => $request->cartorio_cep,
                'cartorio_endereco' => $request->cartorio_endereco,
                'cartorio_bairro' => $request->cartorio_bairro,
                'cartorio_cidade' => $request->cartorio_cidade,
                'cartorio_uf' => $request->cartorio_uf,
                'cartorio_telefone' => $request->cartorio_telefone,
                'cartorio_email' => $request->cartorio_email,
                'cartorio_tabeliao'=> $request->cartorio_tabeliao
            ]);
        $cartorio->save();
        return redirect('/cartorios')->with('success', self::MESSAGE_ADD_SUCCESS);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartorio = Cartorio::find($id);
        $statusCartorio = self::STATUS_CARTORIO;
        $tiposDocumentos = self::TIPOS_DOCUMENTOS;
        $ufs = self::UFS;
        return view('cartorios.edit', compact('cartorio', 'statusCartorio', 'tiposDocumentos', 'ufs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cartorio_status'=>'required',
            'cartorio_nome'=>'required|max:125',
            'cartorio_razao'=>'required|max:255',
            'cartorio_tipo_documento'=>'required',
            'cartorio_documento'=>'required|unique:cartorios,cartorio_documento,' . $id,
            'cartorio_cep'=>'required|max:10',
            'cartorio_endereco'=>'required|max:125',
            'cartorio_bairro'=> 'required|max:80',
            'cartorio_cidade'=> 'required|max:125',
            'cartorio_uf'=> 'required|max:2',
            'cartorio_telefone'=> 'nullable|max:15',
            'cartorio_email'=> 'nullable|email|max:125',
            'cartorio_tabeliao'=> 'required|max:125'
        ], self::MESSAGES_ERRORS);

        $cartorio = Cartorio::find($id);
        $cartorio->cartorio_status = $request->cartorio_status;
        $cartorio->cartorio_nome = $request->cartorio_nome;
        $cartorio->cartorio_razao = $request->cartorio_razao;
        $cartorio->cartorio_tipo_documento = $request->cartorio_tipo_documento;
        $cartorio->cartorio_documento = $request->cartorio_documento;
        $cartorio->cartorio_cep = $request->cartorio_cep;
        $cartorio->cartorio_endereco = $request->cartorio_endereco;
        $cartorio->cartorio_bairro = $request->cartorio_bairro;
        $cartorio->cartorio_cidade = $request->cartorio_cidade;
        $cartorio->cartorio_uf = $request->cartorio_uf;
        $cartorio->cartorio_telefone = $request->cartorio_telefone;
        $cartorio->cartorio_email = $request->cartorio_email;
        $cartorio->cartorio_tabeliao = $request->cartorio_tabeliao;
        $cartorio->save();
  
        return redirect('/cartorios')->with('success', self::MESSAGE_UPDATE_SUCCESS);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartorio = Cartorio::find($id);
        $cartorio->delete();
   
        return redirect('/cartorios')->with('success', self::MESSAGE_DESTROY_SUCCESS);
    }

    public function importDataXML(Request $request) 
    {
        $request->validate([
            'userfile'=>'required',
        ], self::MESSAGES_ERRORS);
        
        $nameFile = null;
        if ($request->hasFile('userfile') && $request->file('userfile')->isValid()) {
            
            $name = "Cartorios";
            $extension = "xml";
            $nameFile = "{$name}.{$extension}";
            $upload = $request->userfile->storeAs('cartorios', $nameFile);
            if (!$upload) {
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            }
    
        }

        $url = str_replace("public", "", $_SERVER['DOCUMENT_ROOT']) . "storage/app/public/cartorios/" . $nameFile;
        $xml = simplexml_load_file($url);

        $cartorios = Cartorio::all();
        if (count($cartorios) == 0) {
            foreach($xml as $registro):
                $this->insertGenericCartorioXML($registro);
            endforeach;
        } else {
            foreach($xml as $registro):
                $cartorio = Cartorio::where('cartorio_documento', $registro->documento)->get();
                if (count($cartorio) == 0) {
                    $this->insertGenericCartorioXML($registro);
                } else {
                    $this->updateGenericCartocioXML($registro, $cartorio[0]['id']);
                }
            endforeach;
        }
        
        return redirect('/cartorios')->with('success', self::MESSAGE_IMPORT_SUCCESS);
    }

    private function insertGenericCartorioXML($registro) 
    {
        $cartorio = new Cartorio([
            'cartorio_status' => $registro->ativo,
            'cartorio_nome' => $registro->nome,
            'cartorio_razao' => $registro->razao,
            'cartorio_tipo_documento' => $registro->tipo_documento,
            'cartorio_documento' => $registro->documento,
            'cartorio_cep' => $registro->cep,
            'cartorio_endereco' => $registro->endereco,
            'cartorio_bairro' => $registro->bairro,
            'cartorio_cidade' => $registro->cidade,
            'cartorio_uf' => $registro->uf,
            'cartorio_tabeliao'=> $registro->tabeliao
        ]);
        return $cartorio->save();
    }

    private function updateGenericCartocioXML($registro, $id)
    {
        $cartorio = Cartorio::find($id);
        $cartorio->cartorio_status = $registro->ativo;
        $cartorio->cartorio_nome = $registro->nome;
        $cartorio->cartorio_razao = $registro->razao;
        $cartorio->cartorio_tipo_documento = $registro->tipo_documento;
        $cartorio->cartorio_documento = $registro->documento;
        $cartorio->cartorio_cep = $registro->cep;
        $cartorio->cartorio_endereco = $registro->endereco;
        $cartorio->cartorio_bairro = $registro->bairro;
        $cartorio->cartorio_cidade = $registro->cidade;
        $cartorio->cartorio_uf = $registro->uf;
        $cartorio->cartorio_tabeliao = $registro->tabeliao;
        return $cartorio->save();
    }

    public function exportDataExcel(Request $request) 
    {
        return Excel::download(new CartoriosExport, 'cartorios.xlsx');
    }

}
