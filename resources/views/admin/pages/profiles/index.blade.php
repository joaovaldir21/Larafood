@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li class="breadcrumb-item active"> <a href="{{ route('profiles.index') }}">Perfis</a> </li>
  </ol>

  <!-- link para cadastrar novos planos -->
  <h1>Perfis <a href="{{ route('profiles.create') }}" class="btn btn-dark">Cadastrar</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            <!-- Formulário de pesquisa -->
            <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
                @csrf
            <input class="form-control" type="text" name="filter" placeholder="Pesquisa" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtar</button>
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
                    @foreach ($profiles as $profile )
                        <tr>
                            <td>
                              {{ $profile->name}}
                            </td>
                            <td style="width=10px;">

                             {{-- COMENTADA <a href="{{ route('details.profile.index', $profile->url) }}" class="btn btn-primary">Detalhes</a> --}}

                              <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info">Editar</a>
                              <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- card-body -->

        <div class="card-footer">

            @if (isset($filters))
                {!!  $profiles->appends($filters)->links() !!}
            @else
                {!!  $profiles->links() !!}
            @endif

        </div>

    </div><!-- card -->
@stop
