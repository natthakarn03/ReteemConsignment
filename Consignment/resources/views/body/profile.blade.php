<style>
    td {
        text-align: center;
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
      background-color: white;
      margin-bottom: 5%;
    }
</style>
<body>
<div class="profile-form">
<div class="card">
    <div style="margin:2%;">
        <div class="container">
            <div class="row">
              <div class="col-md-5">
                <h1>Edit Profile</h1>
                <br>
                <form method="get" action="/changeProfile">
                    @csrf
                        <input type="hidden" name="EMAIL_USERe" value="{{$dataUser[0]->USERPB_EMAIL}}">
                        <h4>Email: </h4>
                        <input type="email" style="width:70%;" class="form-control" name="EMAIL_USER" placeholder="Masukkan Email Anda" value="{{$dataUser[0]->USERPB_EMAIL}}" disabled="true">

                        <h4>Nama: </h4>
                        <input type="text" style="width:70%;" class="form-control" name="NAMA_USER" placeholder="Masukkan Nama Anda" value="{{$dataUser[0]->USERPB_NAME}}" disabled="true">

                        <h4>Nomor Telefon: </h4>
                        <input type="text" style="width:70%;"class="form-control" name="NOMOR_TELFON" placeholder="Masukkan Nomor Telfon Anda" value="{{$dataUser[0]->USERPB_PHONE_NUMBER}}">
                        @error('NOMOR_TELFON')
                            <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                        @enderror

                        <h4>Alamat: </h4>
                        <input type="text" style="width:70%;" class="form-control" name="ALAMAT_USER" placeholder="Masukkan Alamat Anda" value="{{$dataUser[0]->USERPB_ADDRESS}}">
                        <div>
                            <div class="form-group">
                                <label for="">Provinsi Asal</label>
                                <select name="province_origin" style="width:70%;" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{$province}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('province_origin')
                                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                            @enderror
                            <div class="form-group">
                                <label for="">Kota Asal</label>
                                <select name="city_origin" style="width:70%;" class="form-control">
                                    <option value="">--Kota--</option>
                                </select>
                            </div>
                            @error('city_origin')
                                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                            @enderror
                            <br>
                        </div>

                        <h4>NIK: </h4>
                        <input type="number" style="width:70%;" class="form-control" name="NIK_USER" placeholder="Masukkan NIK Anda"
                        @if ($dataUser[0]->NIK == null)
                            value="{{$dataUser[0]->NIK}}"
                        @else
                            value="{{$dataUser[0]->NIK}}" readonly='true'
                        @endif
                        >
                        @error('NIK_USER')
                            <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                        @enderror
                        <div class="form-group">
                            <h4>Foto KTP </h4>
                            <input type="url" placeholder="URL KTP" style="width:70%;" class="form-control" id="exampleFormControlFile1" name='FOTO_KTP'
                            @if ($dataUser[0]->FOTO_KTP == null)
                                value="{{$dataUser[0]->FOTO_KTP}}"
                            @else
                                value="{{$dataUser[0]->FOTO_KTP}}" readonly='true'
                            @endif>
                            @error('FOTO_KTP')
                                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                            @enderror

                            <br><br><br>
                            <input name="butSave" style="width:70%;font-size:13pt;" class="btn btn-primary" type="submit" value="SAVE DATA">
                            <br><br><br>
                        </div>
                 </div>
                </form>
              <div class="col-md-4">
                <h1>Ganti Password</h1>
                <br>
                <form method="get" action="/changeProfile">
                    @csrf
                    <input type="hidden" name="EMAIL_USERe" value="{{$dataUser[0]->USERPB_EMAIL}}">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" style="width:70%;" name="USERPB_PASSWORD_Now" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" style="width:70%;" name="USERPB_PASSWORD" placeholder="Masukkan Password">
                    </div>
                    @error('USERPB_PASSWORD')
                                <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                            @enderror
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" style="width:70%;" name="USERPB_PASSWORD_confirmation" placeholder="Masukkan Confirm Password">
                    </div>
                    @error('USERPB_PASSWORD_confirmation')
                        <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                    @enderror
                    <br><br><br>
                    <input name="butSavePass" style="width:70%;font-size:13pt;" class="btn btn-primary" type="submit" value="UPDATE PASSWORD">
                    <br><br><br>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>
</div>

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

    });


</script>
@if (session('alert'))
    <div class="alert alert-warning">
        {{ session('alert') }}
    </div>
@endif
</body>
