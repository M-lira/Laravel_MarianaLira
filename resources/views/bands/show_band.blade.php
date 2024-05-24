@extends('layout.femaster')
@section('content')
<div class="container">
<div class="section_title">
  <h2 class="secondary_title">Detalhes sobre a banda</h2>
</div>
<div class="container-form">
  <form method="POST" action="{{route('band.show', ['id' => $band->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="d-flex justify-content-center align-items-center">
        <div class="form-group" style="margin-bottom: 25px">
          @if($band->photo)
          <img src="{{ asset('storage/' . $band->photo) }}" alt="Album Cover" style="max-width: 300px;">
          @endif
        </div>
      </div>
      </div>
      <div class="col-md-6">
        <div class="row row-form">
          <div class="form-group col-md-12">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input type="text"  value="{{ $band->name }}"  name="albumName" class="form-control" id="inputLine" disabled>
          </div>
        </div>
        <div class="row row-form">
          <div class="form-group col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Origem</label>
            <input type="text"value="{{ $band->origin }}" name="origin" class="form-control" id="inputLine" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Género Musical</label>
            <input type="text" value="{{ $band->genre }}" name="genre" class="form-control" id="inputLine" disabled>
          </div>
        </div>
        <div class="row row-form">
          <div class="form-group col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Ano de formação</label>
            <input type="number" value="{{ $band->yearFormation }}" name="yearFormation" class="form-control" id="inputLine" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Número de álbuns</label>
            <input type="number" value="{{ $band->num_albums }}" name="num_albums" class="form-control" id="inputLine" disabled>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 80px; text-align: center">
      <h2 class="secondary_title">Álbums</h2>
      @if ($albums)
        <table class="table table-bordered border-dark tabela" style="max-width: 800px; margin: auto
        ">
          <thead>
            <tr style="background-color: #2a2a2a">
              <th scope="col" class="col-1">Capa</th>
              <th scope="col" class="col-2">Nome</th>
              <th scope="col" class="col-1">Ano de lançamento</th>
            </tr>
          </thead>
          <tbody>
            @foreach($albums as $album)
            <tr class="align-middle">
              <td class="d-flex justify-content-center">
                <img src="{{ $album->cover ? asset('storage/' . $album->cover) : asset('images/uploadedImages') }}" alt="Cover Album" style="max-width: 120px; max-height: 120px; border-radius: 8px; border: #202020 solid 1px;">
              </td>
              <td style="font-weight: 600;">{{ $album->albumName}}</td>
              <td>{{ $album->dateRelease }}</td>
            </tr>
            @endforeach
          </tbody>
          @else
          <p>Não existem albums disponiveis para esta banda.</p>
          @endif
        </div>
      </form>
    </div>
  </div>
@endsection
