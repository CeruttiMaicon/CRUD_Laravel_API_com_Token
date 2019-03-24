@extends('layouts.app')

@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel API - Utilizando Token</title>

        <!-- Fonts -->
      

        <!-- Styles -->
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="jumbotron">
                    <h1 class="display-4">Olá, seja bem vindo ao projeto!</h1>
                    <p class="lead">Aqui neste link existe um CRUD onde eu utilizarei o Laravel para fazer uma API com autenticação por Token.</p>
                    <hr class="my-4">
                    <p>Clique no botão abaixo para ir para a tela de listagem.</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">CRUD</a>
                </div>
            </div>
        </div>
    </body>
@endsection
