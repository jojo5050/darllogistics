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

<!-- SUCCESS MODAL -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">

      <div class="modal-body">
        <div class="mb-3 fs-1" id="successIcon">✅</div>
        <h4 id="successTitle"></h4>
        <p class="text-muted" id="successMessage"></p>

        <button id="successOkBtn" class="btn btn-success w-100 mt-3">
          OK
        </button>
      </div>

    </div>
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

        showSuccessModal(
        "Free Trial Activated 🎉",
        "You can now log in on the mobile app to continue."
        );
        return;
    }

    // PAID PLAN
    let handler = PaystackPop.setup({
        key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
        email: userEmail,
        amount: amount * 10,
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

<script>
function showSuccessModal(title, message) {
  document.getElementById('successTitle').innerText = title;
  document.getElementById('successMessage').innerText = message;

  const modal = new bootstrap.Modal(document.getElementById('successModal'));
  modal.show();

  document.getElementById('successOkBtn').onclick = () => {
    window.location.href = "{{ route('home.index') }}";
  };
}
</script>

@endsection
