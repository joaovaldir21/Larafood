@extends('adminlte::page')

@section('title', "Editar o Perfil {$profile->name}")

@section('content_header')
<h1>Editar o Perfil (<strong> {{ $profile->name }} </strong>) </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

        <!-- Formulário de Cadastro -->
        <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST">
                @method('PUT')

              <!-- Incluindo o Formulário de edição -->
              @include('admin.pages.profiles._partials.form')

            </form>


        </div>
    </div>
@endsection
