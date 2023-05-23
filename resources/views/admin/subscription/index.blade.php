@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - My subscription')

<section class="ptbm pricingPaid">
    <div class="main-container">
        <div class="row">
            @foreach ($subscriptionDetails as $planExits)
                <div class="col-xs-12 col-md-4 col-sm-6">
                    <div class="panel pricingGrid pricingBasic">
                        <div class="panel-heading primary_color">
                            <h3>{{ $planExits->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <p>Features Include {{$planExits->id}}</p>
                            @php
                                $payment_status = Helper::getPaymentStatus($planExits->id);
                                $company_payment_id = Helper::getPaymentId($planExits->id);
                                $subscription_status = Helper::getSubscriptionStatus($planExits->id);
                                // echo $company_payment_id;
                            @endphp
                            
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
                                 <form action="{{route('subscription.get')}}">
                                   @csrf 
                                   <input type="hidden" name="id" value="{{$planExits->id}}">
                                 @if($planExits->name == 'Free')  
                                    <button disabled type="button" class="btn btn-primary button_background_color">Free Subscription</button>  
                                 @elseif(($payment_status == 'Active') && ($subscription_status == 1))    
                                    <a href="javascript:void(0)" data-id="{{$planExits->razorpay_subscription_id}}" data-sub_id="{{$company_payment_id}}" class="btn btn-primary deleteSubscriptionPlan" title="Delete"> Delete Subscription</a>
                                 @else
                                    <button type="submit" class="btn btn-primary button_background_color">Subscription</button> 
                                 @endif
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

<!-- The Modal Status Check-->
<div class="modal fade custu-no-select" id="remaiderbtninfo" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="remainder-body">
                <h1>Already you have subscription.</h1>
                <p>First you want to cancel that .</p>
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
</div>
  
</section>
@endsection

@section('pagescript')
<script>
$(document).on('click', '.deleteSubscriptionPlan', function() {
    swal({
            title: "Are you sure?",
            text: "You want to delete this Subscription Plan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((result) => {
            if (result) {
                // Handle the change event
                var subscriptionId = $(this).data('id');
                var subId = $(this).data('sub_id');
                // alert(subscriptionId);
                if (subscriptionId != '', subId != '') {
                    var url = '{{ url('subscription/destroy') }}';
                    var my_data = {
                        subscriptionId: subscriptionId,
                        subId: subId
                    };
                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: my_data,
                        success: function(data) {
                            if (data.success) {
                                swal("Subscription successfully deleted.", {
                                    icon: "success",
                                });
                                setInterval(function() {
                                    location.reload();
                                }, 2000);
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            } else {
                swal("Your subscription is safe!");
                setInterval(function() {
                    location.reload();
                }, 2000);
            }
        });
});
</script>

@stop