<style>
    td {
        text-align: center;
    }
    .login-form{
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
        background-size:cover;
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
    <div class="login-form">
    <div class="card">
    {{--<img src=" {{asset('images/background1.jpg')}}" alt="" >--}}
        <div style="margin-top:2%;">
            <div class='row'>
                <div class='col-md-1'>
                    <div class="gambar">
                        <img src="">
                    </div>
                </div>
                <div class='col-md-8'>
                    <form method='post' action='/post_checkout/{{$barang->PENGAJUAN_ID}}'>
                        @csrf
                        <br>
                        <h3><b>{{$barang->NAMA_BARANG}}</b></h3>
                        <div class="row">
                            <img style="width:120px; height:120px" src="{{asset('images/'.$barang->FOTO_KIRI)}}" alt="">
                            <img style="width:120px; height:120px" src="{{asset('images/'.$barang->FOTO_KANAN)}}" alt="">
                            <img style="width:120px; height:120px" src="{{asset('images/'.$barang->FOTO_DEPAN)}}" alt="">
                            <img style="width:120px; height:120px" src="{{asset('images/'.$barang->FOTO_BELAKANG)}}" alt="">
                            <img style="width:120px; height:120px" src="{{asset('images/'.$barang->FOTO_ATAS)}}" alt="">
                            <img style="width:120px; height:120px" src="{{asset('images/'.$barang->FOTO_BAWAH)}}" alt="">
                        </div>
                        <h3>Deskripsi:<br></h3>
                        <h4> {{$barang->DESKRIPSI_BARANG}}</h4><br>
                        <h4>Price: {{$barang->HARGA_APPROVE}}</h4><br>
                        <div><br>
                        <input type='submit' value='Checkout' name='btncheckout' class='btn btn-primary'>
                        &nbsp;
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div><br><br><br>
</body>
