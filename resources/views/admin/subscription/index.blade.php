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
                                            <button disabled type="button" class="btn btn-primary button_background_color">Free Subscription</button>
                                        @elseif($subscription_status == 'Active')
                                             @if ($companySub->subscription_id == $planExits->id)
                                                <a href="javascript:void(0)" data-id="{{ $razorpaySubId ? $razorpaySubId : '' }}" data-sub_id="{{ $company_payment_id }}" class="btn btn-primary deleteSubscriptionPlan" title="Delete"> Cancel</a>
                                              @else
                                                 <button type="submit"  class="btn btn-primary button_background_color">Upgrade Plan</button>
                                             @endif   
                                        @elseif($subscription_status == 'Cancelled')
                                             @if($sub_end_date == Carbon\Carbon::now() || $sub_end_date < Carbon\Carbon::now())   
                                               <button type="submit" class="btn btn-primary button_background_color">Get Subscription</button>  
                                               @else
                                               <button disabled type="submit" class="btn btn-danger"> {{$sub_end_date}} Cancelled</button>
                                             @endif
                                        @else    
                                            @if(!empty($paySub))
                                               @if($subscriptions == $subscriptionCount)
                                                 <span data-toggle="modal" class="btn btn-primary pricingboxDss button_background_color" data-target="#remaiderbtninfo{{ $planExits->id }}">Started At {{$paySub->start_date}}</span>
                                                   @else
                                                 <span data-toggle="modal" class="btn btn-primary pricingboxDss button_background_color" data-target="#remaiderbtninfo{{ $planExits->id }}">Get Subscription </span>
                                                @endif
                                              @else
                                               <span data-toggle="modal" class="btn btn-primary pricingboxDss button_background_color" data-target="#getSubscription{{ $planExits->id }}">Get Subscription </span>
                                             @endif
                                               
                                         @endif       
                                             {{-- @else
                                                        <span data-toggle="modal" class="btn btn-primary button_background_color" data-target="">Expired</span>
                                                    @endif --}}
                                             {{-- @else --}}
                                                    {{-- @if ($sub_start_date == $currentDate && $sub_end_date < $sub_start_date) --}}
                                                    {{-- @if ($subscriptionCount != $subscriptions && $sub_end_date > $sub_start_date) --}}
                                                        {{-- <button disabled type="submit"
                                                            class="btn btn-primary button_background_color">{{ $sub_end_date }}
                                                            Cancelled</button> --}}
                                                        {{-- <a href="javascript:void(0)"
                                                            data-id="{{ $razorpaySubId ? $razorpaySubId : '' }}"
                                                            data-sub_id="{{ $company_payment_id }}"
                                                            class="btn btn-primary deleteSubscriptionPlan"
                                                            title="Delete"> Cancel Subscription</a>
                                                    @else --}}
                                                        {{-- <span disabled data-toggle="modal"
                                                            class="btn btn-primary pricingboxDss button_background_color"
                                                            data-target="">{{ $sub_end_date }} Current Subscription</span> --}}
                                                        {{-- <a href="javascript:void(0)"
                                                            data-id="{{ $razorpaySubId ? $razorpaySubId : '' }}"
                                                            data-sub_id="{{ $company_payment_id }}"
                                                            class="btn btn-primary deleteSubscriptionPlan"
                                                            title="Delete"> Cancel</a>
                                                    @endif
                                                @endif
                                            @elseif($sub_start_date != 'false' && $sub_end_date < $sub_start_date)
                                                <button type="submit" class="btn btn-primary button_background_color">Get Subcription
                                                    Again</button>
                                            @else --}}
                                                {{-- <button type="submit" class="btn btn-primary button_background_color">Popup</button>  --}}
                                                {{-- @if ($sub_start_date != 'false')
                                                    <span data-toggle="modal"
                                                        class="btn btn-primary button_background_color"
                                                        data-target="">Upgrade Subscription</span>
                                                @elseif(!empty($paySub->payment_status))
                                                    @if ($paySub->payment_status != 'Cancelled')
                                                        <span data-toggle="modal"
                                                            class="btn btn-primary pricingboxDss button_background_color"
                                                            data-target="#remaiderbtninfo">Upgrade Now </span>
                                                    @else
                                                        <button type="submit"
                                                            class="btn btn-primary button_background_color">Get
                                                            Subscription</button>
                                                    @endif
                                                @else
                                                    <button type="submit"
                                                        class="btn btn-primary button_background_color">Upgrade
                                                        Plan</button>
                                                @endif
                                            @endif
                                        @else
                                            <button type="submit" class="btn btn-primary button_background_color">Get
                                                First Subscription</button>
                                        @endif --}}

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-xl-4 col-lg-6">
                  <div class="pricingboxDs">
                    <h4>Monthly</h4>
                    <h1>
                      ₹ 800 <span>/ Monthly </span>
                    </h1>
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry.
                    </p>
                    <ul>
                      <li>
                        <img src="" alt="Close Square" /> 5%
                        fee per transaction*
                      </li>
                      <li>
                        <img src="" alt="Tick Square" />
                        Unlimited pages
                      </li>
                      <li>
                        <img src="" alt="Tick Square" />
                        Unlimited payments
                      </li>
                      <li>
                        <img src="" alt="Tick Square" /> Email
                        notifications
                      </li>
                      <li>
                        <img src="" alt="Tick Square" /> Weekly
                        reports
                      </li>
                      <li>
                        <img src="" alt="Tick Square" />
                        Customisation options
                      </li>
                      <li>
                        <img src="" alt="Tick Square" /> No
                        whitelabel branding
                      </li>
                    </ul>
            
                    <button class="disebleButtonGray Subscribe">Subscribe</button>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                  <div class="pricingboxDs">
                    <h4>Yearly</h4>
                    <h1>
                      ₹ 9,600 <span>/ Yearly</span>
                    </h1>
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry.
                    </p>
                    <ul>
                      <li>
                        <img src="" alt="Close Square" /> 5%
                        fee per transaction*
                      </li>
                      <li>
                        <img src="" alt="Tick Square" />
                        Unlimited pages
                      </li>
                      <li>
                        <img src="" alt="Tick Square" />
                        Unlimited payments
                      </li>
                      <li>
                        <img src="" alt="Tick Square" /> Email
                        notifications
                      </li>
                      <li>
                        <img src="" alt="Tick Square" /> Weekly
                        reports
                      </li>
                      <li>
                        <img src="" alt="Tick Square" />
                        Customisation options
                      </li>
                      <li>
                        <img src="" alt="Tick Square" /> No
                        whitelabel branding
                      </li>
                    </ul>
            
                    <button class="disebleButtonGray Subscribe">Subscribe</button>
                  </div>
                </div> --}}
            </div>

        </div>
    </div>

    <!-- The Modal Status Check-->



