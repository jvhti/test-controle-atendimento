<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/bootstrap.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/customStyle.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d1c9253bbc.js" crossorigin="anonymous"></script>

    <title>Title</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h1>
        <a class="navbar-brand" href="{{ url('/') }}">
            <img alt="Loja Virtual" height="42px" loading="lazy" src="{{ asset('img/logo.png') }}">
        </a>
    </h1>
    <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
            class="navbar-toggler"
            data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(atual)</span></a>
            </li>
            <li class="nav-item {{ Request::is('gerenciarFuncionario') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gerenciarFuncionario') }}">Gerenciar Funcionarios</a>
            </li>
            <li class="nav-item {{ Request::is('simular') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('simular') }}">Simular</a>
            </li>
        </ul>
    </div>
</nav>

<main id="content">
    @yield('content')
</main>

<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>
