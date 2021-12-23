@extends('templates.base')
@section('title', 'Editar Perfil')
@section('h1', 'Editar Perfil')
@section('content')

<div class="row">
    <div class="col">
    </div>
</div>
<form method="post" action="{{ route('profile.saveEdit') }}">
    <div class="row p-4" style="box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.34);">
        @csrf

            <div class='col'>
                <div class="row">
                    <div class='col'>
                    </br>
                       Nome:<div class="row pt-4" ><input value="{{Auth::user()->nome}}" class="form-control" type="text" name="nome"/></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    </br>
                       Email:<div class="row pt-4" ><input class="form-control" value="{{Auth::user()->email}}" type="email" name="email"/></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    </br>
                        Usuário:<div class="row pt-4" ><input class="form-control" value="{{Auth::user()->usuario}}" type="text" name="usuario" /></div>
                    </br>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-dark">Salvar</button>

    </div>
</form>
@endsection