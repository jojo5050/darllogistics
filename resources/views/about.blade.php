@extends('layout.landing')
@section('title', 'Home | '.env('APP_NAME'))
@section('content')
<!-- About Section -->
<section class="services py-5">
  <div class="container">
    <h2>About Us</h2>
    <div class="row">
        <div class="col-md-6 mb-2">
            
            <p>At Darl Transportation and Dispatch, we provide everything you need to keep your trucking business running smoothly. From compliance and paperwork to accounting solutions and 24/7 dispatch support, we're here to help you focus on the road while we handle the rest. we are here for you.</p>
            <p>At Darl Transportation & Dispatch, we are more than a dispatch service—we are your growth partner. We understand that in today's fast-paced logistics industry, every minute, mile, and load counts. That's why we deliver comprehensive support tailored to owner-operators and small fleets striving for efficiency, profitability, and peace of mind.</p>
        </div>
        <div class="col-md-6 mb-2 text-center">
            <img src="{{asset('images/about')}}" class="img-fluid" style="width: 400px">
        </div>
    </div>
  </div>
</section>

<section class="services py-5" style="background: url({{asset('images/logistics-solutions-bg.jpg')}}); background-repeat:no-repeat;background-size:cover">
  <div class="container bg-white" style="opacity: .8">
    <h2>OUR SERVICE</h2>
    <h3>Streamlining Your Freight, Driving Your Growth</h3>
    <p>At Darl Transportation and Dispatch, we offer a comprehensive range of services tailored to support trucking professionals and fleet owners in every aspect of their operations. Our compliance support ensures that you stay road-ready and worry-free, as we handle all critical paperwork, including DOT and MC Number registrations, IFTA and HUT filings, UCR registration, and the setup of Drug and Alcohol Clearinghouse accounts. We also assist with audit preparation, tax compliance, and other regulatory obligations—allowing you to stay focused on your routes without the burden of administrative tasks.
    Beyond compliance, we provide specialized accounting solutions for truckers that are designed to improve cash flow and simplify financial management. Whether you're an independent driver or managing a fleet, our accounting services help you track expenses, manage payroll, generate invoices, handle billing, and oversee accounts payable and receivable.</p>

    <p>Our robust dispatch support connects carriers with high-paying loads while offering round-the-clock assistance to keep your business moving. We handle everything from load booking and negotiation to broker communication, while also providing route planning and trip sheets to optimize your journeys. With 24/7 driver support, we act as a reliable partner you can count on to navigate the logistics landscape efficiently.</p>
  </div>
</section>
@endsection
