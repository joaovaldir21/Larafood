@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
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

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th width="50">Ações</th>
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
                            <td>
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">VER</a>
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