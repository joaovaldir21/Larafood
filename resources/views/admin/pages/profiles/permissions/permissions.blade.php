@extends('adminlte::page')

@section('title', 'Permissões do perfil {$profile->name}')

@section('content_header')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item active"> <a href="{{ route('profiles.index') }}">Perfis</a> </li>
    </ol>

    <!-- link para cadastrar novos planos -->
    <h1>Permissões do perfil (<strong> {{ $profile->name }} </strong>) </h1>
        <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark">Adicionar Permissão ao Perfil</a>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            <!-- Formulário de pesquisa -->
            <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
                @csrf
            <input class="form-control" type="text" name="filter" placeholder="Pesquisa" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Pesquisar</button>
            </form>

        </div>
        <div class="card-body">

            <!-- Inclusão de Alerta de sucesso -->
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission )
                        <tr>
                            <td>
                                {{ $permission->name}}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('profiles.edit', $permission->id) }}" class="btn btn-info">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- card-body -->

        <div class="card-footer">

            @if (isset($filters))
                {!!  $permissions->appends($filters)->links() !!}
            @else
                {!!  $permissions->links() !!}
            @endif

        </div>

    </div><!-- card -->
@stop
