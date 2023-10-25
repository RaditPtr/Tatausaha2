@extends('layout.layout')
@section('title', 'Daftar Guru')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }    
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center bg-white">
                    <div class="card-body">
                        <h3 class="card-title">JUMLAH SISWA</h3>
                        <h1 class="fw-bold">721</h1>
                    </div>
                    <img src="{{ asset('img/group.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center bg-white">
                    <div class="card-body">
                        <h3 class="card-title">JUMLAH GURU</h3>
                        <h1 class="fw-bold">721</h1>
                    </div>
                    <img src="{{ asset('img/teacher.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center bg-white">
                    <div class="card-body">
                        <h3 class="card-title">JUMLAH KELAS</h3>
                        <h1 class="fw-bold">721</h1>
                    </div>
                    <img src="{{ asset('img/kelas3.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>
@endsection
