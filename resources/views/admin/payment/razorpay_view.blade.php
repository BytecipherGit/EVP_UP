<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                        @endif

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                            </div>
                        @endif

                        <div class="card card-default">
                            <div class="card-header">
                                EVP - Subscription Payment
                            </div>

                            <div class="card-body text-center">
                                <form action="{{ route('razorpay.payment.store') }}" method="POST">
                                    @csrf
                                 <input type="hidden" name="id" value="{{ $subscriptionDataExist->id }}">
                                    <input type="hidden" name="razorpay_subscription_id" value="{{ $subscriptionDataExist->razorpay_subscription_id }}"> 
                                    <input type="hidden" name="subscription_id" value="{{ $subscriptionCheck ? $subscriptionCheck->id : '' }}">
                                    <input type="hidden" name="subscription_name" value="{{ $subscriptionCheck ? $subscriptionCheck->name : '' }}">
                                     <input type="hidden" name="subscription_price" value="{{ $subscriptionCheck ? $subscriptionCheck->price : '' }}">
                                 <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_fW0KwQLIwZZsry"
                                    data-amount="{{$subscriptionCheck->price}}"
                                    data-buttontext="Pay 10 INR"
                                    data-name="{{$subscriptionDataExist->name}}"
                                    data-subscription_id="{{$subscriptionDataExist->razorpay_subscription_id}}"
                                    data-description="{{$subscriptionDataExist->description}}"
                                    data-prefill.name="Demo"
                                    data-prefill.email="harshi@gmail.com"
                                    data-theme.color="#F37254">
                                  "handler": function(response) {
                                       window.location.href = SITEURL + '/' + 'razorpay_payment?razorpay_payment_id=' + response
                                          .razorpay_payment_id + '&subscription_id=' + subscription_id +'&price=' + amount +'&name=' + name;
                                    },
                               </script> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
