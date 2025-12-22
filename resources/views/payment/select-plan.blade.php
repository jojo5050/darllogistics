@extends('layout.landing')

@section('title', 'Select Plan')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Choose Your Subscription Plan</h2>

    <div class="row justify-content-center">

        <!-- Basic -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h4>Basic Plan</h4>
                    <p>Basic features for small operations.</p>
                    <h3 class="text-primary">NGN100 / month</h3>

                    <form action="{{ route('payment.page') }}" method="GET">
                        <input type="hidden" name="plan_id" value="1">
                        <input type="hidden" name="amount" value="100">
                        <button class="btn btn-primary w-100 mt-3">Choose Basic</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Premium -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h4>Premium Plan</h4>
                    <p>Advanced features for growing companies.</p>
                    <h3 class="text-primary">NGN200 / month</h3>

                    <form action="{{ route('payment.page') }}" method="GET">
                        <input type="hidden" name="plan_id" value="2">
                        <input type="hidden" name="amount" value="200">
                        <button class="btn btn-success w-100 mt-3">Choose Premium</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Trial -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h4>Trial Plan (14 Days)</h4>
                    <p>Try all features for free.</p>
                    <h3 class="text-primary">FREE</h3>

                    <form action="{{ route('payment.page') }}" method="GET">
                        <input type="hidden" name="plan_id" value="3">
                        <input type="hidden" name="amount" value="0">
                        <button class="btn btn-warning w-100 mt-3">Start Free Trial</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection