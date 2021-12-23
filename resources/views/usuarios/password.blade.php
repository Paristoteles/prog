@extends('templates.base')
@section('title', 'Perfil')
@section('h1', 'Perfil')
@section('content')

<form method="post" action="{{ route('profile.savePassword') }}">
    <div class="row p-4" style="box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.34);">
        <div class="row">
            <div class="col">
                @if($erro)
                    <h3 class="text-warning">{{$erro}}</h3>
                @endif

            </div>
        </div>
        @csrf

            <div class='col'>
                <div class="row">
                    <div class='col'>
                        Senha Atual:<div class="row pt-4" ><input class="form-control" type="password" type="password" name="oldPassword"/></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    </br>
                        Nova Senha:<div class="row pt-4" ><input class="form-control" type="password" name="newPassword"/></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    </br>
                       Confirme a Senha:<div class="row pt-4" ><input class="form-control" type="password" name="newPasswordConfirm"/></div>
                </br>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-dark">Salvar</button>

    </div>
</form>
@endsection