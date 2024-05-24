@extends('layout.femaster')
@section('content')
<div class="container">
  <div class="section_title">
  <h2 class="secondary_title">Adicionar uma nova banda</h2>
</div>
<div class="container-form">
<form method="POST" action="{{route('band.create')}}" enctype="multipart/form-data">
  @csrf
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Nome:</label>
      <input type="text" name="name" class="form-control" id="inputLine" required>
      @error('name')
      <div class="alert alert-danger">
         Nome inválido. Por favor, tente novamente!
      </div>
      @enderror
    </div>
      <div class="form-group col-md-6">
        <label for="photo" style="padding-bottom: 5px">Foto da Banda: </label>
        <input accept="image/*" type="file" name="photo" class="form-control" id="photo" required>
      </div>
    </div>
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Origem: </label>
      <input type="text" name="origin" class="form-control" id="inputLine" required>
      @error('origin')
      <div class="alert alert-danger">
        Origem inválida. Por favor, tente novamente!
      </div>
      @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Género musical:</label>
      <input type="text" name="genre" class="form-control" id="inputLine" required>
      @error('genre')
      <div class="alert alert-danger">
         Género musical inválido. Por favor, tente novamente!
      </div>
      @enderror
    </div>
  </div>
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Ano de formação: </label>
      <input type="number" name="yearFormation" class="form-control" id="inputLine" required>
      @error('yearFormation')
      <div class="alert alert-danger">
        Ano inválido. Por favor, tente novamente!
      </div>
      @enderror
    </div>
  </div>
  <div class="d-flex justify-content-end confirmation-button">
  <button type="submit" class="btn btn-primary-blue">Guardar</button>
</div>
</form>
</div>
</div>
@endsection
