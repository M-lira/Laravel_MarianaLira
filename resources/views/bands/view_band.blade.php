@extends('layout.femaster')
@section('content')
<div class="container">

<div class="section_title">
  <h2 class="secondary_title">Atualizar banda</h2>
</div>
<div class="container-form">
<form method="POST" action="{{ route('band.update', ['id' => $band->id]) }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{ $band->id }}" id="">
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Nome:</label>
      <input type="text" value="{{ $band -> name}}" name="name" class="form-control" id="inputLine" required>
      @error('name')
      <div class="alert alert-danger">
          Nome inválido. Por favor, tente novamente!
      </div>
      @enderror
    </div>
  <div class="form-group col-md-6">
    <label for="photo" style="padding-bottom: 1px">Foto: </label>
    {{-- input da imagem --}}

    <input accept="image/*" value="{{ $band->photo }}" type="file" name="photo" class="form-control"
    id="exampleFormControlInput1">
    @if($band->photo)
    <p style="color: #70d9ded1; padding-top: 5px">Imagem atual:</p>
    <img src="{{ asset('storage/' . $band->photo) }}" alt="Current Image" style="max-height: 120px; margin-bottom: 15px">
    @else <!-- Se não houver imagem mostra a mensagem-->
      <p style="color: #70d9ded1; padding-top: 5px"><i class="bi bi-image"></i> Nenhuma foto disponíbel</p>
    @endif
  </div>
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Origem: </label>
      <input type="text" value="{{ $band -> origin}}" name="origin" class="form-control" id="inputLine" required>
      @error('origin')
      <div class="alert alert-danger">
        Origem inválida. Por favor, tente novamente!
      </div>
      @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Género: </label>
      <input type="text" value="{{ $band -> genre}}" name="genre" class="form-control" id="inputLine" required>
      @error('genre')
      <div class="alert alert-danger">
        Género inválido. Por favor, tente novamente!
      </div>
      @enderror
    </div>
  </div>
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Ano de formação:</label>
      <input type="number" value="{{ $band -> yearFormation}}" name="yearFormation" class="form-control" id="inputLine" required>
      @error('yearFormation')
      <div class="alert alert-danger">
        Ano inválido. Por favor, tente novamente!
      </div>
      @enderror
    </div>
  </div>
  <div class="d-flex justify-content-end confirmation-button">
  <button type="submit" class="btn btn-primary-blue">Atualizar</button>
</div>
</form>
</div>
</div>
@endsection
