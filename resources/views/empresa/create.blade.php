@extends('layouts.app')
@section('content')
    <layout>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left pt-1">Cadastrar Empresa</h3>
                    <a role="button" href="{{route('empresa.index')}}" class="btn btn-primary float-right">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                {{ Form::open(array('route' => 'empresa.store','method'=>'POST', 'files'=> true)) }}
                @include('empresa.form')
                {{ Form::submit('Cadastrar', array('class' => 'btn btn-primary')) }} Campos obrigatórios marcados com (*)
                {{ Form::close() }}
            </div>
        </div>
    </layout>
@endsection