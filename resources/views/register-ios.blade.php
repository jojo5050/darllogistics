@extends('layout.landing')
@section('title', 'iOS Registration | '.env('APP_NAME'))

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div id="app" class="card shadow-lg border-top border-4 border-success rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h1 id="step-title" class="text-center mb-4 text-dark fw-bold">Step 1: Choose Your Company Type</h1>

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
                            <input id="name" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input id="phone" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input id="password" type="password" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control form-control-lg" required>
                        </div>

                        <button type="button" onclick="goToStep(1)" class="btn btn-secondary w-100 mb-2">Back</button>
                        <button type="submit" class="btn btn-success btn-lg w-100">Next: Company Info</button>
                    </form>

                    <!-- STEP 3 -->
                    <form id="step-3-form" class="d-none">
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input id="company_name" class="form-control form-control-lg" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">DOT Number</label>
                                <input id="dot_number" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">MC Number</label>
                                <input id="mc_number" class="form-control form-control-lg">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Email</label>
                            <input id="company_email" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input id="address1" class="form-control form-control-lg" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input id="city" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State</label>
                                <input id="state" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Zip Code</label>
                                <input id="zip_code" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <input id="country" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <button type="button" onclick="goToStep(2)" class="btn btn-secondary w-100 mb-2">Back</button>
                        <button type="submit" class="btn btn-success btn-lg w-100">Next: Payment</button>
                    </form>

                    <!-- STEP 4 -->
                    <div id="step-4-content" class="text-center d-none">
                        <h2 class="h4 fw-bold text-dark mb-3">Registration Complete!</h2>
                        <p class="text-muted">You will now be redirected to Paystack.</p>

                        <button id="paystack-redirect-btn" class="btn btn-success btn-lg w-100">
                            Go to Payment Portal
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@verbatim
<script>
/* ========= CONFIG ========= */
const API_BASE = "/api/v2"; // <- correct API base per your backend
const REGISTER_ENDPOINT = API_BASE + "/register";
const COMPANY_ENDPOINT  = API_BASE + "/companies";
const PAYSTACK_REDIRECT = "https://paystack.com/pay/your-plan"; // replace if you have a real url

/* ========= UI HELPERS ========= */
function showMessage(text, type = "info") {
  const box = document.getElementById("message-box");
  box.classList.remove("d-none", "alert-info", "alert-danger", "alert-success", "alert-warning");
  box.classList.add("alert");
  if (type === "error") box.classList.add("alert-danger");
  else if (type === "success") box.classList.add("alert-success");
  else if (type === "warning") box.classList.add("alert-warning");
  else box.classList.add("alert-info");
  box.innerText = text;
  console.log("UI message:", type, text);
}
function hideMessage(){ document.getElementById("message-box").classList.add("d-none"); }

/* ========= STATE ========= */
let selectedRole = null;
let registeredUserId = null;   // MySQL user id (string)
let authToken = null;          // auth token from MySQL response
let firebaseUID = null;        // Firebase uid after creation

/* ========= UTILITY - set button active class visually ========= */
function markRoleButton(activeBtn) {
  document.querySelectorAll('.role-btn').forEach(btn => {
    btn.classList.remove('active', 'border-success');
    // keep outline classes but add clear active styling
    btn.classList.add('btn-outline-secondary');
  });
  activeBtn.classList.add('active');
  // if dispatch, make it look active green
  if (activeBtn.dataset.role === 'Dispatch_company') {
    activeBtn.classList.remove('btn-outline-secondary');
    activeBtn.classList.add('btn-outline-success', 'active');
  } else {
    // mark others differently so user sees they are disabled for now
    activeBtn.classList.remove('btn-outline-secondary');
    activeBtn.classList.add('btn-outline-secondary', 'active');
  }
}

/* ========= STEP NAV ========= */
function goToStep(step) {
  // Hide all
  ['step-1-content','step-2-form','step-3-form','step-4-content'].forEach(id=>{
    const el = document.getElementById(id);
    if (el) el.classList.add('d-none');
  });
  // Show requested
  if (step === 1) document.getElementById('step-1-content').classList.remove('d-none');
  if (step === 2) document.getElementById('step-2-form').classList.remove('d-none');
  if (step === 3) document.getElementById('step-3-form').classList.remove('d-none');
  if (step === 4) document.getElementById('step-4-content').classList.remove('d-none');
}

