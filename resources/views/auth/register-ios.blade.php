@extends('layout.landing') 
@section('title', 'Home | '.env('APP_NAME'))

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div id="app" class="card shadow-lg border-top border-4 border-success rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h1 id="step-title" class="text-center mb-4 text-dark fw-bold">Step 1: Choose Your Company Type</h1>
                    
                    <!-- Status/Message Area -->
                    <div id="message-box" class="alert d-none" role="alert"></div>

                    <!-- Progress Indicator -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div id="step-1-indicator" class="text-center w-25 text-success">
                            <div class="progress-circle bg-success text-white mx-auto mb-1 fw-bold">1</div>
                            <small class="fw-semibold">Role</small>
                        </div>
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-1" class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                        <div id="step-2-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">2</div>
                            <small>User Info</small>
                        </div>
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-2" class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                        <div id="step-3-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">3</div>
                            <small>Company</small>
                        </div>
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-3" class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                        <div id="step-4-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">4</div>
                            <small>Payment</small>
                        </div>
                    </div>

                    <!-- ====================== STEP 1: CHOOSE ROLE ====================== -->
                    <div id="step-1-content">
                        <p class="text-muted text-center mb-4">Please select the type of company you are registering.</p>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <button type="button" class="role-btn w-100 btn btn-outline-success p-4 d-flex flex-column align-items-center" data-role="Dispatch_company">
                                    <span class="fs-2 mb-2">🚚</span>
                                    <span class="fw-bold">Dispatch Company</span>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="role-btn w-100 btn btn-outline-secondary p-4 d-flex flex-column align-items-center" data-role="Carrier">
                                    <span class="fs-2 mb-2">🚛</span>
                                    <span class="fw-bold">Carrier</span>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="role-btn w-100 btn btn-outline-secondary p-4 d-flex flex-column align-items-center" data-role="Owner_Operator">
                                    <span class="fs-2 mb-2">👨‍💼</span>
                                    <span class="fw-bold">Owner Operator</span>
                                </button>
                            </div>
                        </div>

                        <div id="role-notice-box" class="alert mt-4 d-none"></div>

                        <button id="step-1-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm mt-4" disabled>
                            Next: Personal Info
                        </button>
                    </div>

                    <!-- ====================== STEP 2: USER INFO ====================== -->
                    <form id="step-2-form" class="needs-validation d-none" novalidate>
                        <input type="hidden" id="user_role">
                        <div class="mb-3"><label for="name" class="form-label">Full Name</label><input type="text" id="name" class="form-control form-control-lg" required></div>
                        <div class="mb-3"><label for="phone" class="form-label">Phone Number</label><input type="tel" id="phone" class="form-control form-control-lg" required></div>
                        <div class="mb-3"><label for="email" class="form-label">Email Address</label><input type="email" id="email" class="form-control form-control-lg" required></div>
                        <div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" id="password" class="form-control form-control-lg" required></div>
                        <div class="mb-4"><label for="password_confirmation" class="form-label">Confirm Password</label><input type="password" id="password_confirmation" class="form-control form-control-lg" required></div>
                        <button type="button" onclick="goToStep(1)" class="btn btn-secondary btn-md w-100 mb-2">Back</button>
                        <button type="submit" id="step-2-submit-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">Next: Company Info</button>
                    </form>

                    <!-- ====================== STEP 3: COMPANY INFO ====================== -->
                    <form id="step-3-form" class="needs-validation d-none" novalidate>
                        <div class="mb-3"><label for="company_name" class="form-label">Company Name</label><input type="text" id="company_name" class="form-control form-control-lg" required></div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label for="dot_number" class="form-label">DOT Number (Optional)</label><input type="text" id="dot_number" class="form-control form-control-lg"></div>
                            <div class="col-md-6 mb-3"><label for="mc_number" class="form-label">MC Number (Optional)</label><input type="text" id="mc_number" class="form-control form-control-lg"></div>
                        </div>
                        <div class="mb-3"><label for="company_email" class="form-label">Company Email</label><input type="email" id="company_email" class="form-control form-control-lg" required></div>
                        <div class="mb-3"><label for="address1" class="form-label">Address Line 1</label><input type="text" id="address1" class="form-control form-control-lg" required></div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label for="city" class="form-label">City</label><input type="text" id="city" class="form-control form-control-lg" required></div>
                            <div class="col-md-6 mb-3"><label for="state" class="form-label">State/Province</label><input type="text" id="state" class="form-control form-control-lg" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label for="zip_code" class="form-label">Zip Code</label><input type="text" id="zip_code" class="form-control form-control-lg" required></div>
                            <div class="col-md-6 mb-3"><label for="country" class="form-label">Country</label><input type="text" id="country" class="form-control form-control-lg" required></div>
                        </div>
                        <button type="button" onclick="goToStep(2)" class="btn btn-secondary btn-md w-100 mb-2">Back</button>
                        <button type="submit" id="step-3-submit-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">Next: Choose Plan & Pay</button>
                    </form>

                    <!-- ====================== STEP 4: PAYMENT ====================== -->
                    <div id="step-4-content" class="text-center d-none">
                        <svg class="mb-4 text-success" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.38a.733.733 0 0 1 1.06-1.05l2.494 2.495 4.436-4.444z"/>
                        </svg>
                        <h2 class="h4 fw-bold mb-3 text-dark">Registration Complete!</h2>
                        <p class="text-muted mb-4">Your company has been successfully registered. You will now be redirected to the payment portal.</p>
                        <button id="paystack-redirect-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">Go to Payment Portal</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
