<!-- ALERT DE VALIDAÇÕES -->
@if ($errors->any())
  <div class="alert alert-warning">
    @foreach ($errors->all() as $error)
      <p> {{ $error }} </p>
    @endforeach
  </div>
@endif

<!-- ALERT DE SUCESSO -->
@if (session('message'))
  <div class="alert alert-success">
    {{ session('message') }}
  </div>
@endif

<!-- ALERT DE ERRO -->
@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

<!-- ALERT DE atenção -->
@if (session('info'))
  <div class="alert alert-warning">
    {{ session('info') }}
  </div>
@endif
