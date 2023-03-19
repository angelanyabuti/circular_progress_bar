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
                            <div class="card-header">Order #{{ $order->id }} - Confirm Order received</div>
                            <div class="card-body">
                                <p>Please confirm you have received your order. This will help us in serving you better.</p>
                                <p>If you do not respond and in time,your order will automatically be assumed to be delivered and in good condition.</p>

                                <h4 class="my-4">Order details</h4>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order Item</th>
                                        <th scope="col">Qty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-right">
                                <form id="receiveOrderForm" action="{{ route('updateConfirmReceived', $order->receive_confirm_code) }}" method="POST">
                                    @csrf
                                    <input id="receivedInput" type="hidden" name="received">
                                    <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('receivedInput').setAttribute('value',0); document.getElementById('receiveOrderForm').submit(); ">Deny</button>
                                        <button type="submit" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('receivedInput').setAttribute('value',1); document.getElementById('receiveOrderForm').submit(); ">I have received my order</button>
                                </form>
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
