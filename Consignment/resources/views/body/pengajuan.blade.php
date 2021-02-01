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
      background-color: white;
      margin-bottom: 5%;
    }
</style>
<body>
    <div class="login-form">
    <div class="card">
        <form method="POST" action="{{url('/doApply')}}">
            @csrf
            <div class="container" style="padding: 1%">
                <h1>Pengajuan</h1>
                <br>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" style="width:100%;" class="form-control" name="NAMA_BARANG" placeholder="Masukkan Nama Barang">
                </div>
                @error('NAMA_BARANG')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Jenis Barang</label><BR>
                    <select class="form-control" style=" width:100%; font-size: 12pt;" name="jenisBarang" id="">
                        @foreach ($daftarJenis as $jenis)
                        <option value="{{$jenis->JENIS_ID}}">{{$jenis->NAMA_JENIS}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Merk Barang</label><BR>
                    <select class="form-control" style="width:100%; font-size: 12pt;" name="merkBarang" id="">
                        @foreach ($daftarMerk as $merk)
                        <option value="{{$merk->MERK_ID}}">{{$merk->NAMA_MERK2}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Fungsionalitas</label>
                    <input type="text" style="width:100%;" class="form-control" name="FUNGSIONALITAS"
                        placeholder="Masukkan Fungsi barang apakah berfungsi dengan baik atau tidak">
                </div>
                @error('FUNGSIONALITAS')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Deskripsi Barang</label>
                    <textarea id="w3review" style="width:100%;" class="form-control" name="DESKRIPSI_BARANG" placeholder="Deskripsi barang"
                        rows="4" cols="50"></textarea>
                </div>
                @error('DESKRIPSI_BARANG')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Harga minimum</label>
                    <input type="text" style="width:100%;" class="form-control" name="HARGA_MIN" placeholder="Masukkan Harga Min">
                </div>
                @error('HARGA_MIN')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Harga Maximum</label>
                    <input type="text" style="width:100%;" class="form-control" name="HARGA_MAX" placeholder="Masukkan Harga Max">
                </div>
                @error('HARGA_MAX')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror
                <div class="form-group">
                    <label>Berat (Gram)</label>
                    <input type="text" style="width:100%;" class="form-control" name="berat" placeholder="Masukkan Berat Barang">
                </div>
                @error('berat')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto Kiri</label>
                    <input type="file" class="form-control-file" id="FOTO_KIRI" name="FOTO_KIRI">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto Kanan</label>
                    <input type="file" class="form-control-file" id="FOTO_KANAN" name="FOTO_KANAN">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto Atas</label>
                    <input type="file" class="form-control-file" id="FOTO_ATAS" name="FOTO_ATAS">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto Bawah</label>
                    <input type="file" class="form-control-file" id="FOTO_BAWAH" name="FOTO_BAWAH">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto Depan</label>
                    <input type="file" class="form-control-file" id="FOTO_DEPAN" name="FOTO_DEPAN">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Foto Belakang</label>
                    <input type="file" class="form-control-file" id="FOTO_BELAKANG" name="FOTO_BELAKANG">
                </div>

                <br>
                <div class="form-group">
                    <label>Jenis Bank</label><BR>
                    <select class="form-control" style="width:100%; font-size: 12pt;" name="jenisBank" id="">
                        @foreach ($daftarBank as $bank)
                        <option value="{{$bank->bank_id}}">{{$bank->nama_bank}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleFormControlFile1">No rekening</label>
                    <input type="text" style="width:100%;" class="form-control" name="no_rek">
                </div>
                @error('no_rek')
                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror
                <br>
                @if ($dataUser->NIK == null || $dataUser->city == null)
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> Anda belum melengkapi profile
                    </div>
                    <button type="submit"  style="width:100%;font-size:13pt;" name="btnRegis" class="btn btn-primary btn-flat m-b-30 m-t-30" disabled="true">Ajukan</button>
                @else

                <button type="submit"  style="width:100%;font-size:13pt;" name="btnRegis" class="btn btn-primary btn-flat m-b-30 m-t-30">Ajukan</button>
                @endif

                <br>
                <br>
                <br>
            </div>
        </form>
    </div>
    </div>
</body>



