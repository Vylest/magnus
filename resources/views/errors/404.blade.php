<!DOCTYPE html>
<html>
<head>
    <title>404 - Page Not Found</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #FFF;
            display: table;
            font-weight: 100;
            font-family: 'Lato';

        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            background-image: url("{{ asset('images/404-space.jpg') }}");
            background-repeat: no-repeat;
            background-position: center;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }

        .subtitle {
            font-size: 50px;
            font-weight: bold;
            font-kerning: ;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">There may have been something here</div>
        <div class="subtitle">...But it is gone now</div>
    </div>
</div>
</body>
</html>