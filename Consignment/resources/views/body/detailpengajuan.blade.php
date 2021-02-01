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
  <div class="login-form">
  <div class="card">
  {{--<img src=" {{asset('images/background1.jpg')}}" alt="" >--}}
    <div style="margin-top:2%;">
        <div class="container">
          <div class="col">
            <div class="col-md-1" style='margin-right: 20px;'>
              <img src="{{asset('images/'.$pengajuans->FOTO_KIRI)}}" width='100px' height='100px'>
              <h4>Tampak Kiri</h4>
            </div>
            <div class="col-md-1" style='margin-right: 20px;'>
              <img src="{{asset('images/'.$pengajuans->FOTO_KANAN)}}" width='100px' height='100px'>
              <h4>Tampak Kanan</h4>
            </div>
            <div class="col-md-1" style='margin-right: 20px;'>
              <img src="{{asset('images/'.$pengajuans->FOTO_ATAS)}}" width='100px' height='100px'>
              <h4>Tampak Atas</h4>
            </div>
            <div class="col-md-1" style='margin-right: 20px;'>
              <img src="{{asset('images/'.$pengajuans->FOTO_BAWAH)}}" width='100px' height='100px'>
              <h4>Tampak Bawah</h4>
            </div>
            <div class="col-md-1" style='margin-right: 20px;'>
              <img src="{{asset('images/'.$pengajuans->FOTO_DEPAN)}}" width='100px' height='100px'>
              <h4>Tampak Depan</h4>
            </div>
            <div class="col-md-1" style='margin-right: 20px;'>
              <img src="{{asset('images/'.$pengajuans->FOTO_BELAKANG)}}" width='100px' height='100px'>
              <h4>Tampak Belakang</h4>
            </div>
          </div>
        </div>
      <br><br><br>
      <h3><b>Detail Pengajuan</b></h3>
      <br>

        <form method="get" action="/doApprove">
          @csrf
              <h4>ID Barang: </h4>
              <input type="text" class="form-control" name="ID_BARANG" value="{{$pengajuans->PENGAJUAN_ID}}"  readonly>
              <h4>Nama Barang: </h4>
              <input type="text" class="form-control" name="NAMA_BARANG" value="{{$pengajuans->NAMA_BARANG}}" readonly>
              <h4>Deskripsi Barang: </h4>
              <input type="text" class="form-control" name="DESKRIPSI_BARANG" value="{{$pengajuans->DESKRIPSI_BARANG}}" readonly>
              <h4>Harga Minimum: </h4>
              <input type="text" class="form-control" name="HARGA_MIN" value="{{$pengajuans->HARGA_MIN}}" readonly>
              <h4>Harga Maksimal: </h4>
              <input type="text" class="form-control" name="HARGA_MAKS" value="{{$pengajuans->HARGA_MAX}}" readonly>
              <h4>Harga Approve: </h4>
              <input type="hidden" name="id" value="{{$id}}">
              <input type="text" class="form-control" id="hargaapp" name="hargaApprove" placeholder='Harga Approve'>
              @error('hargaApprove')
                  <div style="color:red; font-weight:bold"> {{$message}}</div><br>
              @enderror

              <br><br><br>
              <input name="butApprove" style="width:100%;font-size:13pt;" class="btn btn-primary" type="submit" value="Approve">
              <br><br><br>
              <div class="form-group">
                  <label>Alasan:</label>
                  <textarea id="w3review" class="form-control" name="ALASAN_TOLAK" placeholder="Alasan Penolakan Barang"
                      rows="4" cols="50"></textarea>
              </div>
          </form>
          <form action="{{url('/doDelete/'.$id)}}" method="get">
              <input name="butReject" butRstyle="width:100%;font-size:13pt;" class="btn btn-danger" type="submit" value="Reject">
          </form>
      </div>
  </div>
  </div>
</body>
@if (session('alert'))
    <div class="alert alert-warning">
        {{ session('alert') }}
    </div>
@endif
