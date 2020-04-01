@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li class="breadcrumb-item active"> <a href="{{ route('permissions.index') }}">Permissões</a> </li>
  </ol>

  <!-- link para cadastrar novos planos -->
  <h1>Permissões <a href="{{ route('permissions.create') }}" class="btn btn-dark">Cadastrar</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            <!-- Formulário de pesquisa -->
            <form action="{{ route('permissions.search') }}" method="POST" class="form form-inline">
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
                              <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info">Editar</a>
                              <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">Ver</a>
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
