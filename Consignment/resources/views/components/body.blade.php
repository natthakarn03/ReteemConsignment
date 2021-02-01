@extends('page/home')
@section('content')
    <style>
        .container {
            width:auto;
            height:auto;
            background-color: #B5D3E7
        }
    </style>
    <script>
        //Javascript biasa, ini untuk mengambil isi dari komponen select dengan id "Selector"
        function tampilkan() {
            var selected = document.getElementById("selector").selectedIndex;
            alert(selected);
        }
    </script>
    <div class="container">
    <Button><a href="{{'pindahHalaman'}}">PINDAH</a></Button>
        <h3>Ini adalah bagian dari home</h3>
        <select name="" id="selector" onchange="tampilkan()">
            <option value ="">Pilih Angka</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br>
    </div>
@endsection
