@extends('layout.landing')

@section('title', 'Complete Payment')

@section('content')

<div class="container py-5">
    <h2 class="text-center mb-4">Complete Your Payment</h2>

    <div class="card shadow-sm p-4">

        <h4>Plan ID: {{ $plan_id }}</h4>
        <h4>Amount: {{ $amount == 0 ? 'FREE TRIAL' : 'NGN' . $amount }}</h4>

        <button id="payBtn" class="btn btn-primary mt-4 w-100">
            {{ $amount == 0 ? 'Activate Free Trial' : 'Pay with Paystack' }}
        </button>
    </div>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
document.getElementById('payBtn').addEventListener('click', function () {

    let plan_id = @json($plan_id);
    let amount = @json($amount);
    let userEmail = @json($userEmail);
    let apiToken = @json($apiToken);

    console.log("Email =>", userEmail);
    console.log("API TOKEN =>", apiToken);

    if (!userEmail) {
        alert("Email missing — user is not logged in.");
        return;
    }

    // FREE TRIAL
    if (amount == 0) {
        sendToServer("free-trial-" + Date.now(), "success", {});
        alert("Free trial activated. You can now login on the app to continue.");
        return;
    }

    // PAID PLAN
    let handler = PaystackPop.setup({
        key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
        email: userEmail,
        amount: amount * 100,
        currency: "NGN",
        ref: 'darl_' + Date.now(),

        callback: function (response) {
            sendToServer(response.reference, "success", response);
        },

        onClose: function () {
            alert("Payment window closed.");
        }
    });

    handler.openIframe();
});


function sendToServer(reference, status, gatewayResponse) {

    let apiToken = @json($apiToken);

    fetch("https://www.darllogistics.com/api/v2/payments", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + apiToken
        },
        body: JSON.stringify({
            plan_id: @json($plan_id),
            amount: @json($amount),
            currency: "NGN",
            transaction_reference: reference,
            payment_method: "paystack",
            status: status,
            gateway_response: gatewayResponse
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("Server response:", data);
        alert(data.message);
        window.location.href = "/";
    })
    .catch(err => console.error("API error:", err));
}
</script>

@endsection