@foreach ($subscriptionDetails as $planExits)

<div class="modal fade custu-no-select" id="getSubscription{{ $planExits->id }}" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="remainder-body">
                        <form action="{{ route('subscription.get') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ encrypt($planExits->id) }}">
                            <h1>Already you have a Free subscription.</h1>
                            <p>Are you sure you want to get subscription ?</p>
                             <button type="submit" class="btn-secondary-cust">Ok</button>  
                             <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(!empty($paySub))
  @if($paySub->payment_status != 'Cancelled')   
    <div class="modal fade custu-no-select" id="remaiderbtninfo{{ $planExits->id }}" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @php
                       $payment_end_date = Helper::getPaymentEndDate($planExits->id);
                    @endphp
                    @if($subscriptions == $subscriptionCount)
                        <div class="remainder-body">
                            <h1>Already you have a subscription.</h1>
                            <p>Subscription will start on: {{$paySub->start_date}}</p>
                            <button type="button" class="btn-secondary-cust" data-dismiss="modal">OK</button>
                        </div>
                    @else
                        <div class="remainder-body">
                            <h1>Already you have a subscription.</h1>
                            <p>If you want to get subscription again, so you need to cancel current subscription.</p>
                            <p>Subscription Expired on: {{ $paySub->end_date }}</p>
                            <button type="button" class="btn-secondary-cust" data-dismiss="modal">Ok</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="modal fade custu-no-select" id="remaiderbtninfo{{ $planExits->id }}" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="remainder-body">
                    <form action="{{ route('subscription.get') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ encrypt($planExits->id) }}">
                        <h1>Already you have a subscription.</h1>
                        <p>Are you sure you want to get subscription ?</p>
                        <button type="submit" class="btn-secondary-cust">Ok</button>  
                        <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
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
