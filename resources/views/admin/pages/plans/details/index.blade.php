@extends('adminlte::page')

@section('title', "Detalhes do plano ( {$plan->name} )")

@section('content_header')
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li class="breadcrumb-item"> <a href="{{ route('plans.index') }}">Planos</a> </li>
    <li class="breadcrumb-item"> <a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a> </li>
    <li class="breadcrumb-item active"> <a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a> </li>
  </ol>

  <!-- link para cadastrar novos planos -->
  <h1>Detalhes do plano (<strong> {{ $plan->name }} </strong>) <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark">Cadastrar</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail )
                        <tr>
                            <td>
                              {{ $detail->name}}
                            </td>
                            <td style="width=10px;">
                              <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-info">Editar</a>
                              <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- card-body -->

        <div class="card-footer">

            @if (isset($filters))
                {!!  $details->appends($filters)->links() !!}
            @else
                {!!  $details->links() !!}
            @endif

        </div>

    </div><!-- card -->
@stop
