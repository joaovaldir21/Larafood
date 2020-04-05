@extends('adminlte::page')

@section('title', "Planos do perfil {$profile->name}")

@section('content_header')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
        <li class="breadcrumb-item"> <a href="{{ route('profiles.index') }}">Perfis</a> </li>
        <li class="breadcrumb-item active"> <a href="{{ route('profiles.plans', $profile->id) }}" class="active">Planos</a> </li>
    </ol>

    <!-- link para cadastrar novos planos -->
    <h1>Planos do perfil (<strong> {{ $profile->name }} </strong>) </h1>

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
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan )
                        <tr>
                            <td>
                                {{ $plan->name}}
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
                {!!  $plans->appends($filters)->links() !!}
            @else
                {!!  $plans->links() !!}
            @endif

        </div>

    </div><!-- card -->
@stop
