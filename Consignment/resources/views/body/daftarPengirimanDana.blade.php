<style>
    .card {
      box-shadow: -10px 10px 10px 10px rgba(0,0,0,0.3);
      transition: 0.3s;
      width: 95%;
      padding: 2%;
      /* border: 1px solid gray; */
      border-radius: 1%;
      margin-left: auto;
      margin-right: auto;
      background-color: white;
      margin-bottom: 5%;
    }
    td {
        text-align: center;
    }
    .login-form{
        width: 100%;
        background-repeat: no-repeat;
    }
    body{
        background-image: url("{{asset('images/background1.jpg')}}");
        background-size:cover;
        background-repeat:no-repeat;
    }
</style>
<body>
    <div class="login-form" >
        <div class="card">
            <div style="margin-top:2%;">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center">Transaksi ID</th>
                            <th style="text-align:center">Pengajuan ID</th>
                            <th style="text-align:center">User Pengaju</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    @foreach ($daftarTransaksi as $transaksi)
                        <tbody>
                            @if (2 - ((new \Carbon\Carbon($transaksi['created_at'], 'UTC'))->diffInDays()) <= 0 && $transaksi['status'] == 5)
                                <th style="text-align:center">{{$transaksi->transaksi_id}}</th>
                                <th style="text-align:center">{{$transaksi->PENGAJUAN_ID}}</th>
                                <th style="text-align:center">{{$transaksi->email_pembeli}}</th>
                                <th style="text-align:center"><a href="{{url('bayarPenjual/'.$transaksi->transaksi_id)}}"><button type="submit">Bayar</button></a></th>
                            @endif
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>
@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
