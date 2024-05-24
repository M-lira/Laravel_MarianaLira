@extends('layout.femaster')
@section('content')
<div class="container">
  <div class="section_title">
    <h2 class="secondary_title">Atualizar álbum</h2>
  </div>
  <div class="container-form">
    <form method="POST" action="{{route('album.update', ['id' => $album->id]) }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $album->id }}">
      <div class="row row-form">
        <div class="form-group col-md-6">
          <label for="exampleFormControlInput1" class="form-label">Nome:</label>
          <input type="text"  value="{{ $album -> albumName}}"  name="albumName" class="form-control" id="inputLine" required>
          @error('albumName')
          <div class="alert alert-danger">
            Nome inválido. Por favor, tente novamente!
          </div>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="cover" style="padding-bottom: 5px">Capa do álbum:</label>
          <input accept="image/*" value="{{ $album->cover}}" type="file" name="cover" class="form-control" id="cover">
          @if($album->cover)
          <img src="{{ asset('storage/' . $album->cover) }}" alt="Album Cover" style="max-height: 120px; margin-top:10px">
          @else
          <p>Não existe capa.</p>
          @endif
        </div>
      </div>
      <div class="row row-form">
        <div class="form-group col-md-6">
          <label for="exampleFormControlInput1" class="form-label">Ano de lançamento:</label>
          <input type="number" value="{{ $album -> dateRelease}}" name="dateRelease" class="form-control" id="inputLine" required>
          @error('dateRelease')
          <div class="alert alert-danger"> Ano inválido. Por favor, tente novamente!</div>
          @enderror
        </div>
      <div class="form-group col-md-6">
      <label for="exampleFormControlInput1" class="form-label">Banda:</label>
        <select id="inputLine" name="bands_id" class="form-control" required>
          <option selected>Selecione...</option>
          @foreach ($bands as $band)
          {{-- o @if vai buscar a banda que já está selecionada --}}
          <option value="{{ $band->id }}" @if($band->id == $album->bands_id) selected @endif>{{ $band->name }} </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="d-flex justify-content-end confirmation-button">
      <button type="submit" class="btn btn-primary-blue">Atualizar</button>
    </div>
  </form>
</div>
@endsection
