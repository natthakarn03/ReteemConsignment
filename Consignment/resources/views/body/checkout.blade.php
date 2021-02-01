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
        <div class='row'>
            <div class='col-md-1'>
            </div>
            <div class='col-md-5'>
                <form method='post' action='{{url('/bayar')}}'>
                    @csrf
                    <input type="hidden" name="id" value="{{$barang->PENGAJUAN_ID}}">
                    <br>
                    <h2><b>{{$barang->NAMA_BARANG}}</b></h2>
                    <h4>Deskripsi: {{$barang->DESKRIPSI_BARANG}}</h4>
                    <h4>Price: {{$barang->HARGA_APPROVE}}</h4><br>
                    <img style="width:200px; height:200px; margin-bottom: 2%" src="{{asset('images/'.$barang->FOTO_DEPAN)}}" alt=""><br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>Pilih kurir</h3>
                                <div class="form-group">
                                    <select name="courier" style="width: 100%" class="form-control">
                                        <option value="">--Kurir--</option>
                                        @foreach ($couriers as $courier => $value)
                                            <option value="{{$courier}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type='submit' value='Bayar' name='btnBayar' class='btn btn-primary'>
                    &nbsp;
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div><br><br><br>
</body>
<script>
    $(document).ready(function(){
        $('select[name="province_origin"]').on('change',function(){
            let provinceId = $(this).val();
            if(provinceId){
                jQuery.ajax({
                    url:'/province/'+provinceId+'/cities',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="city_origin"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="city_origin"]').append('<option value="'+key+'">'+value+'</option>')
                        });
                    },
                });
            }else{
                $('select[name="city_origin"]').empty();
            }
        });
        $('select[name="province_destination"]').on('change',function(){
            let provinceId = $(this).val();
            if(provinceId){
                jQuery.ajax({
                    url:'/province/'+provinceId+'/cities',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="city_destination"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="city_destination"]').append('<option value="'+key+'">'+value+'</option>')
                        });
                    },
                });
            }else{
                $('select[name="city_destination"]').empty();
            }
        });
    });


</script>
