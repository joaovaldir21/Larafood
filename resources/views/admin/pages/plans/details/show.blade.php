@extends('adminlte::page')

@section('title', "Detalhes do detalhe {$detail->name}")

@section('content_header')
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li class="breadcrumb-item"> <a href="{{ route('plans.index') }}">Planos</a> </li>
    <li class="breadcrumb-item"> <a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a> </li>
    <li class="breadcrumb-item"> <a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a> </li>
    <li class="breadcrumb-item active"> <a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}" class="active">Detalhes</a> </li>
  </ol>

  <!-- link para Editar um plano -->
  <h1>Detalhes do detalhe (<strong> {{ $detail->name }} </strong>) </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
          <ul>
            <li>
              <strong>Nome: </strong> {{ $detail->name }}
            </li>
          </ul>
      </div>
      <div class="card-footer">
        <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Deletar o detalhe (<strong>{{ $detail->name }}</strong>) do plano (<strong>{{ $plan->name }}</strong>)? </button>
        </form>
      </div>
    </div>
@endsection
