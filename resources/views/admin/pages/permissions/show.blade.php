@extends('adminlte::page')

@section('title', "Detalhes da permissão { $permission->name }")

@section('content_header')
<h1>Detalhes da permissão (<strong> {{ $permission->name }} </strong>) </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $permission->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $permission->description }}
                </li>
            </ul>

            <!-- Inclusão de Alerta de sucesso -->
            @include('admin.includes.alerts')


            <!-- Formulário de DELETAR -->
            <form action=" {{ route('permissions.destroy', $permission->id) }} " method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Deletar a permissão: (<strong>{{ $permission->name }} </strong> )</button>
            </form>

        </div>
    </div>
@endsection
