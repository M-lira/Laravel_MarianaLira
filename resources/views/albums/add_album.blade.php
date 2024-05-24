@extends('layout.femaster')
@section('content')

<div class="container">
<div class="section_title">
  <h2 class="secondary_title">Adicionar um novo Album</h2>
</div>
<div class="container-form">
  @if (session('message'))
  <div class="alert alert-dark">
     {{session('message')}}
    </div>
    @endif
<form method="POST" action="{{route('album.create')}}" enctype="multipart/form-data">
  @csrf
  <div class="row row-form">
    <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Nome do Album: </label>
      <input type="text" name="albumName" class="form-control" id="inputLine" required>
      @error('albumName')
      <div class="alert alert-danger">
          Nome inválido. Por favor, tente outravez!
      </div>
      @enderror
    </div>
      <div class="form-group col-md-6">
        <label for="cover" style="padding-bottom: 5px">Capa do album: </label>
        <input accept="image/*" type="file" name="cover" class="form-control" id="cover" required>
      </div>
    </div>
    <div class="row row-form">
      <div class="form-group col-md-6">
        <label for="exampleFormControlInput1" class="form-label">Ano de lançamento: </label>
        <input type="number" name="dateRelease" class="form-control" id="inputLine" required>
        @error('dateRelease')
        <div class="alert alert-danger">Ano inválido!</div>
        @enderror
      </div>
      <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Banda: </label>
        <select id="inputLine" name="bands_id" class="form-control" required>
          <option selected>Selecionar...</option>
          @foreach ($bands as $band)
          <option value="{{ $band->bands_id }}">{{ $band->band_name }} </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="d-flex justify-content-end confirmation-button">
      <button type="submit" class="btn btn-primary-blue">Guardar</button>
    </div>
</form>
</div>
</div>
@endsection
