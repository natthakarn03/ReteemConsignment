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
    <div class="login-form" >
    <div class="card">
        <div style="margin-top:2%;">
            <br><br><br><br>
            <a href="{{url('/approved')}}">
                <button type="button" class="btn btn-success" style="width: 49%;">Approved</button>
            </a>
            <a href="{{url('/notapproved')}}">
                <button type="button" class="btn btn-danger" style="width: 50%;">Not Approved</button>
            </a>
            <br><br><br><br>
    </div>
    </div>
</body>
