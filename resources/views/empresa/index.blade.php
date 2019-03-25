@extends('layouts.app')
@section('content')
    <layout>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left pt-1">Empresas</h3>
                    <a role="button" href="{{route('empresa.create')}}" class="btn btn-primary float-right">Cadastrar</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 0;
                        @endphp
                        @foreach ($empresas as $empresa)
                            <tr>
                                <th scope="row">{{ ++$n }}</th>
                                <td>{{$empresa->nome_empresa}}</td>
                                <td>{{$empresa->cnpj}}</td>
                                <td>{{$empresa->nome_cidade}}</td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" href="{{route('empresa.show', $empresa->id)}}"> Visualizar </a>
                                    <a class="btn btn-sm btn-primary" href="{{route('empresa.edit', $empresa)}}">Editar</a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['empresa.destroy', $empresa->id], 'id'=>'confirm_delete', 'style'=>'display:inline']) }}
                                    {{ Form::submit('Deletar', ['class' => 'btn btn-sm btn-danger']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </layout>
@endsection