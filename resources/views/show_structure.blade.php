@extends('layouts.app') @section('content')
<div class="d-flex justify-content-end">
    <form action="{{route('cetak_structure')}}" method="get">
        <button class="btn btn-success b btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-print"></i>
            </span>
            <span class="text">Cetak Data</span>
        </form>
    </div>
    <img src="{{asset('img/struktur.svg')}}" alt="">
    @endsection