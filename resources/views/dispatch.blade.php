@extends('layout.landing')
@section('title', 'Dispatch Services | '.env('APP_NAME'))
@section('content')
<!-- Dispatch Section -->
<section class="services py-5">
  <div class="container">
    <h2 class="mb-2 mt-2">Professional Freight Dispatch Services</h2>
    <div class="row">
        <div class="col-md-6 mb-2">
            <img src="{{asset('images/dispatch-page-thumbnail.jpg')}}" class="img-fluid" style="width: 400px">
        </div>
        <div class="col-md-6 mb-2 text-left">
            <h2>Maximize Your Loads, Minimize Your Stress</h2>
            <p>Managing freight dispatch can be time-consuming and overwhelming for owner-operators and fleet managers. Between negotiating with brokers, finding consistent loads, and ensuring compliance with regulations, you deserve a dispatch partner who makes your business run smoothly and profitably.
            We provide reliable freight dispatch services tailored to your operations—so you can focus on driving while we handle everything else.</p>

            <h2>What Is Freight Dispatch?</h2>
            <p>Freight dispatching connects truck drivers or carriers with shippers and brokers, securing profitable loads and managing day-to-day communications. Our dispatch services ensure you stay on the road, reduce downtime, and keep your truck running at full earning potential—all while handling paperwork and broker relations on your behalf.</p>
        </div>
    </div>
  </div>
</section>
@endsection