window.__firebase_config = @json([
    'apiKey' => env('FIREBASE_API_KEY'),
    'authDomain' => 'darl-dispatch.firebaseapp.com',
    'projectId' => 'darl-dispatch',
    'storageBucket' => 'darl-dispatch.appspot.com',
    'messagingSenderId' => '276224518042',
    'appId' => '1:276224518042:web:7a0abf25db2a3019737c23',
]);
</script>

<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
import { getFirestore, doc, setDoc, setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

// --- FIREBASE CONFIG ---
const firebaseConfig = JSON.parse(JSON.stringify(window.__firebase_config || {}));
const isLiveFirebase = firebaseConfig && firebaseConfig.apiKey;

let auth = null, db = null, firebaseUserID = null;

if (isLiveFirebase) {
    setLogLevel('Debug');
    const app = initializeApp(firebaseConfig);
    auth = getAuth(app);
    db = getFirestore(app);
    onAuthStateChanged(auth, user => {
        firebaseUserID = user ? user.uid : null;
    });
}

// --- API CONFIG ---
const BASE_API_URL = 'https://www.darllogistics.com/api/v2'; 
const USER_REGISTER_ENDPOINT = '/register'; 
const COMPANY_REGISTER_ENDPOINT = '/companies'; 
const PAYSTACK_REDIRECT_URL = 'https://paystack.com/pay/your-plan'; 
const ALLOWED_ROLE = 'Dispatch_company';

let currentStep = 1, selectedRole = null, apiUserId = null, authToken = null;

// Step 1: Role selection
document.querySelectorAll('.role-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        selectedRole = btn.dataset.role;
        document.querySelectorAll('.role-btn').forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        const step1Btn = document.getElementById('step-1-btn');
        if(selectedRole===ALLOWED_ROLE){
            step1Btn.disabled = false; document.getElementById('role-notice-box').classList.add('d-none');
        }else{step1Btn.disabled=true; const box=document.getElementById('role-notice-box'); box.classList.remove('d-none'); box.className='alert alert-info'; box.innerHTML=`Only ${ALLOWED_ROLE} allowed.`;}
    });
});

document.getElementById('step-1-btn').addEventListener('click', ()=>goToStep(2));

function goToStep(step){
    currentStep=step;
    ['step-1-content','step-2-form','step-3-form','step-4-content'].forEach(id=>document.getElementById(id).classList.add('d-none'));
    switch(step){
        case 1: document.getElementById('step-1-content').classList.remove('d-none'); break;
        case 2: document.getElementById('step-2-form').classList.remove('d-none'); document.getElementById('user_role').value=selectedRole; break;
        case 3: document.getElementById('step-3-form').classList.remove('d-none'); break;
        case 4: document.getElementById('step-4-content').classList.remove('d-none'); break;
    }
}

// --- Step 2: User registration (Firebase + MySQL) ---
document.getElementById('step-2-form').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('password_confirmation').value;
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;

    if(password!==password_confirmation){alert("Passwords do not match."); return;}

    // --- Firebase signup ---
    let firebase_uid = null;
    if(isLiveFirebase){
        try{
            const fbUser = await createUserWithEmailAndPassword(auth,email,password);
            firebase_uid = fbUser.user.uid;
            firebaseUserID = firebase_uid;
        }catch(err){
            if(err.code==='auth/email-already-in-use'){
                const fbUser = await signInWithEmailAndPassword(auth,email,password);
                firebase_uid = fbUser.user.uid;
                firebaseUserID = firebase_uid;
            }else{alert("Firebase signup error: "+err.message); return;}
        }
    }

    // --- MySQL registration ---
    const payload={name, phone, role:selectedRole, email, password, password_confirmation, firebase_uid};
    try{
        const res = await fetch(BASE_API_URL+USER_REGISTER_ENDPOINT,{
            method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload)
        });
        const data = await res.json();
        if(!res.ok){alert(data.message||"Registration failed"); return;}
        apiUserId = data.user.id.toString(); authToken = data.token;
        goToStep(3);
    }catch(err){console.error(err); alert("Network error during registration");}
});

// --- Step 3: Company registration ---
document.getElementById('step-3-form').addEventListener('submit', async e=>{
    e.preventDefault();
    const companyPayload = {
        user_id: apiUserId,
        name: document.getElementById('company_name').value,
        dot_number: document.getElementById('dot_number').value,
        mc_number: document.getElementById('mc_number').value,
        address1: document.getElementById('address1').value,
        country: document.getElementById('country').value,
        state: document.getElementById('state').value,
        city: document.getElementById('city').value,
        zip_code: document.getElementById('zip_code').value,
        email: document.getElementById('company_email').value
    };
    try{
        const res = await fetch(BASE_API_URL+COMPANY_REGISTER_ENDPOINT,{
            method:'POST', headers:{'Content-Type':'application/json','Authorization':`Bearer ${authToken}`}, body:JSON.stringify(companyPayload)
        });
        const data = await res.json();
        if(!res.ok){alert(data.message||"Company registration failed"); return;}
        // Optionally update Firestore with company ID
        if(isLiveFirebase && firebaseUserID && data.id){
            const userDocRef = doc(db, `artifacts/default-app-id/users/${firebaseUserID}/user_data/profile`);
            await setDoc(userDocRef,{company_id:data.id.toString()},{merge:true});
        }
        goToStep(4);
    }catch(err){console.error(err); alert("Network error during company registration");}
});

// Step 4: Payment redirect
document.getElementById('paystack-redirect-btn').addEventListener('click',()=>window.location.href=PAYSTACK_REDIRECT_URL);

goToStep(1);
</script>
@endpush
