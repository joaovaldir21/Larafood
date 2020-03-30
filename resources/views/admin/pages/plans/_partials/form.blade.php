<!-- Inclusão da view de ALERTA  -->
@include('admin.includes.alerts')

<!-- exibe o formulário  -->
<div class="form-group">
    <label>Nome: </label>
    <input type="text" name="name" class="form-control" placeholder="Informe o Nome" value="{{ $plan->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Preço: </label>
    <input type="text" name="price" class="form-control" placeholder="Informe o preço" value="{{ $plan->price ?? old('price') }}">
</div>
<div class="form-group">
    <label>Descrição: </label>
    <input type="text" name="description" class="form-control" placeholder="Informe a descrição" value="{{ $plan->description ?? old('description') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Salvar</button>
</div>
