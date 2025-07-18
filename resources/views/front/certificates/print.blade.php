<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <style>
    body,
    html {
      /* font-family: 'Inter', sans-serif;
            src: url('./fonts/Inter-Medium.ttf') format('truetype'); */
      /* background-size: cover; */
      background-position: center;
      /* margin: 0;
            padding: 0; */
    }

    .container {
      width: 100%;
    }

    .left-div {
      float: left;
      width: 50%;
    }

    .left-div img {
      /* padding-top: 90px;
            padding-left: 48px; */
      width: 90%;
      margin-top: -100px;
      height: auto;
    }

    .right-div {
      float: right;
      width: 50%;
      text-align: center;
    }

    .right-div h1 {
      padding-top: 100px;
      font-size: 128px;
    }
  </style>

  <body>
    <div class="container">
      <div class="left-div">
        <img src="{{ $imagePath }}" alt="">
      </div>
      <div class="right-div">
        <h1>{{ $full_name }}</h1>
      </div>
    </div>
  </body>

</html>