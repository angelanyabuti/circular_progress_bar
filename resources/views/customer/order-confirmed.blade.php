<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Floating labels example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        html, body {
            height: 100%;
        }
        .full-page{
            height: 100vh;
            width: 100vw;
        }
    </style>

</head>

<body>
<section class="full-page h-100">
    <header class="container h-100">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="d-flex flex-column">
                <div class="row">
                    <div class="col-12 text-center my-3">
                        <img src="{{ asset('logos/KouponZetu-Logo3.png') }}" alt="KouponZetu Logo" width="150">
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Order #{{ $order->id }} - Order delivery confirmed</div>
                            <div class="card-body">
                                <p>You have confirmed the delivery status of your order. This will help us in serving you better.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
</section>

<div class="container">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">

        </div>
    </div>
</div>
</body>
</html>
