@extends('layout.landing')
@section('title', 'Home | '.env('APP_NAME'))
@section('content')
<!-- Hero / Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="hero d-flex align-items-center text-center text-white"
           style="background: url({{asset('images/herobg3')}}) center/cover no-repeat; min-height:90vh;">
        <div class="container hero-content">
          <h1 class="display-4 fw-bold">Professional Logistic Solution</h1>
          <p class="lead">For modern transportation and dispatch services</p>
          <div class="mt-4">
            <a href="{{route('home.about')}}" class="btn btn-primary btn-lg me-2">Learn More</a>
            <a href="{{route('home.contact')}}" class="btn btn-outline-light btn-lg">Contact Us</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="hero d-flex align-items-center text-center text-white"
           style="background: url({{asset('images/herobg2')}}) center/cover no-repeat; min-height:90vh;">
        <div class="container hero-content">
          <h1 class="display-4 fw-bold">Reliable Dispatch Services</h1>
          <p class="lead">24/7 support, load booking, and route optimization</p>
          <div class="mt-4">
            <a href="{{route('home.about')}}" class="btn btn-primary btn-lg me-2">Learn More</a>
            <a href="{{route('home.contact')}}" class="btn btn-outline-light btn-lg">Contact Us</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="hero d-flex align-items-center text-center text-white"
           style="background: url({{asset('images/herobg1')}}) center/cover no-repeat; min-height:90vh;">
        <div class="container hero-content">
          <h1 class="display-4 fw-bold">Compliance & Training</h1>
          <p class="lead">Helping your fleet stay compliant and efficient</p>
          <div class="mt-4">
            <a href="{{route('home.about')}}" class="btn btn-primary btn-lg me-2">Learn More</a>
            <a href="{{route('home.contact')}}" class="btn btn-outline-light btn-lg">Contact Us</a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

  <!-- Indicators -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
  </div>
</div>


<section class="services py-5" style="background: url({{asset('images/logistics-solutions-bg.jpg')}}); background-repeat:no-repeat;background-size:cover">
  <div class="container">
    <div class="row">
        <div class="col-md-8 m-auto bg-white border-round p-5" style="opacity: .8">
            <h2>Comprehensive Logistics Solutions Under One Roof</h2>
            <p>We are more than a logistics company—we are your partner in ensuring smooth operations, compliance, and profitability in the trucking and freight industry. Whether you’re an owner-operator, small fleet, or growing logistics firm, our services are designed to take the stress off your shoulders so you can focus on driving growth.</p>
        </div>
    </div>
  </div>
</section>

<section class="services py-5">
  <div class="container">
    <h2>About Us</h2>
    <div class="row">
        <div class="col-md-6 mb-2">
            <h2>International Logistics Company</h2>
            <p>At Darl Transportation and Dispatch, we provide everything you need to keep your trucking business running smoothly and profitably. From compliance and paperwork to accounting solutions and 24/7 dispatch support, we're here to help you focus on the road while we handle the rest. we are here for you.</p>
            <p>At Darl Transportation & Dispatch, we are more than a dispatch service—we are your growth partner. We understand that in today's fast-paced logistics industry, every minute, mile, and load counts. That's why we deliver comprehensive support tailored to owner-operators and small fleets striving for efficiency, profitability, and peace of mind.</p>
        </div>
        <div class="col-md-6 mb-2 text-center">
            <img src="{{asset('images/about')}}" class="img-fluid" style="width: 400px">
        </div>
    </div>
  </div>
</section>

<!-- Services -->
<section class="services py-5" style="background: url({{asset('images/herobg4.jpg')}}); background-repeat:no-repeat;background-size:cover">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Our Services</h2>
      <p class="text-white">Comprehensive logistics solutions under one roof</p>
    </div>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card h-100 p-4 text-center">
          <h5 class="fw-bold">Dispatch</h5>
          <p>Load booking, route planning, and broker communication tailored to your business needs.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 p-4 text-center">
          <h5 class="fw-bold">Compliance</h5>
          <p>DOT, MC, IFTA filings and more to keep your fleet compliant with regulations.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 p-4 text-center">
          <h5 class="fw-bold">Accounting</h5>
          <p>Comprehensive financial solutions for transport and logistics businesses.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 p-4 text-center">
          <h5 class="fw-bold">Training</h5>
          <p>Professional training for drivers, owner-operators, and small fleet managers.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <div class="container">
    <h2 class="fw-bold">Ready to partner with us?</h2>
    <p class="mb-4">Let’s simplify your logistics and dispatch operations today.</p>
    <a href="{{route('home.contact')}}" class="btn btn-light btn-lg">Contact Us</a>
  </div>
</section>

@endsection
