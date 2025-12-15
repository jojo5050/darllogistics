@extends('layout.landing')
@section('title', 'iOS Registration | '.env('APP_NAME'))

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div id="app" class="card shadow-lg border-top border-4 border-success rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h1 id="step-title" class="text-center mb-4 text-dark fw-bold"> Choose Your Company Type</h1>

                    <div id="message-box" class="alert d-none" role="alert"></div>

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div id="step-1-indicator" class="text-center w-25 text-success">
                            <div class="progress-circle bg-success text-white mx-auto mb-1 fw-bold">1</div>
                            <small class="fw-semibold">Role</small>
                        </div>
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-1" class="progress-bar bg-success" style="width: 0%;"></div>
                        </div>

                        <div id="step-2-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">2</div>
                            <small>User Info</small>
                        </div>
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-2" class="progress-bar bg-success" style="width: 0%;"></div>
                        </div>

                        <div id="step-3-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">3</div>
                            <small>Company</small>
                        </div>
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-3" class="progress-bar bg-success" style="width: 0%;"></div>
                        </div>

                        <div id="step-4-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">4</div>
                            <small>Payment</small>
                        </div>
                    </div>

                    <!-- STEP 1 -->
                    <div id="step-1-content">
                        <p class="text-muted text-center mb-4">Please select the type of company you are registering.</p>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <button type="button" class="role-btn w-100 btn btn-outline-success p-4" data-role="Dispatch_company">
                                    <span class="fs-2 mb-2">🚚</span><br>
                                    <span class="fw-bold">Dispatch Company</span>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="role-btn w-100 btn btn-outline-secondary p-4" data-role="Carrier">
                                    <span class="fs-2 mb-2">🚛</span><br>
                                    <span class="fw-bold">Carrier</span>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="role-btn w-100 btn btn-outline-secondary p-4" data-role="Owner_Operator">
                                    <span class="fs-2 mb-2">👨‍💼</span><br>
                                    <span class="fw-bold">Owner Operator</span>
                                </button>
                            </div>
                        </div>

                        <div id="role-notice-box" class="alert mt-4 d-none"></div>

                        <button id="step-1-btn" class="btn btn-success btn-lg w-100 fw-semibold mt-4" disabled>
                            Next: Personal Info
                        </button>
                    </div>

                    <!-- STEP 2 -->
                    <form id="step-2-form" class="d-none">
                        <input type="hidden" id="user_role">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input id="name" name="name" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input id="phone" name="phone" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input id="password"
                                  name="password"
                                  type="password"
                                  class="form-control form-control-lg"
                                  required>
                  
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input id="password_confirmation"
                              name="password_confirmation"
                              type="password"
                              class="form-control form-control-lg"
                              required>
                        </div>

                        <button type="button" onclick="goToStep(1)" class="btn btn-secondary w-100 mb-2">Back</button>
                        <button type="submit" class="btn btn-success btn-lg w-100">Next: Company Info</button>
                    </form>

                    <!-- STEP 3 -->
                    <form id="step-3-form" class="d-none">
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input id="company_name" name="name" class="form-control form-control-lg" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">DOT Number</label>
                                <input id="dot_number" name="dot_number" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">MC Number</label>
                                <input id="mc_number" name="mc_number" class="form-control form-control-lg">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Email</label>
                            <input id="company_email" name="email" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input id="address1" name="address1" class="form-control form-control-lg" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input id="city" name="city" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State</label>
                                <input id="state" name="state" class="form-control form-control-lg" required>

                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Zip Code</label>
                                <input id="zip_code" name="zip_code" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <input id="country" name="country" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <button type="button" onclick="goToStep(2)" class="btn btn-secondary w-100 mb-2">Back</button>
                        <button type="submit" class="btn btn-success btn-lg w-100">Next: Payment</button>
                    </form>

                     <!-- STEP 4: REDIRECTION MESSAGE -->
                    <div id="step-4-content" class="text-center d-none">
                           <h2 class="h4 fw-bold text-dark mb-3">Registration Complete!</h2>
                           <p class="text-muted">Company details saved successfully. Redirecting you to the payment plan selection...</p>
                        <div class="spinner-border text-success mt-4" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')

<!-- ===================== AXIOS (MUST LOAD FIRST) ===================== -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
  axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  window.__firebase_config = @json(config('firebase_frontend'), JSON_FORCE_OBJECT);
  const PAYMENT_REDIRECT_URL = "{{ route('select.plan') }}";
</script>

<!-- ===================== FIREBASE INITIALIZATION ===================== -->
<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
  import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
  import { getFirestore, doc, setDoc, updateDoc } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

  const cfg = window.__firebase_config ?? {};

  try {
    if (!cfg.apiKey) throw new Error("Firebase config missing");

    const app = initializeApp(cfg);
    window._firebaseAuthObj = getAuth(app);
    window.createUserWithEmailAndPassword = createUserWithEmailAndPassword;

    window._firebaseDbObj = getFirestore(app);
    window._firebaseFns = { doc, setDoc, updateDoc };

    window._firebaseReady = true;
    console.log("Firebase ready");
  } catch (e) {
    console.warn("Firebase disabled:", e.message);
    window._firebaseReady = false;
  }
</script>

@verbatim
<script>
/* ===================== UI HELPERS ===================== */
function showMessage(text, type = "info") {
  const box = document.getElementById("message-box");
  box.className = `alert alert-${type === 'error' ? 'danger' : type}`;
  box.innerText = text;
  box.classList.remove("d-none");
}
function hideMessage() {
  document.getElementById("message-box").classList.add("d-none");
}

