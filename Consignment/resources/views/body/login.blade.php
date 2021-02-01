<style>
    .container{
        width: 100%;
        height: 10%;
        margin-top: -5%;
        background-repeat: no-repeat;
    }
    .card {
        box-shadow: 10px 10px 10px 10px rgba(0,0,0,0.1);
        transition: 0.3s;
        width: 40%;
        padding: 5%;
        margin-left: 30%;
        margin-top: 10%;
        background-color: white;
        margin-bottom: 10%;
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
{{--<img src=" {{asset('images/background1.jpg')}}" alt="" style="margin-left:-2%;">--}}
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="">
                </a>
            </div>
            <div class="card">
                <div class="login-form background">
                    <form method="POST" action="{{url('/doLogin')}}">
                        @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="USERPB_EMAIL" placeholder="Email">
                        </div>
                        @error('USERPB_EMAIL')
                            <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                        @enderror
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="USERPB_PASSWORD" placeholder="Password">
                        </div>
                        @error('USERPB_PASSWORD')
                            <div style="color:red; font-weight:bold"> {{$message}}</div><br>
                        @enderror
                        <div class="checkbox">
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" name="btnLogin" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="{{url('/register')}}"> Sign Up Here</a></p>
                        </div>
                        @if (session('alert-Warning'))
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                    alert('Silahkan Login sebelum melakukan transaksi');
                                });
                            </script>
                        @endif
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>

