<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Page</title>
  <link rel="icon" href="{!! asset('images/logo.ico') !!}"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('head')
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }

    /* Remove the jumbotron's default bottom margin */
     .jumbotron {
      margin-bottom: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <img src=" {{asset('images/logo.png')}}" style='margin-top:-10%; margin-left:2%;'alt=""  width='300px;' height='300px'>
  <div class="container text-center" style='margin-top:-10%;'>
    <h1>Reteem Consignment</h1>
    <p><i>Serve you with trust</i></p>
  </div>
</div>

    @include('includes.headeradmin')
    @include('body.tambahadmin')
</body>
</html>
