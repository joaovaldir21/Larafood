@extends('adminlte::page')

@section('title', 'Permissões disponíveis para o perfil {$profile->name}')

@section('content_header')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item active"> <a href="{{ route('profiles.index') }}">Perfis</a> </li>
    </ol>

    <!-- link para cadastrar novos planos -->
    <h1>Permissões disponíveis para o perfil (<strong> {{ $profile->name }} </strong>) </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            <!-- Formulário de pesquisa -->
            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline">
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
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>

                    <form action="{{ route('profiles.permissions.attach', $profile->id) }}" method="POST">
                        @csrf

                        @foreach ($permissions as $permission )
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                </td>
                                <td>
                                    {{ $permission->name}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>

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
