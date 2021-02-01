<style>
    .card {
    /* Add shadows to create the "card" effect */
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
        background-color: white;
        margin-bottom: 5%;
    }

    /* On mouse-over, add a deeper shadow */
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    /* Add some padding inside the card container */
    .container {
        padding: 2px 16px;
    }
    body{
        background-image: url("{{asset('images/background1.jpg')}}");
        width: 100%;
        height: 100%;
        background-repeat:no-repeat;
        background-size: cover;
    }
</style>
<body>
<div class="addAdmin-form">
    <form action="{{url("/con")}}" method="get">
        @csrf
        <div class="login-form">
            @if (count($pengiriman) < 1 == true)
                <div class="card">
                    <h1><strong>Status: Masih Menunggu konfirmasi</strong></h1>
                    <input type="hidden" name="transaksi" value="{{$pengiriman[0]->transaksi_id}}">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            0%
                        </div>
                    </div><br>
                </div>
            @else
                @if($pengiriman[0]->status == 1)
                <div class="card">
                    <h1><strong>Status: Barang Telah Dikirim</strong></h1>
                    <input type="hidden" name="transaksi" value="{{$pengiriman[0]->transaksi_id}}">
                    <h1>Courier : {{$courier}}</h1>
                    <h2>Resi : {{$resi}}</h2>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100" style="width:75%">
                            75%
                        </div>
                    </div><br>
                    <button type="submit">konfirmasi</button>
                </div>
                @elseif ($pengiriman[0]->status == 2)
                <div class="card">
                    <h1><strong>Status: Barang Telah DiTerima</strong></h1>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            100%
                        </div>
                    </div>
                </div>
                @elseif ($pengiriman[0]->resi == null)
                    <div class="card">
                        <h1><strong>Status: Penjual Menyiapkan barang</strong></h1>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100" style="width:25%">
                                25%
                            </div>
                        </div>
                    </div>

                @elseif($pengiriman[0]->resi != null)
                    <div class="card">
                        <h1><strong>Status: Cargo Siap Dikirim</strong></h1>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                50%
                            </div>
                        </div>
                    </div>
                @elseif($pengiriman[0]->tanggal_diterima != null)
                <div class="card">
                    <h1><strong>Status: Cargo Siap Dikirim</strong></h1>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100" style="width:75%">
                            75%
                        </div>
                    </div>
                </div>

                @endif
            @endif



        </div>
    </form>
</div>
</body>
