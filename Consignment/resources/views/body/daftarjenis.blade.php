<style>
    .addAdmin-form{
        width: 100%;
        height: 10%;
        margin-top: -5%;
        background-repeat: no-repeat;
    }
    body{
        background-image: url("{{asset('images/background1.jpg')}}");
        width: 100%;
        height: 100%;
        background-repeat:no-repeat;
        background-size: cover;
    }
    .card {
      box-shadow: -10px 10px 10px 10px rgba(0,0,0,0.3);
      transition: 0.3s;
      width: 95%;
      padding: 2%;
      /* border: 1px solid gray; */
      border-radius: 1%;
      margin-left: auto;
      margin-right: auto;
      margin-top: 8%;
      background-color: white;
      margin-bottom: 5%;
    }
</style>
<body>
    <div class="addAdmin-form">
    <div class="card">
    {{--<img src=" {{asset('images/background1.jpg')}}" alt="" >--}}
        <div style="margin-top:2%;">
            <form method="POST" action="{{url('/addJenis')}}">
            @csrf
            <div class="container" style="padding: 1%">
                <div class="form-group">
                    <label>Nama Jenis</label>
                    <input type="text" class="form-control" name="namaJ" placeholder="Masukkan Nama Jenis">
                </div>
                @error('namaJ')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror
                <button type="submit" name="btnTambahJenis" class="btn btn-primary btn-flat m-b-30 m-t-30">Tambah Jenis</button>
            </div>
        </form>
        <br><br>

        <style>
            td {
                text-align: center;
            }
        </style>
        <div class="login-form">
            <div style="padding-left: 200px;padding-right: 200px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center">Jenis ID</th>
                            <th style="text-align:center">Jenis Bank</th>
                        </tr>
                    </thead>

                        @foreach ($dataJenis as $jenis)
                            <tbody>
                                <th style="text-align:center">{{$jenis->JENIS_ID}}</th>
                                <th style="text-align:center">{{$jenis->NAMA_JENIS}}</th>
                            </tbody>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
