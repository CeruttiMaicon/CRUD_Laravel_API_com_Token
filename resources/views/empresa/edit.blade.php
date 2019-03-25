@extends('layouts.app')
@section('content')
    <layout>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left pt-1">Editar Empresa</h3>
                    <a role="button" href="{{route('empresa.index')}}" class="btn btn-primary float-right">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                {{ Form::model($empresa, ['method' => 'PATCH','route' => ['empresa.update', $empresa->id, $empresa]]) }}
                @include('empresa.form')
                {{ Form::submit('Editar', array('class' => 'btn btn-primary')) }} Campos obrigatórios marcados com (*)
                {{ Form::close() }}
            </div>
        </div>
    </layout>
@endsection