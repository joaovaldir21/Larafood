@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
<h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <!-- Formulário de Cadastro -->
            <form action="{{ route('profiles.store') }}" class="form" method="POST">

                <!-- Incluindo o Formulário de cadastro -->
                @include('admin.pages.profiles._partials.form')

            </form>


        </div>
    </div>
@endsection
