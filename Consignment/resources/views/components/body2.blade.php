@extends('home')
@section('content')
    <!-- isset ini untuk melakukan pengecekan apakah isi dari $angka ada isinya, supaya tidak error ketika isi dari $angka adalah kosong-->
    @isset($angka)
    <h4>{{$angka}}</h4>
    @endisset
@endsection