/* ========= ROLE SELECTION ========= */
document.querySelectorAll('.role-btn').forEach(btn=>{
  btn.addEventListener('click', (ev) => {
    const role = btn.getAttribute('data-role');
    selectedRole = role;
    document.getElementById('user_role').value = role;
    markRoleButton(btn);
    const step1Btn = document.getElementById('step-1-btn');
    if (role === 'Dispatch_company') {
      step1Btn.disabled = false;
      document.getElementById('role-notice-box').classList.add('d-none');
    } else {
      step1Btn.disabled = true;
      const box = document.getElementById('role-notice-box');
      box.classList.remove('d-none');
      box.className = 'alert alert-info';
      box.innerText = `${role.replace('_',' ')} registration coming soon. Please choose Dispatch company.`;
    }
  });
});
document.getElementById('step-1-btn').addEventListener('click', ()=> {
  if (!selectedRole) return;
  goToStep(2);
});

/* ========= HELPERS FOR BUTTON LOADING ========= */
function setBtnLoading(btn, loading=true, textWhenLoading="Please wait...") {
  if (!btn) return;
  if (loading) {
    btn.dataset._orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${textWhenLoading}`;
  } else {
    btn.disabled = false;
    if (btn.dataset._orig) btn.innerHTML = btn.dataset._orig;
  }
}

/* ========= STEP 2: REGISTER (MySQL -> then Firebase) ========= */
document.getElementById('step-2-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  hideMessage();

  const name = document.getElementById('name').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const password_confirmation = document.getElementById('password_confirmation').value;
  const role = document.getElementById('user_role').value || selectedRole;

  if (!name || !phone || !email || !password || !password_confirmation) { showMessage('Please fill all required fields','error'); return; }
  if (password !== password_confirmation) { showMessage('Passwords do not match','error'); return; }

  const submitBtn = document.querySelector('#step-2-form button[type="submit"]');
  setBtnLoading(submitBtn, true, "Creating user...");

  try {
    // 1) Call MySQL API
    console.log("POST ->", REGISTER_ENDPOINT, {name,phone,email,role});
    const mysqlRes = await axios.post(REGISTER_ENDPOINT, {
      name, phone, email, role, password, password_confirmation
    });

    console.log("MySQL response:", mysqlRes.data);
    if (!mysqlRes.data || mysqlRes.data.code !== 1 || !mysqlRes.data.user) {
      const errMsg = mysqlRes.data?.message || "Unexpected API response from register.";
      showMessage("Registration failed: " + errMsg, 'error');
      setBtnLoading(submitBtn, false);
      return;
    }

    // success on MySQL
    registeredUserId = String(mysqlRes.data.user.id);
    authToken = mysqlRes.data.token || null;
    showMessage("User registered on MySQL.", "success");
    console.log("Registered user id:", registeredUserId);

    // 2) Now create Firebase user (ONLY if firebase configured)
    if (window.__firebase_config && window.__firebase_config.apiKey) {
      try {
        console.log("Attempting Firebase createUserWithEmailAndPassword for", email);
        // createUserWithEmailAndPassword is loaded in your page's firebase JS block (must be loaded)
        const auth = window._firebaseAuthObj; // we will attach auth to window in the firebase init block (see note)
        if (!auth) {
          console.warn("Firebase auth object missing - skipping firebase create. Ensure firebase init script runs.");
          showMessage("MySQL user created but Firebase initialization missing. Check console.", "warning");
          goToStep(3);
          setBtnLoading(submitBtn, false);
          return;
        }
        const fbCred = await window.createUserWithEmailAndPassword(auth, email, password);
        firebaseUID = fbCred.user.uid;
        console.log("Firebase user created", firebaseUID);

        // create Firestore doc
        if (window._firebaseDbObj && window._firebaseFns && window._firebaseFns.setDoc && window._firebaseFns.doc) {
          const db = window._firebaseDbObj;
          const docRef = window._firebaseFns.doc(db, "users", firebaseUID);
          await window._firebaseFns.setDoc(docRef, {
            mysql_id: registeredUserId,
            name, email, phone, role,
            created_at: new Date().toISOString()
          }, { merge: true });
          console.log("Firestore user doc created for uid:", firebaseUID);
        } else {
          console.warn("Firestore helpers missing - Firestore doc not created. Check firebase init.");
        }

        showMessage("User created in MySQL and Firebase. Proceed to company info.", "success");
        goToStep(3);
        setBtnLoading(submitBtn, false);
        return;

      } catch (fbErr) {
        console.error("Firebase create error:", fbErr);
        showMessage("Firebase signup failed (see console). MySQL user was created. You can retry linking later.", "warning");
        // Do NOT delete MySQL user automatically unless you have a rollback endpoint and are certain.
        // Optionally: attempt rollback here if you have DELETE /api/v2/users/{id} and authToken
        setBtnLoading(submitBtn, false);
        goToStep(3); // still allow user to continue, but show warning
        return;
      }
    } else {
      console.warn("Firebase not configured for frontend. Skipping Firebase creation.");
      showMessage("MySQL registration ok. Firebase skipped (no frontend config).", "warning");
      goToStep(3);
    }

  } catch (err) {
    console.error("Registration error:", err);
    const remoteMsg = err.response?.data?.message || err.response?.data || err.message;
    showMessage("Registration failed. " + remoteMsg, "error");
    setBtnLoading(submitBtn, false);
    return;
  }
});

/* ========= STEP 3: COMPANY ========= */
document.getElementById('step-3-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  hideMessage();

  if (!registeredUserId) { showMessage("Complete user registration first.", "error"); goToStep(2); return; }
  const submitBtn = document.querySelector('#step-3-form button[type="submit"]');
  setBtnLoading(submitBtn, true, "Creating company...");

  const payload = {
    user_id: registeredUserId,
    name: document.getElementById('company_name').value.trim(),
    email: document.getElementById('company_email').value.trim(),
    country: document.getElementById('country').value.trim(),
    tel: document.getElementById('phone').value.trim(),
    mobile: document.getElementById('phone').value.trim(),
    state: document.getElementById('state').value.trim(),
    city: document.getElementById('city').value.trim(),
    zip_code: document.getElementById('zip_code').value.trim(),
    address: document.getElementById('address1').value.trim(),
    mc_number: document.getElementById('mc_number').value.trim(),
    dot_number: document.getElementById('dot_number').value.trim(),
  };

  try {
    const headers = { 'Content-Type': 'application/json' };
    if (authToken) headers['Authorization'] = `Bearer ${authToken}`;

    console.log("POST ->", COMPANY_ENDPOINT, payload);
    const res = await axios.post(COMPANY_ENDPOINT, payload, { headers });
    console.log("Company response:", res.data);

    // robust company id extraction
    const company = res.data.data || res.data.company || res.data;
    const compId = company?.id || company?.company_id;
    if (!compId) {
      console.warn("Company created but id not found in response:", res.data);
      showMessage("Company created but API response did not include ID. Check server logs.", "warning");
      setBtnLoading(submitBtn, false);
      goToStep(4);
      return;
    }

    showMessage("Company created successfully.", "success");

    // update firestore with company info if firebase linked
    if (firebaseUID && window._firebaseFns && window._firebaseDbObj) {
      try {
        const docRef = window._firebaseFns.doc(window._firebaseDbObj, "Users", firebaseUID);
        await window._firebaseFns.updateDoc
          ? window._firebaseFns.updateDoc(docRef, { company: { id: String(compId), name: payload.name, city: payload.city, country: payload.country } })
          : window._firebaseFns.setDoc(docRef, { company: { id: String(compId), name: payload.name } }, { merge: true });
        console.log("Firestore updated with company info for uid:", firebaseUID);
      } catch (fbUpErr) {
        console.error("Firestore company update error:", fbUpErr);
      }
    }

    goToStep(4);
  } catch (err) {
    console.error("Company creation error:", err);
    showMessage("Company creation failed: " + (err.response?.data?.message || err.message), "error");
  } finally {
    setBtnLoading(submitBtn, false);
  }
});

/* ========= STEP 4: PAYMENT ========= */
document.getElementById('paystack-redirect-btn').addEventListener('click', () => {
  if (!registeredUserId) { showMessage("No user to pay for.", "error"); return; }
  // redirect - you should replace PAYSTACK_REDIRECT with your real payment url
  window.location.href = PAYSTACK_REDIRECT;
});

/* ========= START ========= */
goToStep(1);

/* ========== NOTES =========
  * The Firebase init script MUST attach helper objects to window:
      - window._firebaseAuthObj  => firebase auth instance
      - window._firebaseDbObj    => firestore instance
      - window._firebaseFns      => object containing { doc, setDoc, updateDoc, collection, ... } functions
      - window.createUserWithEmailAndPassword => reference to function
      - window._firebaseFns.setDoc => setDoc fn

  I purposely used references from window so the firebase init code is separate and testable.
  If you're initializing Firebase elsewhere in page, ensure it sets the above.
============= */
</script>
@endverbatim


@endpush
