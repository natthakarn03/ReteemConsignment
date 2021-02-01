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
      margin-bottom: 5%;
      background-color: white;
    }
</style>
<body>
    <div class="login-form">
    <div class="card">
        <form method="POST" action="{{url('/doRegister')}}">
            @csrf
            <div class="container" style="padding: 1%"">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="USERPB_NAME" placeholder="Masukkan Nama">
                </div>
                @error('USERPB_NAME')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="USERPB_EMAIL" placeholder="Masukkan Email">
                </div>
                @error('USERPB_EMAIL')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>No Telp</label>
                    <input type="text" class="form-control" name="USERPB_PHONE_NUMBER" placeholder="Masukkan Nomor Telephone">
                </div>
                @error('USERPB_PHONE_NUMBER')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="USERPB_ADDRESS" placeholder="Masukkan Alamat">
                </div>
                @error('USERPB_ADDRESS')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="USERPB_PASSWORD" placeholder="Masukkan Password">
                </div>
                @error('USERPB_PASSWORD')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="USERPB_PASSWORD_confirmation" placeholder="Masukkan ConfirmPassword">
                </div>
                @error('USERPB_PASSWORD_confirmation')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror




                <div class="checkbox">
                    <label>
                        <input type="checkbox" name='txtagree'> Agree the terms and policy
                    </label>
                </div>
                @error('txtagree')
                    <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                @enderror
                <button type="submit" name="btnRegis" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>

                <div class="register-link m-t-15 text-center">
                    <p>Already have account ? <a href="{{url('/login')}}">Sign in</a></p>
                </div>
            </div>
        </form>
    </div>
    </div>
    @if (session('alert-Warning'))
        <div class="alert alert-Warning">
            {{ session('alert-Warning') }}
        </div>
    @endif
</body>
