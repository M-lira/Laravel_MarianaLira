@extends('layout.femaster')
@section('content')
@if (session('message'))
<div class="alert alert-dark">
  {{session('message')}}
</div>
@endif
<div class="body_main">
<img src="{{ asset('images/banner.png') }}" alt="" style="width: 100vw; height: 80vh">
</div>
@endsection
