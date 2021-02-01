<style>
    .login-form{
        width: 100%;
        height: 10%;
        margin-top: -5%;
        background-repeat: no-repeat;
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
    <div class="addAdmin-form">
    <div class="card">
     {{--<img src=" {{asset('images/background1.jpg')}}" alt="" >--}}
        <div style="margin-top:2%;">
            <style>
                td {
                    text-align: center;
                }
            </style>
            <form action="{{url('/doDeleteRetur')}}" method="post">
                @csrf
                <div class="login-form">
                    <div style="padding: 2%">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Retur ID</th>
                                    <th style="text-align:center">Transaksi ID</th>
                                    <th style="text-align:center">Tanggal Transaksi</th>
                                    <th style="text-align:center">Nama Pembeli</th>
                                    <th style="text-align:center">Deskripsi</th>
                                    <th style="text-align:center">Link Video</th>
                                    <th style="text-align:center">ACTION</th>
                                </tr>
                            </thead>
                            @foreach ($dataRetur as $retur)
                                @if (60 - ((new \Carbon\Carbon($retur['created_at'], 'UTC'))->diffInDays()) > 0)
                                <tbody>
                                    <th style="text-align:center">{{$retur->retur_id}}</th>
                                    <th style="text-align:center">{{$retur->transaksi_id}}</th>
                                    @foreach ($dataTransaksi as $trans)
                                        @if ($trans->transaksi_id == $retur->transaksi_id)
                                            <th style="text-align:center">{{$trans->created_at}}</th>
                                        @endif
                                    @endforeach
                                    @foreach ($dataUser as $user)
                                        @if ($user->USERPB_ID == $retur->USERPB_ID)
                                            <th style="text-align:center">{{$user->USERPB_NAME}}</th>
                                        @endif
                                    @endforeach
                                    <th style="text-align:center">{{$retur->deskripsi}}</th>
                                    <th style="text-align:center"><a href="{{$retur->link_video}}">{{$retur->link_video}}</a></th>
                                    <th style="text-align:center"><button type="submit" name="butDel" value="{{$retur->retur_id}}">Tolak</button> </th>
                                    <th style="text-align:center"><button type="submit" name="butAcc" value="{{$retur->retur_id}}">Terima</button> </th>
                                </tbody>
                                @endif

                            @endforeach
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
