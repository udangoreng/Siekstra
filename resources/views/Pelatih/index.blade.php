@extends('layouts.pelatih')
@section('title', 'Pelatih')
@section('main')
    <div class="section">
        <h1 class="fw-bold">Selamat datang, {{ $username }}</h1>
        {{ $data }}
    </div>
@endsection
