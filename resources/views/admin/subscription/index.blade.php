@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - My subscription')

<section class="ptbm pricingPaid">
    <div class="main-container">
        <div class="row">

            <div class="row col-xl-10 col-lg-12 m-auto">
                @foreach ($subscriptionDetails as $planExits)
                    <div class="col-xl-4 col-lg-6">
                        <div class="pricingboxDs">
                            @php
                                $payment_status = Helper::getPaymentStatus($planExits->id);
                                $company_payment_id = Helper::getPaymentId($planExits->id);
                                $subscription_status = Helper::getSubscriptionStatus($planExits->id);
                                $sub_start_date = Helper::getStartDate($planExits->id);
                                $sub_end_date = Helper::getEndDate($planExits->id);
                                $subscriptionId = Helper::getSubscriptionId($planExits->id);
                                $razorpaySubId = Helper::getRazorpaySubId($planExits->id);
                                // echo $subscription_status;
                            @endphp
                            <h4>{{ $planExits->name }}</h4>
                            <h1>
                                ₹ {{ $planExits->price }} <span>/ {{ $planExits->type }} </span>
                            </h1>
                            <p>
                                {{ $planExits->description }}
                            </p>
                            <ul>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/closesquare.png" alt="Close Square" /> 5%
                                    fee per transaction*
                                </li>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/ticksquare.png" alt="Tick Square" />
                                    Unlimited pages
                                </li>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/ticksquare.png" alt="Tick Square" />
                                    Unlimited payments
                                </li>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/ticksquare.png" alt="Tick Square" />
                                    Email
                                    notifications
                                </li>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/ticksquare.png" alt="Tick Square" />
                                    Weekly
                                    reports
                                </li>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/ticksquare.png" alt="Tick Square" />
                                    Customisation options
                                </li>
                                <li>
                                    <img src="{{ asset('assets') }}/admin/images/ticksquare.png" alt="Tick Square" />
                                    No whitelabel branding
                                </li>
                            </ul>

                            {{-- <button class="disebleButtonGray Subscribe">Free Plan</button> --}}
                            <div class="add-btn-part">
                                <div class="card-body text-center">
                                    <form action="{{ route('subscription.get') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ encrypt($planExits->id) }}">
                                        @if ($planExits->name == 'Free')
                                            <button disabled type="button"
                                                class="btn btn-primary button_background_color">Free
                                                Subscription</button>
                                        @elseif($subscription_status == 'Active')
                                            @if ($companySub->subscription_id == $planExits->id)
                                                <a href="javascript:void(0)"
                                                    data-id="{{ $razorpaySubId ? $razorpaySubId : '' }}"
                                                    data-sub_id="{{ $company_payment_id }}"
                                                    class="btn btn-primary deleteSubscriptionPlan" title="Delete">
                                                    Cancel</a>
                                            @else
                                                <button type="submit"
                                                    class="btn btn-primary button_background_color">Upgrade
                                                    Plan</button>
                                            @endif
                                        @elseif($subscription_status == 'Cancelled')
                                            @if ($sub_end_date == Carbon\Carbon::now() || $sub_end_date < Carbon\Carbon::now())
                                                <button type="submit"
                                                    class="btn btn-primary button_background_color">Get
                                                    Subscription</button>
                                            @else
                                                <button disabled type="submit" class="btn btn-danger">
                                                    {{ $sub_end_date }} Cancelled</button>
                                            @endif
                                        @else
                                            @if (!empty($paySub))
                                                @if ($subscriptions == $subscriptionCount)
                                                    <span data-toggle="modal"
                                                        class="btn btn-primary pricingboxDss button_background_color"
                                                        data-target="#remaiderbtninfo{{ $planExits->id }}">Started At
                                                        {{ $paySub->start_date }}</span>
                                                @else
                                                    <span data-toggle="modal"
                                                        class="btn btn-primary pricingboxDss button_background_color"
                                                        data-target="#remaiderbtninfo{{ $planExits->id }}">Get
                                                        Subscription </span>
                                                @endif
                                            @else
                                                {{-- <span data-toggle="modal"
                                                    class="btn btn-primary pricingboxDss button_background_color"
                                                    data-target="#getSubscription{{ $planExits->id }}">Get Subscription
                                                </span> --}}
                                                <button type="submit" class="btn btn-primary button_background_color">Upgrade Plan</button>
                                            @endif
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- The Modal Status Check-->



    @foreach ($subscriptionDetails as $planExits)

        <div class="modal fade custu-no-select" id="getSubscription{{ $planExits->id }}" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="remainder-body">
                            <form action="{{ route('subscription.get') }}" id="addPaymentForm">
                                {{-- <form id="myForm" method="POST" action="{{ route('post-data') }}" target="popup" onsubmit="openPopup()"> --}}
                                @csrf
                                <input type="hidden" name="id" value="{{ encrypt($planExits->id) }}">
                                <h1>Already you have a Free subscription.</h1>
                                <p>Are you sure you want to get subscription ?</p>
                                <button type="submit"
                                    class="btn-primary-custexport button_background_color text-white mr-2">Ok</button>
                                {{-- <button class="btn-secondary-cust" type="button" id="addPaymentButton">Submit</button> --}}
                                <button type="button" class="btn-secondary-cust ml-2"
                                    data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (!empty($paySub))
            @if ($paySub->payment_status == 'Active')
                <div class="modal fade custu-no-select" id="remaiderbtninfo{{ $planExits->id }}" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                @php
                                    $payment_end_date = Helper::getPaymentEndDate($planExits->id);
                                @endphp
                                @if ($subscriptions == $subscriptionCount)
                                    <div class="remainder-body">
                                        <h1>Already you have a subscription.</h1>
                                        <p>Subscription will start on: {{ $paySub->start_date }}</p>
                                        <button type="button"
                                            class="btn-primary-custexport button_background_color text-white"
                                            data-dismiss="modal">OK</button>
                                    </div>
                                @else
                                    <div class="remainder-body">
                                        <h1>Already you have a subscription.</h1>
                                        <p>If you want to update subscription, then first you need to cancel your current
                                            subscription.</p>
                                        <p>Subscription Expired on: {{ $paySub->end_date }}</p>
                                        <button type="button"
                                            class="btn-primary-custexport button_background_color text-white"
                                            data-dismiss="modal">Ok</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($paySub->payment_status == 'Cancelled')
                <div class="modal fade custu-no-select" id="remaiderbtninfo{{ $planExits->id }}" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="remainder-body">
                                    <form action="{{ route('subscription.get') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ encrypt($planExits->id) }}">
                                        <h1>Already you have a subscription.</h1>
                                        <p>Are you sure you want to get subscription ?</p>
                                        <button type="submit"
                                            class="btn-primary-custexport button_background_color text-white mr-2">Ok</button>
                                        <button type="button" class="btn-secondary-cust ml-2"
                                            data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal fade custu-no-select" id="remaiderbtninfo{{ $planExits->id }}" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="remainder-body">
                                    <form action="{{ route('subscription.get') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ encrypt($planExits->id) }}">
                                        <h1>Already you have a Free subscription.</h1>
                                        <p>Are you sure you want to get subscription ?</p>
                                        <button type="submit"
                                            class="btn-primary-custexport button_background_color text-white mr-2">Ok</button>
                                        <button type="button" class="btn-secondary-cust ml-2"
                                            data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach

