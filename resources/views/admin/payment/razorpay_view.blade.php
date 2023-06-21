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
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/main-container.css">
    {{-- <style>
        .payMainBgpy-4 {
            background: url("../image/payBg.jpg");
            height: 100vh;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .payMainBgpy-4 input.razorpay-payment-button {
            background: #4785FF;
            border-radius: 8px;
            color: #fff;
            border: none;
            padding: 10px 15px;
            width: 100%;
            font-size: 18px;
            line-height: 27px;
        }

        .payMainBgpy-4 .card .card-header {
            padding: 20px 15px;
            text-align: center;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            font-size: 20px;
            line-height: 26px;
        }

        .payMainBgpy-4 .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            /* background-clip: border-box; */
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 8px;
            box-shadow: 3px 2px 17px rgba(0, 0, 0, 0.5);
        }

        .payMainBgpy-4 .card-body {
            padding: 30px;
        }

        .payMainBgpy-4 .card-body h2 {
            font-weight: 500;
            font-size: 20px;
            line-height: 24px;
            color: #3D3D42;
            margin: 0 0 10px;
        }

        .payMainBgpy-4 .card-body h5 {
            font-weight: 400;
            font-size: 15px;
            line-height: 15px;
            color: #A3A3AB;
            margin: 0 0 50px;
        }
    </style> --}}
</head>

<body>
    <div id="app">
        <main class="py-4 payMainBgpy-4">
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
                                    <img src="{{ asset('assets') }}/admin/images/paymntIcon.png" class="mb-5">
                                    <h2>Proceed to Pay Now</h2>
                                    <h5>Subscription Total Price:
                                        {{ $subscriptionCheck ? $subscriptionCheck->price : '' }}</h5>
                                    <h5>Note: Please continue from pay now button, and donn't press back button.</h5>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subscriptionDataExist->id }}">
                                    <input type="hidden" name="razorpay_subscription_id"
                                        value="{{ $subscriptionDataExist->razorpay_subscription_id }}">
                                    <input type="hidden" name="subscription_id"
                                        value="{{ $subscriptionCheck ? $subscriptionCheck->id : '' }}">
                                    <input type="hidden" name="subscription_name"
                                        value="{{ $subscriptionCheck ? $subscriptionCheck->name : '' }}">
                                    <input type="hidden" name="subscription_price"
                                        value="{{ $subscriptionCheck ? $subscriptionCheck->price : '' }}">
                                    {{-- <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_fW0KwQLIwZZsry"
                                    data-amount="{{$subscriptionCheck->price}}"
                                    data-buttontext="Pay 10 INR"
                                    data-name: {{$subscriptionDataExist->name}}
                                    data-subscription_id: {{$subscriptionDataExist->razorpay_subscription_id}}
                                    data-description="{{$subscriptionDataExist->description}}"
                                    data-prefill.name="Demo"
                                    data-prefill.email="harshi@gmail.com"
                                    data-theme.color="#F37254"> 
                                  "handler": function(response) {
                                       window.location.href = SITEURL + '/' + 'razorpay_payment?razorpay_payment_id=' + response
                                          .razorpay_payment_id + '&subscription_id=' + subscription_id +'&price=' + amount +'&name=' + name;
                                    },
                               </script>  --}}
                                    <script src="https://checkout.razorpay.com/v1/checkout.js" 
                                        data-key="rzp_test_fW0KwQLIwZZsry" 
                                        data-buttontext="Pay Now"
                                        data-subscription_id= "{{ $subscriptionDataExist->razorpay_subscription_id }}" 
                                        data-amount= "{{ $subscriptionDataExist->price }}"
                                        data-name= "{{ $subscriptionDataExist->name }}"
                                        data-description= "{{ $subscriptionDataExist->description }}"
                                        data-prefill.name= "{{ $subscriptionDataExist->name }}"
                                        data-prefill.email="harshi@gmail.com" 
                                        data-theme.color="#F37254">
                                        "handler": function(response) {
                                            window.location.href = SITEURL + '/' + 'razorpay_payment?razorpay_payment_id=' + response
                                                .razorpay_payment_id + '&subscription_id=' + subscription_id + '&price=' + amount + '&name=' + name;
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
