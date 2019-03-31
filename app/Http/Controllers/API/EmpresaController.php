<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresa;
use Validator;

class EmpresaController extends Controller
{
    public $successStatus = 200;

    /** 
     * Index Empresas API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function index()
    {
        $empresas = Empresa::get();
        return response()->json(['success' => $empresas], $this->successStatus); 
    }

    /** 
     * Store Empresas API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'nome_empresa'  => 'required', 
            'cnpj'          => 'required', 
            'nome_cidade'   => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $empresa = Empresa::create($request->all());
        
        $success['nome_empresa']    =  $empresa->nome_empresa; 
        $success['cnpj']            =  $empresa->cnpj;
        $success['nome_cidade']     =  $empresa->nome_cidade;

        return response()->json(['success'=>$success], $this->successStatus); 
    }
    public function show($id)
    {
        $empresa = Empresa::where('id', $id)->get();

        if( count($empresa) == 0 ){
            $success['mensagem']    = "Error 204 - Registro não encontrado"; 
            return response()->json([], 204);
        }
        return response()->json(['success'=>$empresa], $this->successStatus); 
    }

    /** 
     * Update Empresas API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [ 
            'nome_empresa'  => 'required', 
            'cnpj'          => 'required', 
            'nome_cidade'   => 'required', 
        ]);


        $empresa = Empresa::where('id', $id)->update($request->all());
   
        $success['nome_empresa']    = $request->nome_empresa; 
        $success['cnpj']            = $request->cnpj;
        $success['nome_cidade']     = $request->nome_cidade;

        return response()->json(['success'=>$success], $this->successStatus); 
    }

    public function destroy($id)
    {
        $empresa = Empresa::destroy($id);

        $success['mensagem']    = "Registro deletado com sucesso"; 
       
        return response()->json(['success'=>$success], $this->successStatus); 
    }
}
