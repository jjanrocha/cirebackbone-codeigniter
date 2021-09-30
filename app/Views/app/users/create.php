@extends('layouts.basico')
@section('title', $title)

@section('content')

@include('layouts.sidebar')

<!-- Conteúdo -->
<div class="main" id="pagina">

    <div class="container">

        <div id="users-header">
            <h4>Cadastrar novo usuário</h4>
            <hr>
        </div>

        <div class="mb-3">
            <a type="button" href="{{route('usuarios.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <form action="{{route('usuarios.store')}}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="nome" class="col-sm-1 col-form-label">Nome:</label>
                <div class="col-sm-6">
                    <input type="text" name="nome" id="nome" value="{{ old('nome') ?? ''}}" class="form-control">
                    {{ $errors->has('nome') ? $errors->first('nome') : ''}}
                </div>
            </div>

            <div class="form-group row">
                <label for="id" class="col-sm-1 col-form-label">RE:</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" value="{{ old('id') ?? ''}}" class="form-control">
                    {{ $errors->has('id') ? $errors->first('id') : ''}}
                </div>
            </div>

            <div class="form-group row">
                <label for="nivel" class="col-sm-1 col-form-label">Nível:</label>
                <div class="col-sm-6">
                    <select type="text" name="nivel" id="nivel" value="{{ old('nivel') ?? ''}}" class="form-control">
                        <option value=""></option>
                        <option value="ANALISTA">Analista</option>
                        <option value="ADMINISTRADOR">Administrador</option>
                    </select>
                    {{ $errors->has('nivel') ? $errors->first('nivel') : ''}}
                </div>
            </div>

            <button type="submit" id="btnEnviar" class="btn btn-success my-1">Confirmar</button>
            <button type="reset" id="btnReset" class="btn btn-danger my-1">Limpar</button>

        </form>

    </div>
</div>


@include('layouts.footer')

@endsection
