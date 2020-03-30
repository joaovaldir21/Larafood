@extends('adminlte::page')

@section('title', "Editar o plano {$plan->name}")

@section('content_header')
<h1>Editar o plano (<strong> {{ $plan->name }} </strong>) </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

        <!-- Formulário de Cadastro -->
        <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
                @csrf
                @method('PUT')

              <!-- Incluindo o Formulário de edição -->
              @include('admin.pages.plans._partials.form')

            </form>


        </div>
    </div>
@endsection
