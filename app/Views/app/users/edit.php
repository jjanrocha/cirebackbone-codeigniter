@extends('layouts.basico')
@section('title', $title)

@section('content')

@include('layouts.sidebar')

<!-- Conteúdo -->
<div class="main" id="pagina">

    <div class="container">

        <div id="users-header">
            <h4>Editar usuário</h4>
            <hr>
        </div>

        <div class="mb-3">
            <a type="button" href="{{route('usuarios.show', ['user' => $user->id])}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <form action="{{route('usuarios.update', ['user' => $user->id])}}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="nome" class="col-sm-1 col-form-label">Nome:</label>
                <div class="col-sm-6">
                    <input type="text" name="nome" id="nome" value="{{ old('nome') ?? $user->nome}}" class="form-control">
                    {{ $errors->has('nome') ? $errors->first('nome') : ''}}
                </div>
            </div>

            <div class="form-group row">
                <label for="id" class="col-sm-1 col-form-label">RE:</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" value="{{$user->id}}" class="form-control" readonly>
                    {{ $errors->has('id') ? $errors->first('id') : ''}}
                </div>
            </div>

            <div class="form-group row">
                <label for="nivel" class="col-sm-1 col-form-label">Nível:</label>
                <div class="col-sm-6">
                    <select type="text" name="nivel" id="nivel" class="form-control">
                        @if($user->nivel == 'ANALISTA')
                        <option value="ANALISTA" {{ old('nivel') == 'ANALISTA' ? 'selected' : '' }}>Analista</option>
                        <option value="ADMINISTRADOR" {{ old('nivel') == 'ADMINISTRADOR' ? 'selected' : '' }}>Administrador</option>
                        @elseif($user->nivel == 'ADMINISTRADOR')
                        <option value="ADMINISTRADOR" {{ old('nivel') == 'ADMINISTRADOR' ? 'selected' : '' }}>Administrador</option>
                        <option value="ANALISTA" {{ old('nivel') == 'ANALISTA' ? 'selected' : '' }}>Analista</option>
                        @endif
                    </select>
                    {{ $errors->has('nivel') ? $errors->first('nivel') : ''}}
                </div>
            </div>

            <button type="submit" id="btnEnviar" class="btn btn-success my-1"><i class="far fa-save"></i> Salvar</button>

        </form>

    </div>
</div>


@include('layouts.footer')

@endsection
