<style>
    .login-form{
        width: 100%;
        height: 10%;
        margin-top: -2%;
        background-repeat: no-repeat;
    }
    body{
        background-image: url("{{asset('images/background1.jpg')}}");
        width: 100%;
        height: 100%;
        background-repeat:no-repeat;
        background-size:cover;
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
    {{--<img src=" {{asset('images/background1.jpg')}}" alt="" >--}}
        <div style="margin-top:2%">
            <h2>Barang yang belum di approve:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">ID</th>
                        <th style="text-align:center">Nama Barang</th>
                        <th style="text-align:center">Harga Min - Harga Max</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                </thead>
                @if ($items != null)
                @foreach ($items as $item)
                @if($item->STATUS_PENGAJUAN == 0)
                <tbody>
                    <tr>
                        <td style="text-align:center">
                            {{$item->PENGAJUAN_ID}}
                        </td>
                        <td style="text-align:center">
                            {{$item->NAMA_BARANG}}
                        </td>
                        <td style="text-align:center">
                            {{$item->HARGA_MIN." - ".$item->HARGA_MAX}}
                        </td>

                        <td style="text-align:center">
                            <a style="width:100%;font-size:13pt;" href="/detailbarangreject/{{ $item->PENGAJUAN_ID }}"
                                class="btn list-group-item">
                                Detail
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endif
                @endforeach
                @endif
            </table>
        </div>
    </div>
    </div>
</body>