/* ===================== STATE ===================== */
let selectedRole = null;
let registeredUserId = null;
let firebaseUID = null;

/* ===================== STEP NAV ===================== */
function goToStep(step) {

// Hide all contents
['step-1-content','step-2-form','step-3-form','step-4-content']
  .forEach(id => document.getElementById(id)?.classList.add('d-none'));

// Show current step content
document.getElementById(
  step === 1 ? 'step-1-content'
  : step === 2 ? 'step-2-form'
  : step === 3 ? 'step-3-form'
  : 'step-4-content'
)?.classList.remove('d-none');

// Update title
const titles = {
  1: 'Choose Your Company Type',
  2: 'Personal Information',
  3: 'Company Information',
  4: 'Payment'
};
document.getElementById('step-title').innerText = titles[step];

// Update indicators + progress
for (let i = 1; i <= 4; i++) {
  const indicator = document.getElementById(`step-${i}-indicator`);
  const circle = indicator.querySelector('.progress-circle');
  const bar = document.getElementById(`progress-bar-${i}`);

  if (i <= step) {
    indicator.classList.remove('text-muted');
    indicator.classList.add('text-success');
    circle.classList.remove('bg-light','border-secondary','text-secondary');
    circle.classList.add('bg-success','text-white');
    if (bar) bar.style.width = '100%';
  } else {
    indicator.classList.remove('text-success');
    indicator.classList.add('text-muted');
    circle.classList.remove('bg-success','text-white');
    circle.classList.add('bg-light','border','border-secondary','text-secondary');
    if (bar) bar.style.width = '0%';
  }
}
}

/* ===================== ROLE SELECTION ===================== */
document.querySelectorAll('.role-btn').forEach(btn => {
  btn.onclick = () => {

    // Reset all cards
    document.querySelectorAll('.role-btn').forEach(b => {
      b.classList.remove('btn-success');
      b.classList.add('btn-outline-secondary');
    });

    // Activate selected card
    btn.classList.remove('btn-outline-secondary');
    btn.classList.add('btn-success');

    selectedRole = btn.dataset.role;
    document.getElementById('user_role').value = selectedRole;

    // Enable button only when valid
    document.getElementById('step-1-btn').disabled = !selectedRole;

      if (selectedRole !== 'Dispatch_company') {
        showMessage('Only Dispatch Companies are supported for now', 'warning');
        document.getElementById('step-1-btn').disabled = true;
      } else {
        hideMessage();
      }
  };
});


document.getElementById('step-1-btn').onclick = () => goToStep(2);

/* ===================== BUTTON LOADER ===================== */
function setBtnLoading(btn, state, text="Please wait...") {
  if (!btn) return;
  if (state) {
    btn.dataset.old = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> ${text}`;
  } else {
    btn.disabled = false;
    btn.innerHTML = btn.dataset.old;
  }
}

/* ===================== STEP 2: USER ===================== */
document.getElementById('step-2-form').onsubmit = async e => {
  e.preventDefault();
  hideMessage();

  const data = Object.fromEntries(new FormData(e.target));
  data.role = data.role || selectedRole;

  if (data.password !== data.password_confirmation) {
    showMessage("Passwords do not match", "error");
    return;
  }

  const btn = e.target.querySelector("button");
  setBtnLoading(btn, true, "Creating user...");

  try {
    const res = await axios.post("/ios/register/user", data);
    if (!res.data.success) throw new Error(res.data.message);

    registeredUserId = res.data.user_id;
    showMessage("User created successfully", "success");

    if (window._firebaseReady) {
      try {
        const cred = await window.createUserWithEmailAndPassword(
          window._firebaseAuthObj, data.email, data.password
        );
        firebaseUID = cred.user.uid;

        const ref = window._firebaseFns.doc(
          window._firebaseDbObj, "Users", firebaseUID
        );

        await window._firebaseFns.setDoc(ref, {
          mysql_id: registeredUserId,
          name: data.name,
          email: data.email,
          phone: data.phone,
          role: data.role,
          created_at: new Date().toISOString()
        }, { merge: true });

      } catch (fbErr) {
        console.warn("Firebase skipped:", fbErr.message);
      }
    }

    goToStep(3);

  } catch (err) {
    
    showMessage(err.message || "Registration failed", "error");
  }

  setBtnLoading(btn, false);
};

/* ===================== STEP 3: COMPANY ===================== */
document.getElementById('step-3-form').onsubmit = async e => {
  e.preventDefault();
  hideMessage();

  const data = Object.fromEntries(new FormData(e.target));
  data.user_id = registeredUserId;

  const btn = e.target.querySelector("button");
  setBtnLoading(btn, true, "Creating company...");

  try {
    const res = await axios.post("/ios/register/company", data);
    if (!res.data.success) throw new Error(res.data.message);

    if (firebaseUID && window._firebaseReady) {
      const ref = window._firebaseFns.doc(
        window._firebaseDbObj, "Users", firebaseUID
      );
      await window._firebaseFns.updateDoc(ref, {
        company: {
          id: res.data.company_id,
          name: data.name,
          country: data.country
        }
      });
    }

    window.location.href = PAYMENT_REDIRECT_URL;

  } catch (err) {
    showMessage(err.message || "Company creation failed", "error");
  }

  setBtnLoading(btn, false);
};

/* ===================== START ===================== */
goToStep(1);
</script>
@endverbatim

@endpush
