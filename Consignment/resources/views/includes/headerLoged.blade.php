

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><a href="{{url('/katalog')}}">Home</a></li>
            <li><a href="{{url('/pengajuan')}}">Pengajuan</a></li>
            <li><a href="{{url('/barangreject')}}">Barang Reject</a></li>
            <li><a href="{{url('/retur')}}">Retur</a></li>
            <li><a href="{{url('/barangSaya')}}">Barang Saya</a></li>
            <li><a href="{{url('/statusbarang')}}">Barang Dibeli</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{url('/profile')}}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="{{url('/doLogout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
        </div>
    </div>
</nav>

@if (Session::has('message'))
    <script>alert(`{{ Session::get('message') }}`)</script>
@endif
