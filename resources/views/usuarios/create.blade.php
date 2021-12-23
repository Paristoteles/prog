@extends('templates.base')
@section('title', 'Inserir Usuário')
@section('h1', 'Inserir Usuário')
@section('content')

<div class="row">
    <div class="col-4">

        <form method="post" action="{{ route('usuarios.gravar') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Usuário:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-outline-dark">Salvar</button>
            </div>
        </form>

    </div>
</div>
@endsection