@extends('layout.femaster')
@section('content')

<div class="container">
  <div class="section_title ">
    <h1 class="primary_title">Álbuns</h1>
    @auth
    @if (Auth::user()->userType == 1)
    <a class="btn btn-primary-blue" href="{{ route('album.add') }}"> Adicionar álbum</a>
    @endif
    @endauth
  </div>
  <div class="table-contas">
    @if (session('message'))
    <div class="alert alert-dark">
       {{session('message')}}
      </div>
      @endif
      <table class="table table-bordered border-light tabela">
        <thead>
          <tr style="background-color: #262626">
            <th scope="col" class="col-1"></th>
            <th scope="col" class="col-2">Nome</th>
            <th scope="col" class="col-2">Ano de lançamento</th>
            <th scope="col" class="col-2">Banda</th>
            <th scope="col" class="col-1">Opções</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($albums as $iten)
          <tr class="align-middle">
            <td class="d-flex justify-content-center">
              <img src="{{ $iten->cover ? asset('storage/' . $iten->cover) : asset('images/uploadedImages') }}" alt="Cover Album" style="max-width: 120px; max-height: 120px; border-radius: 8px; border: #202020 solid 1px;">
            </td>
            <td style="font-weight: 600;">{{ $iten->albumName}}</td>
            <td>{{ $iten->dateRelease }}</td>
            <td>{{ $iten->band_name }}</td>
            <td class="align-middle">
              <div class="d-flex justify-content-center">
                <a class="icons-option"  href="{{route('album.show', $iten->id)}}"><i class="bi bi-eye" style="padding-right: 25px; font-size: 25px; color: #989898"></i></a>
                @auth
                <a class="icons-option"  href="{{route('album.view', $iten->id)}}"><i class="bi bi-pencil" style="padding-right: 25px; font-size: 20px; color: #989898"></i></a>
                @if (Auth::user()->userType == 1)
                <a class="icons-option"  href="{{route('album.delete', $iten->id)}}"><i class="bi bi-trash3" style="padding-right: 5px; font-size: 20px; color: #989898"></i></a>
                @endif
                @endauth
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
