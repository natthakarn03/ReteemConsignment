<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>Cek Ongkir</h1>
                        </div>
                        <div class="card-body">
                            <form role="form" class="form-horizontal" action="/testing" method="post">
                                {{ csrf_field() }}
                                <div class="form-group-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Provinsi Asal</label>
                                            <select name="province_origin" class="form-control">
                                                <option value="">--Provinsi--</option>
                                                @foreach ($provinces as $province => $value)
                                                    <option value="{{$province}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kota Asal</label>
                                            <select name="city_origin" class="form-control">
                                                <option value="">--Kota--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Provinsi Tujuan</label>
                                            <select name="province_destination" class="form-control">
                                                <option value="">--Provinsi--</option>
                                                @foreach ($provinces as $province => $value)
                                                    <option value="{{$province}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kota Tujuan</label>
                                            <select name="city_destination" class="form-control">
                                                <option value="">--Kota--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kurir</label>
                                            <select name="courier" class="form-control">
                                                <option value="">--Kurir--</option>
                                                @foreach ($couriers as $courier => $value)
                                                    <option value="{{$courier}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Berat (g)</label>
                                            <input type="number" name="weight" class="form-control" id="" value="1000">
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    </body>
</html>
