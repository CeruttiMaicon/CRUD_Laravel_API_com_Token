@extends('layouts.app')

@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel API - Utilizando Token</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="jumbotron">
                    <h1 class="display-4">Olá, seja bem vindo ao projeto!</h1>
                    <p class="lead">Aqui neste link existe um CRUD onde eu utilizarei o Laravel para fazer uma API com autenticação por Token.</p>
                    <p class="lead">Para mais informações sobre o conteúdo do projeto e referências de implementação consulte o arquivo readme.md na raiz do projeto.</p>
                    <hr class="my-4">
                    <p>Clique no botão abaixo para ir para a tela de listagem.</p>
                    <a class="btn btn-primary btn-lg" href="{{route('empresa.index')}}" role="button">CRUD sem API  </a>
                    <a class="btn btn-primary btn-lg" href="{{route('empresa.index')}}" role="button">CRUD com API  </a>
                    <p class="lead">Utilizei deste tutorial para fazer o CRUD utilizando a API <a href="https://medium.com/techcompose/create-rest-api-in-laravel-with-authentication-using-passport-133a1678a876">Link</a></p>
                </div>
            </div>
           
        </div>
    </body>
@endsection