</section>
@endsection

@section('pagescript')

<script>
    $('#addPaymentButton').on('click', function(e) {
        alert('hii');
        e.preventDefault();
        var amount = $('#payment').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "{{ route('razorpay.payment.store') }}",
            data: $("#addPaymentForm").serialize(),
            success: function(data) {
                var order_id = '';
                if (data.order_id) {
                    order_id = data.order_id;
                }

                var options = {
                    "key": "{{ config('app.razorpay_api_key') }}", // Enter the Key ID generated from the Dashboard
                    "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "{{ config('app.currency') }}",
                    "name": "{{ config('app.account_name') }}",
                    "description": remarks,
                    "image": "{{ asset('images/logo-black.svg') }}",
                    "order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function(response) {
                        $('#razorpay_payment_id').val(response.razorpay_payment_id);
                        $('#razorpay_order_id').val(response.razorpay_order_id);
                        $('#razorpay_signature').val(response.razorpay_signature);
                        $('#addPaymentForm').submit();
                    },
                    "prefill": {
                        "name": "{{ auth()->user()->name }}",
                        "email": "{{ auth()->user()->email }}",
                        "contact": "{{ auth()->user()->mobile }}"
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function(response) {

                });

                rzp1.open();


            },

        });

    });
</script>
<script>
    $(document).on('click', '.deleteSubscriptionPlan', function() {
        swal({
                title: "Are you sure?",
                text: "You want to cancel this Subscription Plan!",
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
                                    swal("Subscription successfully cancelled.", {
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
