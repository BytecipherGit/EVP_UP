@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - My subscription')

<section class="ptbm pricingPaid">
    <div class="main-container">
        <div class="row">
            @foreach ($checkPlanExist as $planExits)
                <div class="col-xs-12 col-md-4 col-sm-6">
                    <div class="panel pricingGrid pricingBasic">
                        <div class="panel-heading primary_color">
                            <h3>{{ $planExits->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <p>Features Include</p>
                            <ul>
                                <li>{{ $planExits->description }}</li>
                                <li>Unlimited Invoice</li>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="pricingRate">
                                <div class="priceAnnual"><span
                                        class="price"><sup>$</sup>{{ $planExits->price }}<small>/month</small></span>
                                    <span class="pricePlans">{{ $planExits->type }}</span>
                                </div>
                            </div>
                            {{-- <div class="pricingButton">
                <a href="register?plan=basic_annual" class="btn-primary-cust">Get Started</a>
                </div> --}}
                            <div class="add-btn-part">
                                <div class="card-body text-center">
                                 <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                        @csrf 

                                    {{-- <button type="submit" href="razorpay_payment/{{ $planExits->plan_id }}" class="btn btn-primary button_background_color">Select Subscription</button> --}}
                                
                                    <button class="btn btn-primary button_background_color get_subscription" type="submit"
                                        data-id="{{ $planExits->id }}" data-payment_type="Razorpay" data-plan_id="{{ $planExits->plan_id }}"
                                        data-name="{{ $planExits->name }} " href="javascript:void(0)"
                                        data-price="{{ $planExits->price }}">Buy Now</button>   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- <div class="pricingViewToggler"><span class="active annual">Annual</span>
        <div class="toggle-button"><button></button></div>
        <p><span class="monthly">Monthly</span></p>
      </div> --}}
    </div>
</section>
@endsection

@section('pagescript')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var SITEURL = "{{ route('razorpay.payment.store') }}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '.get_subscription', function(e) {

        var price = $(this).attr("data-price");
        var plan_id = $(this).attr("data-plan_id");
        var name = $(this).attr("data-name");
        var payment_type = $(this).attr("data-payment_type");
        var options = {
            "key": "rzp_test_fW0KwQLIwZZsry",
            "name": name,
            "description": "Payment",
            "plan_id": plan_id,
            "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
            "handler": function(response) {

                window.location.href = SITEURL + '/' + 'razorpay_payment?razorpay_payment_id=' + response
                    .razorpay_payment_id + '&payment_type=' + payment_type + '&price=' + price +
                    '&id=' + id + '&name=' + name;
            },
            "prefill": {
                "contact": '9988665544',
                "email": 'harshi@gmail.com',
            },
            "theme": {
                "color": "#528FF0"
            }

        };

        var rzp1 = new Razorpay(options);

        rzp1.open();
        e.preventDefault();

    });
    /*document.getElementsClass('buy_plan1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
    }*/
</script>

@stop
