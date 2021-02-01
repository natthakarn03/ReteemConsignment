<style>
    .card {
      box-shadow: -10px 10px 10px 10px rgba(0,0,0,0.3);
      transition: 0.3s;
      width: 95%;
      padding: 2%;
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
    <div class="login-form">
    <div class="card">
        {{--<img src=" {{asset('images/background1.jpg')}}" alt="" >--}}
        <div style="margin-top:2%;">
            <div class='row'>
                <div class='col-md-4'>
                    <div class="gambar">
                        {{-- <img src=""> --}}
                    </div>
                </div>
                <div class='col-md-8'>
                    <form action="{{url('/membayar')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$barang->PENGAJUAN_ID}}" name="id">
                        <input type="hidden" value="{{$courier_id}}" name="courier_id">
                        <br>
                        {{-- <img src="{{ url('/images/dummy1.png') }}" style="width:100px; height:100px;"> --}}
                        <h2>Harga Barang:</h2>
                            <h1 style='margin-left: 25%; color:red'><b>Rp.{{number_format($barang->HARGA_APPROVE)}}</b></h1>
                            <br>
                        <h2>Dari - Ke:</h2>
                        <h1 style='margin-left: 25%; color:red'>{{$asal}} - {{$ke}}</h1>
                        <h2>Ongkos Kirim:</h2>
                        <h1 style='margin-left: 25%; color:red'><b>Rp.{{number_format($costCourier)}}</b></h1>
                        <br>
                        <input type="hidden" name="costKurir" value="{{$costCourier}}">
                        <h2>Total Pembayaran:</h2>
                        <h1 style='margin-left: 25%; color:red'><b>Rp.{{number_format($barang->HARGA_APPROVE + $costCourier)}}</b></h1>
                        <br>
                        <input type="hidden" name="costTotal" value="{{$barang->HARGA_APPROVE + $costCourier}}">
                        <h3><b>Pilih Bank:</b></h3>
                        <select id="myDropDown" class="form-control" style="width:70%; font-size: 12pt;" name="bank" id="">
                            @foreach ($dataBank as $bank)
                                <option value="{{$bank->rekening}}">{{$bank->nama_bank}}</option>
                            @endforeach
                        </select>
                        <h3><b>Nomor Rekening Tujuan:</b></h3>
                        <h3 style='margin-left: 25%'><b><p id="output">5230001</p></b></h3>
                        <h3 style='margin-left: 15%'><i>A.n Michael Louis Chandra</i></h3>
                        <h3><b>Upload Bukti Transfer:</b></h3>
                            <div class="form-group">
                            <input type="file" class="form-control-file" id="BUKTI_TRANSFER" name="BUKTI_TRANSFER">
                            </div>

                        <div><br>
                        <button class='btn btn-primary' type="submit">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div><br><br><br>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#myDropDown').change(function(){
            //Selected value
            var inputValue = $(this).val();
            // alert("value in js "+inputValue);

            //Ajax for calling php function
            $.post('submit.php', { dropdownValue: inputValue }, function(data){
                alert('ajax completed. Response:  '+data);
                //do after submission operation in DOM
            });
            document.getElementById('output').innerHTML = inputValue;
            document.getElementById('output2').innerHTML = inputValue;
        });

    });
</script>
