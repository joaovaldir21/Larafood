@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li class="breadcrumb-item active"> <a href="{{ route('plans.index') }}" class="active">Planos</a> </li>
  </ol>

  <!-- link para cadastrar novos planos -->
  <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-dark">Cadastrar</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            <!-- Formulário de pesquisa -->
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
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
                        <th>Preço</th>
                        <th width="280">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan )
                        <tr>
                            <td>
                              {{ $plan->name}}
                            </td>
                            <td>
                              R$ {{ number_format($plan->price, 2, ',', '.' ) }}
                            </td>
                            <td style="width=10px;">
                              <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-primary">Detalhes</a>
                              <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info">Editar</a>
                              <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
                              <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-warning"> <i class="fas fa-address-book"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- card-body -->

        <div class="card-footer">

            @if (isset($filters))
                {!!  $plans->appends($filters)->links() !!}
            @else
                {!!  $plans->links() !!}
            @endif

        </div>

    </div><!-- card -->
@stop
