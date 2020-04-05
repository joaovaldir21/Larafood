@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name}")

@section('content_header')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item"> <a href="{{ route('plans.index') }}">Planos</a> </li>
        <li class="breadcrumb-item active"> <a href="{{ route('plans.profiles', $plan->id) }}" class="active">Perfis</a> </li>
    </ol>

    <!-- link para cadastrar novos planos -->
    <h1>Perfis do plano (<strong> {{ $plan->name }} </strong>) </h1>
        <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark">Adicionar novo Perfil</a>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

            <!-- Formulário de pesquisa -->
            <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
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
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile )
                        <tr>
                            <td>
                                {{ $profile->name}}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('plans.profile.detach', [$plan->id, $profile->id]) }}" class="btn btn-danger">Desvincular</a>
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
