<style>
    .card {
      box-shadow: -10px 10px 10px 10px rgba(0,0,0,0.3);
      transition: 0.3s;
      width: 40%;
      padding: 20px;
      /* border: 1px solid gray; */
      border-radius: 15px;
      margin-left: auto;
      margin-right: auto;
      background-color: white;
      margin-bottom: 5%;
    }


    .container {
      padding: 2px 16px;

      margin-left: auto;
      margin-right: auto;
    }
    .containerS{
        margin: 1%;
    }
    .centered{
        margin-left: auto;
        margin-right: auto;
    }
    body{
        background-image: url("{{asset('images/background1.jpg')}}");
        width: 100%;
        height: 100%;
        background-size: cover;
    }
</style>
<div class="card">
    <form action="{{url('/sendResiRetur')}}" method="post">
        @csrf
        <input type="hidden" name="transaksie" value="{{$transaksi[0]->transaksi_id}}">
        <input type="hidden" name="retur_id" value="{{$retur_id}}">
        <img src="{{asset('images/verify.png')}}" alt="Avatar" style="width:100%">
        <div class="container" >
            <h1><b>Telah disetujui admin</b></h1>
            <br>
            <div class="form-group centered">
                <label>Input Nomor Resi</label>
                <input type="text" class="form-control" style="width: auto" name="resi" placeholder="Masukkan No Resi">
            </div>
            @error('resi')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
            @enderror
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h3>Pilih kurir</h3>
                        <div class="form-group">
                            <select name="courier" style="width: auto" class="form-control">
                                <option value="">--Kurir--</option>
                                @foreach ($couriers as $courier => $value)
                                    <option value="{{$courier}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Kirim</button>
        </div>
    </form>
</div>
