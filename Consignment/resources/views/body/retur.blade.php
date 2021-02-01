<style>
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
      margin-bottom: 2%;
      background-color: white;
      margin-bottom: 5%;
    }
</style>
<body>
    <div class="retur-form">
    <div class="card">
        <form method="POST" action="{{url('/doRetur')}}">
            @csrf
            <div class="container" style="padding: 1%;">
                <h1>Pengajuan Keluhan</h1>
                <h4 style="color: red">*maksimal pengembalian barang adalah 2 hari setelah pembelian</h4>
                <br>
                <div class="form-group">
                    <label>Transaksi ID - Tanggal transaksi - Nama Barang</label>
                    {{-- <input type="text" style="width:70%;" class="form-control" name="TRANSAKSI_ID" placeholder="Masukkan ID Transaksi"> --}}
                    <select id="myDropDown" class="form-control" style="width:70%; font-size: 12pt;" name="transaksi_id" >
                        @foreach ($dataTransaksi as $transaksi)
                            @foreach ($barang as $bar)
                                @if ($transaksi->PENGAJUAN_ID == $bar->PENGAJUAN_ID)
                                    @if (2 - ((new \Carbon\Carbon($transaksi['created_at'], 'UTC'))->diffInDays()) > 0)
                                    <option value="{{$transaksi->transaksi_id}}">
                                        <p>{{$transaksi->transaksi_id}} || {{$transaksi->created_at}} || {{$bar->NAMA_BARANG}}</p>
                                        </option>
                                    @endif

                                @endif
                            @endforeach

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <input type="text" style="width:70%;" class="form-control" name="NAMA_PEMBELI"
                    placeholder="Masukkan Nama Anda" readonly="true" value="{{$userNow->USERPB_NAME}}">
                </div>

                <br>

                <div class="form-group">
                    <label>Deskripsi Barang</label>
                    <textarea id="w3review"style="width:70%;" class="form-control" name="DESKRIPSI_BARANG" placeholder="Deskripsi barang"
                        rows="4" cols="50"></textarea>
                </div>
                @error('DESKRIPSI_BARANG')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Link Video</label>
                    <textarea id="w3review" style="width:70%;"class="form-control" name="LINK_VIDEO" placeholder="Masukkan Link Video"
                        rows="4" cols="50"></textarea>
                </div><br>

                @error('LINK_VIDEO')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror


                <button type="submit" style="width:70%;" name="btnRetur" class="btn btn-primary btn-flat m-b-30 m-t-30">Ajukan Keluhan</button>

            </div>
<br><br><br>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align:center">Retur ID</th>
                    <th style="text-align:center">Transaksi ID</th>
                    <th style="text-align:center">Tanggal Transaksi</th>
                    <th style="text-align:center">Nama Pembeli</th>
                    <th style="text-align:center">Deskripsi</th>
                    <th style="text-align:center">Link Video</th>
                    <th style="text-align:center">Status</th>
                </tr>
            </thead>
            @foreach ($dataRetur as $retur)
                @if (2 - ((new \Carbon\Carbon($retur['created_at'], 'UTC'))->diffInDays()) > 0)
                <tbody>
                    <th style="text-align:center">{{$retur->retur_id}}</th>
                    <th style="text-align:center">{{$retur->transaksi_id}}</th>
                    @foreach ($dataTransaksi as $trans)
                        @if ($trans->transaksi_id == $retur->transaksi_id)
                            <th style="text-align:center">{{$trans->created_at}}</th>
                        @endif
                    @endforeach
                    <th style="text-align:center">{{$userNow->USERPB_NAME}}</th>
                    <th style="text-align:center">{{$retur->deskripsi}}</th>
                    <th style="text-align:center"><a href="{{$retur->link_video}}">{{$retur->link_video}}</a></th>
                    @if ($retur->status == 0)
                        <th style="text-align:center">Menunggu konfirmasi</th>
                    @elseif($retur->status == 1)
                        <th style="text-align:center"><a href="{{url('/returResi/'.$retur->retur_id)}}"><Button>Kirim resi</Button></a></th>
                    @elseif($retur->status == 2)
                        <th style="text-align:center">Barang terkirim</th>
                    @endif
                </tbody>
                @endif

            @endforeach
        </table>
    </div>
    </div>
    @if (session('alert'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{session('alert')}}
        </div>
    @endif
</body>
