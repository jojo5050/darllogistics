@extends('layout.landing')
@section('title', 'Home | '.env('APP_NAME'))
@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">Contact Us</h1>
        <div class="row mb-4">
            <h3>We are Here to Support Your Trucking Journey</h3>
            <p>Have questions about our dispatch services, compliance support, training programs, or business consulting? Our team is ready to assist you 24/7. Whether you're an owner-operator or manage a fleet, we'll provide the guidance and solutions you need to stay profitable and on the road.</p>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <h4>Ways to Reach Us</h4>
                <h5>Address is:</h5>
                <p>991 Burke Avenue New York 10469
                Email: darltransportdispatch@gmail.com</p>
                <h5>For Dispatch Services:</h5>
                Phone: +1 (347) 424-0072
                Email: dispatch@darllogistics.com
                For Compliance Services:
                Phone: +1 (646) 421-1427
                compliance@darllogistics.com
                <h5>For Training:</h5>
                Phone: +1 (347) 324-2533
                Info@darllogistics.com
            </div>
            <div class="col-md-6 mb-2">
                <h5>Fill the form below to send us a message</h5>
                <form method="post" action="" onsubmit="javascript:void(0)">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" class="form-control" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Email</label>
                        <input type="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="4" placeholder="Write your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
