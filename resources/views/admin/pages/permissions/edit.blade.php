@extends('adminlte::page')

@section('title', "Editar a permissão {$permission->name}")

@section('content_header')
<h1>Editar a permissão (<strong> {{ $permission->name }} </strong>) </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

        <!-- Formulário de Cadastro -->
        <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @method('PUT')

              <!-- Incluindo o Formulário de edição -->
              @include('admin.pages.permissions._partials.form')

            </form>


        </div>
    </div>
@endsection
