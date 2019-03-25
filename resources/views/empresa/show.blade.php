@extends('layouts.app')
@section('content')
    <layout>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left pt-1">Empresa</h3>
                    <a role="button" href="{{route('empresa.index')}}" class="btn btn-primary float-right">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item active">Dados cadastrados</li>
                    <li class="list-group-item"><b>Nome empresa:</b> {{ $empresa->nome_empresa }}</li>
                    <li class="list-group-item"><b>CNPJ:</b> {{ $empresa->cnpj }}</li>
                    <li class="list-group-item"><b>Nome Cidade:</b> {{ $empresa->nome_cidade }}</li>
                </ul>
            </div>
        </div>
    </layout>
@endsection