<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực Email</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .title {
            color: #FF6347;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .message {
            color: #32CD32;
            font-size: 20px;
            margin-bottom: 20px;
            text-align: justify;
        }
        .token {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            Xác Thực Email
        </div>
        <div class="message">
            Vui lòng nhấn vào liên kết dưới đây để xác thực tài khoản của bạn:
        </div>
        @if(isset($user))
            <a href="{{ url('/xacthucemail?email=' . $user->email . '&token=' . $token) }}">{{ $link_verify }}</a>
        @endif

    </div>
</body>
</html>
