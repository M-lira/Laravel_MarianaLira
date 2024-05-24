@extends('layout.femaster')
@section('content')

<div class="container">
  <div class="section_title ">
    <h1 class="primary_title">BANDAS</h1>
    @auth
    @if (Auth::user()->userType == 1)
    <a class="btn btn-primary-blue" href="{{ route('band.add') }}">Adicionar banda</a>
    @endif
    @endauth
  </div>
  <div class="table-contas">@if (session('message'))
    <div class="alert alert-dark">
    {{session('message')}}
  </div>
  @endif
  <table class="table table-bordered border-light tabela">
    <thead>
      <tr style="background-color: #262626">
        <th scope="col" class="col-1"></th>
        <th scope="col" class="col-2">Nome</th>
        <th scope="col" class="col-2">Géneo Musical</th>
        <th scope="col" class="col-2">Origem</th>
        <th scope="col" class="col-2">Ano de Formação</th>
        <th scope="col" class="col-1">Álbuns</th>
        <th scope="col" class="col-1">Opções</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($band as $iten)
      <tr class="align-middle">
        <td class="d-flex justify-content-center"><img src="{{ $iten->photo ? asset('storage/' . $iten->photo) : asset('images/uploadedImages') }}" alt="Cover Album" style="max-width: 120px; max-height: 120px; border-radius: 8px; border: #202020 solid 1px;"></td>
        <td style="font-weight: 600;">{{ $iten->name}}</td>
        <td>{{ $iten->genre}}</td>
        <td>{{ $iten->origin}}</td>
        <td>{{ $iten->yearFormation}}</td>
        <td>
          <div class="d-flex justify-content-center">
            {{ $iten->num_albums}}
          </div>
          </td>
        <td class="align-middle">
          <div class="d-flex justify-content-center">
            <a class="icons-option" href="{{route('band.show', $iten->id)}}"><i class="bi bi-eye" style=""></i></a>
            @auth
            <a class="icons-option"  href="{{route('band.view', $iten->id)}}"><i class="bi bi-pencil" style="padding-right: 25px; color: #989898"></i></a>
            @if (Auth::user()->userType == 1)
            <a class="icons-option"  href="{{route('band.delete', $iten->id)}}"><i class="bi bi-trash3" style="padding-right: 5px; color: #989898"></i></a>
            @endif
          </div>
          @endauth
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
