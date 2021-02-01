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
    <div class="login-form">
    <div class="card">
        <div style="margin-top:2%; padding: 1%;">
            Status Barang:
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">ID</th>
                        <th style="text-align:center">Nama Barang</th>
                        <th style="text-align:center">Status</th>
                    </tr>
                </thead>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
