<style>
    td {
        text-align: center;
    }
    .card {
        padding: 10px;
        box-shadow: 0px 0px 8px 5px rgba(0,0,0,0.2);
        border-radius: 10px;
        background-color: white;
        margin-bottom: 5%;
    }

    /* Add some padding inside the card container */
    .container {
        padding: 2px 16px;
    }
    .kotak{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .centered{
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }
    body{
        background-image: url("{{asset('images/background1.jpg')}}");
        width: 100%;
        height: 100%;
        background-repeat:no-repeat;
        background-size:cover;
    }
</style>
<body>
<div class="kotak">
    <div class="card">
        {{-- <img src="img_avatar.png" alt="Avatar" style="width:100%"> --}}
        <div class="container">
            <div class="centered">
                <div class="centered"><h1><b>Bukti Transaksi</b></h1></div>
                <form action="{{url('/doSell')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <img src="{{asset('images/'.$transaksi[0]->bukti_transfer)}}" alt="">
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input type="text" class="form-control" readonly="true" value="Michael Louis Chandra">
                    </div>
                    <div class="form-group">
                        <label>Rekening Tujuan</label>
                        <input type="text" class="form-control" readonly="true" value="{{$transaksi[0]->rekening_tujuan}}">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" readonly="true" value="{{$harga}}">
                    </div>
                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <input type="text" class="form-control" name="alasan" placeholder="Masukkan Alasan">
                    </div>
                    @error('alasan')
                        <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                    @enderror
                    <div class="centered">
                        <button type="submit" name="btnAction" value="approve" class="btn btn-primary btn-flat m-b-30 m-t-30">Approve</button>
                        <button type="submit" name="btnAction" value="reject" class="btn btn-danger btn-flat m-b-30 m-t-30">Reject</button>
                    </div>

                </form>
            </div>

        </div>
      </div>
</div>
</body>
