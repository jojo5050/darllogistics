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

                    <!-- Progress Indicator (Bootstrap Style - 4 Steps) -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <!-- Step 1 Indicator -->
                        <div id="step-1-indicator" class="text-center w-25 text-success">
                            <div class="progress-circle bg-success text-white mx-auto mb-1 fw-bold">1</div>
                            <small class="fw-semibold">Role</small>
                        </div>
                        <!-- Bar 1 -->
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-1" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        <!-- Step 2 Indicator -->
                        <div id="step-2-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">2</div>
                            <small>User Info</small>
                        </div>
                         <!-- Bar 2 -->
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-2" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Step 3 Indicator -->
                        <div id="step-3-indicator" class="text-center w-25 text-muted">
                            <div class="progress-circle bg-light border border-secondary text-secondary mx-auto mb-1 fw-bold">3</div>
                            <small>Company</small>
                        </div>
                        <!-- Bar 3 -->
                        <div class="progress flex-grow-1 mx-2" style="height: 4px;">
                            <div id="progress-bar-3" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Step 4 Indicator -->
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

                    <!-- ====================== STEP 2: USER INFO (FORM) ====================== -->
                    <form id="step-2-form" class="needs-validation d-none" novalidate>
                        <input type="hidden" id="user_role"> <!-- Will hold the selected role -->

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" class="form-control form-control-lg" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" class="form-control form-control-lg" placeholder="Phone Number (e.g., +15551234567)" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" class="form-control form-control-lg" placeholder="Email Address" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" required>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" required>
                        </div>
                        
                        <button type="button" onclick="goToStep(1)" class="btn btn-secondary btn-md w-100 mb-2">Back</button>
                        <button type="submit" id="step-2-submit-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">
                            Next: Company Info
                        </button>
                    </form>

                    <!-- ====================== STEP 3: COMPANY INFO (FORM) ====================== -->
                    <form id="step-3-form" class="needs-validation d-none" novalidate>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" id="company_name" class="form-control form-control-lg" placeholder="Company Name" required>
                        </div>
                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="dot_number" class="form-label">DOT Number (Optional)</label>
                                <input type="text" id="dot_number" class="form-control form-control-lg" placeholder="DOT Number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mc_number" class="form-label">MC Number (Optional)</label>
                                <input type="text" id="mc_number" class="form-control form-control-lg" placeholder="MC Number">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="company_email" class="form-label">Company Email</label>
                            <input type="email" id="company_email" class="form-control form-control-lg" placeholder="Company Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address1" class="form-label">Address Line 1</label>
                            <input type="text" id="address1" class="form-control form-control-lg" placeholder="Address Line 1" required>
                        </div>
                        
                        <!-- Location Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" class="form-control form-control-lg" placeholder="City" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label">State/Province</label>
                                <input type="text" id="state" class="form-control form-control-lg" placeholder="State/Province" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" id="zip_code" class="form-control form-control-lg" placeholder="Zip Code" required>
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" id="country" class="form-control form-control-lg" placeholder="Country" required>
                            </div>
                        </div>
                        
                        <button type="button" onclick="goToStep(2)" class="btn btn-secondary btn-md w-100 mb-2">Back</button>
                        <button type="submit" id="step-3-submit-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">
                            Next: Choose Plan & Pay
                        </button>
                    </form>
                    
                    <!-- ====================== STEP 4: PAYMENT REDIRECT ====================== -->
                    <div id="step-4-content" class="text-center d-none">
                        <svg class="mb-4 text-success" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.38a.733.733 0 0 1 1.06-1.05l2.494 2.495 4.436-4.444z"/>
                        </svg>
                        <h2 class="h4 fw-bold mb-3 text-dark">Registration Complete!</h2>
                        <p class="text-muted mb-4">Your company has been successfully registered. You will now be redirected to the payment portal to finalize your subscription.</p>
                        
                        <button id="paystack-redirect-btn" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">
                            Go to Payment Portal
                        </button>
                        
                        <p class="mt-3 small text-secondary">Once payment is complete, return to the Darllogistics app and log in.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    // --- FIREBASE IMPORTS ---
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
    import { getAuth, signInWithCustomToken, createUserWithEmailAndPassword, signInWithEmailAndPassword, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
    import { getFirestore, doc, updateDoc, setDoc, setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

    // --- FIREBASE GLOBAL VARIABLES ---
    const PLACEHOLDER_API_KEY = "PLACEHOLDER";
    const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
    
    // Check if the real config is available; otherwise, use a placeholder.
    const firebaseConfig = typeof __firebase_config !== 'undefined' 
        ? JSON.parse(__firebase_config) 
        : { apiKey: PLACEHOLDER_API_KEY, authDomain: "placeholder.firebaseapp.com", projectId: "placeholder" };

    // Determine if we are using the real (non-placeholder) configuration
    const isLiveFirebase = firebaseConfig && firebaseConfig.apiKey && firebaseConfig.apiKey !== PLACEHOLDER_API_KEY;

    let auth = null;
    let db = null;
    let firebaseUserID = null; // The UID assigned by Firebase Auth

    // --- FIREBASE INITIALIZATION ---
    if (firebaseConfig && firebaseConfig.apiKey) {
        setLogLevel('Debug');
        if (isLiveFirebase) {
             try {
                const app = initializeApp(firebaseConfig);
                auth = getAuth(app); 
                db = getFirestore(app);

                // Listener to capture Firebase UID once signed in (e.g., after Step 2)
                onAuthStateChanged(auth, (user) => {
                    if (user) {
                        firebaseUserID = user.uid;
                        console.log("Firebase Auth State Changed. UID:", firebaseUserID);
                    } else {
                        firebaseUserID = null;
                        console.log("Firebase Auth State Changed. User signed out.");
                    }
                });
                console.log("SUCCESS: Firebase services initialized with live config.");
            } catch (initError) {
                console.error("CRITICAL: Failed to initialize Firebase with provided configuration:", initError.message);
            }
        } else {
             // THIS IS THE WARNING YOU SHOULD SEE ON LOCALHOST:
             console.warn("WARNING: Using Firebase PLACEHOLDER configuration. Firebase Auth and Firestore operations are SKIPPED. Please deploy to live server (CPanel) to test full functionality.");
        }
    } else {
        console.error("CRITICAL: Firebase config is missing or invalid. Cannot initialize Firebase features.");
    }
    
    // --- UTILITY FUNCTION: Update Firestore User Document ---
    /**
     * Updates/Creates the user's document in Firestore with the company ID and role.
     * @param {string} fbUID The Firebase User ID (UID).
     * @param {string} companyId The company ID from the API response.
     * @param {string} role The user's role.
     */
    async function updateFirebaseUser(fbUID, companyId, role) {
        if (!isLiveFirebase) {
            console.warn('Firestore update skipped: Using placeholder Firebase config.');
            return true; // Pretend it succeeded for local testing flow
        }

        if (!db || !fbUID || !companyId) {
            console.error('Firestore or required IDs are missing for update. Skipping Firestore update.');
            return false; 
        }

        // Use setDoc with merge: true to ensure the document exists and is updated atomically.
        // NOTE: Path must be adjusted based on your security rules. Assuming the standard private path.
        const userDocPath = `artifacts/${appId}/users/${fbUID}/user_data/profile`; 
        const userDocRef = doc(db, userDocPath);

        try {
             const userData = {
                company_id: companyId.toString(),
                role: role,
                updated_at: new Date().toISOString()
            };
            
            await setDoc(userDocRef, userData, { merge: true });
            
            console.log('company_id and role updated successfully in Firestore:', userDocPath);
            return true;
        } catch (e) {
            console.error('CRITICAL: Error updating/creating user profile in Firestore:', e.message);
            return false;
        }
    }

    // --- CSS for Progress Circles and Role Buttons (No change, repeated for self-contained file) ---
    const style = document.createElement('style');
    style.textContent = `
        .progress-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .w-25 {
            width: 25%;
        }
        .role-btn {
            border-width: 2px !important;
            transition: all 0.2s ease;
            height: 120px;
        }
        .role-btn:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .role-btn.active {
            background-color: var(--bs-success);
            color: white !important;
            border-color: var(--bs-success) !important;
        }
        /* Ensure active success button keeps white text */
        .btn-outline-success.active, .btn-outline-success:active {
            color: #fff !important; 
            background-color: var(--bs-success) !important;
        }
        .btn-outline-secondary.active, .btn-outline-secondary:active {
            background-color: var(--bs-secondary) !important;
            color: #fff !important; 
        }
        label.form-label {
            font-weight: 500;
            color: #495057;
        }
    `;
    document.head.appendChild(style);

    // --- CONFIGURATION ---
    // NOTE: This URL must be correct on your live server.
    const BASE_API_URL = 'https://www.darllogistics.com/api/v2'; 
    const USER_REGISTER_ENDPOINT = '/register'; 
    const COMPANY_REGISTER_ENDPOINT = '/companies'; 
    const PAYSTACK_REDIRECT_URL = 'https://paystack.com/pay/your-plan'; 
    const ALLOWED_ROLE = 'Dispatch_company';
    // --- END CONFIGURATION ---

    let currentStep = 1; 
    let selectedRole = null; 
    let apiUserId = null;    // The ID assigned by your API/Backend
    let authToken = null;    // The token received from your API
    let userEmail = null;    // Store email for Firebase retry

    // DOM Elements (same as before)
    const stepTitle = document.getElementById('step-title');
    const step1Content = document.getElementById('step-1-content');
    const step2Form = document.getElementById('step-2-form');
    const step3Form = document.getElementById('step-3-form');
    const step4Content = document.getElementById('step-4-content');
    const messageBox = document.getElementById('message-box');
    const roleNoticeBox = document.getElementById('role-notice-box');
    const step1NextBtn = document.getElementById('step-1-btn');
    
    // Indicators and Bars (same as before)
    const stepIndicators = [
        document.getElementById('step-1-indicator'),
        document.getElementById('step-2-indicator'),
        document.getElementById('step-3-indicator'),
        document.getElementById('step-4-indicator'),
    ];
    const progressBars = [
        document.getElementById('progress-bar-1'),
        document.getElementById('progress-bar-2'),
        document.getElementById('progress-bar-3'),
    ];

    // Helper functions (same as before)
    function showMessage(message, type = 'danger') {
        messageBox.innerHTML = message;
        messageBox.classList.remove('d-none', 'alert-danger', 'alert-success', 'alert-info', 'alert-warning');
        messageBox.className = 'alert';
        if (type === 'error') {
            messageBox.classList.add('alert-danger');
        } else if (type === 'success') {
            messageBox.classList.add('alert-success');
        } else if (type === 'warning') {
            messageBox.classList.add('alert-warning');
        } else {
            messageBox.classList.add('alert-info');
        }
    }

    function hideMessage() {
        messageBox.classList.add('d-none');
    }

    function updateProgressIndicator() {
        const updateIndicator = (el, isActive, isComplete) => {
            const circle = el.querySelector('.progress-circle');
            const text = el.querySelector('small');
            
            circle.classList.remove('bg-success', 'bg-light', 'text-white', 'text-secondary', 'border');
            text.classList.remove('text-success', 'text-muted', 'fw-semibold');

            if (isComplete) {
                circle.classList.add('bg-success', 'text-white');
                text.classList.add('text-success', 'fw-semibold');
            } else if (isActive) {
                circle.classList.add('bg-success', 'text-white');
                text.classList.add('text-success', 'fw-semibold');
            } else {
                circle.classList.add('bg-light', 'border', 'border-secondary', 'text-secondary');
                text.classList.add('text-muted');
            }
        };

        // Update indicators
        stepIndicators.forEach((el, index) => {
            const stepNum = index + 1;
            updateIndicator(el, currentStep === stepNum, currentStep > stepNum);
        });

        // Update progress bars (connecting bar N connects step N and step N+1)
        progressBars.forEach((bar, index) => {
            const stepNum = index + 1;
            bar.style.width = currentStep > stepNum ? '100%' : '0%';
        });
    }

    function goToStep(step) {
        currentStep = step;
        hideMessage();

        // Hide all step content
        step1Content.classList.add('d-none');
        step2Form.classList.add('d-none');
        step3Form.classList.add('d-none');
        step4Content.classList.add('d-none');
        
        // Show content for the new step and set title
        switch(step) {
            case 1:
                stepTitle.textContent = "Step 1: Choose Your Company Type";
                step1Content.classList.remove('d-none');
                // Re-enable button based on current role selection state
                step1NextBtn.disabled = selectedRole !== ALLOWED_ROLE;
                break;
            case 2:
                if (!selectedRole) { goToStep(1); return; } // Prevent skipping role selection
                stepTitle.textContent = "Step 2: Personal Information";
                step2Form.classList.remove('d-none');
                // Ensure the hidden role field is set
                document.getElementById('user_role').value = selectedRole; 
                break;
            case 3:
                stepTitle.textContent = "Step 3: Company Registration";
                step3Form.classList.remove('d-none');
                break;
            case 4:
                stepTitle.textContent = "Step 4: Payment";
                step4Content.classList.remove('d-none');
                break;
        }
        updateProgressIndicator();
    }

    // --- Step 1: Role Selection Logic (same as before) ---
    document.querySelectorAll('.role-btn').forEach(button => {
        button.addEventListener('click', () => {
            const role = button.getAttribute('data-role');
            selectedRole = role;
            
            // Toggle active state for all buttons
            document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Handle role restriction logic
            if (role === ALLOWED_ROLE) {
                roleNoticeBox.classList.add('d-none');
                step1NextBtn.disabled = false;
                step1NextBtn.textContent = 'Next: Personal Info';
            } else {
                roleNoticeBox.classList.remove('d-none', 'alert-danger', 'alert-success');
                roleNoticeBox.className = 'alert alert-info';
                roleNoticeBox.innerHTML = `We are currently focusing on **${ALLOWED_ROLE.replace('_', ' ')}** registrations. Please select this option to continue. Other roles will be available soon.`;
                step1NextBtn.disabled = true;
                step1NextBtn.textContent = 'Next: Personal Info (Disabled)';
            }
        });
    });

    step1NextBtn.addEventListener('click', () => {
        if (selectedRole === ALLOWED_ROLE) {
            goToStep(2);
        }
    });

    // Initialize the form on load
    document.addEventListener('DOMContentLoaded', () => {
        goToStep(1);
    });

    // --- Step 2: User Registration, Firebase Auth Creation, and Sign-in ---
    step2Form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!step2Form.checkValidity()) {
            step2Form.classList.add('was-validated');
            showMessage("Please fill in all required fields correctly.", 'error');
            return;
        }
        
        userEmail = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;
        
        if (password !== password_confirmation) {
            showMessage("Passwords do not match.", 'error');
            return;
        }
        
        const button = document.getElementById('step-2-submit-btn');
        const originalText = button.textContent;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating User...';
        hideMessage();
        
        const payload = {
            name: document.getElementById('name').value,
            phone: document.getElementById('phone').value,
            role: document.getElementById('user_role').value, // Dynamic Role from Step 1
            email: userEmail,
            password: password,
            password_confirmation: password_confirmation
        };

        try {
            // 1. Register user on your custom backend (MySQL)
            showMessage("1/2: Registering user on your logistics platform...", 'info');
            const apiResponse = await fetch(BASE_API_URL + USER_REGISTER_ENDPOINT, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const apiData = await apiResponse.json();

            if (!apiResponse.ok) {
                const errorMsg = apiData.message || (apiData.errors ? Object.values(apiData.errors).flat().join('<br>') : "Logistics registration failed.");
                showMessage(errorMsg, 'error');
                return;
            }

            if (!apiData.user || !apiData.user.id) {
                 showMessage("Logistics registration succeeded, but API response is missing user ID. Cannot proceed.", 'error');
                 return;
            }
            
            apiUserId = apiData.user.id.toString(); 
            authToken = apiData.token; 
            
            // 2. Register user on Firebase Auth (allows direct login and password changes)
            showMessage("2/2: Linking user to Firebase Authentication...", 'info');
            
            let firebaseAuthSuccess = false;

            if (isLiveFirebase) {
                if (!auth) {
                    showMessage("CRITICAL: Firebase Auth object is missing. Please check console for initialization errors.", 'error');
                    return;
                }
                
                try {
                    // Attempt to create user with email/password
                    const userCredential = await createUserWithEmailAndPassword(auth, userEmail, password);
                    firebaseUserID = userCredential.user.uid;
                    firebaseAuthSuccess = true;
                    console.log("Firebase Auth: User created successfully with email/password.");
                    
                } catch (authError) {
                    // If creation fails (e.g., email already exists in Firebase), sign in instead
                    if (authError.code === 'auth/email-already-in-use') {
                        showMessage("Email already linked in Firebase. Attempting sign-in to sync accounts...", 'warning');
                        console.warn("Firebase Auth: Email already in use. Attempting sign-in.", authError);
                        
                        try {
                            // Use the credentials entered in the form
                            const userCredential = await signInWithEmailAndPassword(auth, userEmail, password);
                            firebaseUserID = userCredential.user.uid;
                            firebaseAuthSuccess = true;
                            console.log("Firebase Auth: User signed in successfully.");
                            
                        } catch (signInError) {
                            // This means the password was wrong for the existing Firebase user
                            showMessage("Firebase sign-in failed. Please check credentials or contact support.", 'error');
                            console.error("Firebase Auth: Sign-in failed after email-already-in-use error.", signInError);
                            // Re-throw to halt the process
                            throw new Error("Firebase Authentication failed.");
                        }
                    } else {
                        // Handle other Firebase errors (e.g., weak password, invalid email format)
                        showMessage(`Firebase Auth Error: ${authError.message}`, 'error');
                        console.error("Firebase Auth: Critical error during user creation/linking.", authError);
                        throw new Error("Firebase Authentication failed.");
                    }
                }

                // 3. Final Sign-in/Session Establishment using the API token
                if (firebaseAuthSuccess && authToken) {
                    console.log("Attempting Firebase custom sign-in using API token to establish secure session.");
                    await signInWithCustomToken(auth, authToken); 
                }
            } else {
                // Placeholder/Local Testing Mode
                firebaseUserID = crypto.randomUUID();
                firebaseAuthSuccess = true;
                showMessage("2/2: Firebase step SKIPPED (Local testing mode). Proceeding to company info.", 'warning');
                console.warn("Firebase Auth SKIPPED: Using placeholder config. User registration is ONLY on the logistics API.");
            }
            
            if (firebaseAuthSuccess) {
                 showMessage("User account created and fully authenticated (Logistics + Firebase). Proceeding to company info.", 'success');
                 goToStep(3); 
                 step2Form.classList.remove('was-validated');
            }
            
        } catch (error) {
            // Generic catch block for network errors or errors thrown from the internal try/catch
            if (error.message.startsWith("Firebase Authentication failed")) {
                 // Message already displayed to user
                 console.error(error.message);
            } else {
                showMessage("A network error occurred during user registration. Please check your connection.", 'error');
                console.error('Step 2 Network Error:', error);
            }
        } finally {
            button.disabled = false;
            button.textContent = originalText;
        }
    }, false);


    // --- Step 3: Company Registration and Firestore Update ---
    step3Form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!step3Form.checkValidity()) {
            step3Form.classList.add('was-validated');
            showMessage("Please fill in all company fields.", 'error');
            return;
        }

        if (!apiUserId) {
            showMessage("Error: API User ID is missing. Please go back to Step 2.", 'error');
            goToStep(2);
            return;
        }

        if (!authToken) {
            showMessage("Error: API Authorization Token is missing. Please go back to Step 2.", 'error');
            goToStep(2);
            return;
        }
        
        const button = document.getElementById('step-3-submit-btn');
        const originalText = button.textContent;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registering Company...';
        hideMessage();

        const companyPayload = { 
            user_id: apiUserId, // The ID received from Step 2
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

        try {
            showMessage("1/2: Sending company registration request to API...", 'info');

            // CRUCIAL FIX: Include the Authorization header with the token
            const response = await fetch(BASE_API_URL + COMPANY_REGISTER_ENDPOINT, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${authToken}` // FIX: Include JWT token
                },
                body: JSON.stringify(companyPayload)
            });

            const data = await response.json();

            if (response.ok) {
                // --- FIX: Add multiple checks for Company ID ---
                const companyId = data.company?.id 
                                || data.id 
                                || data.company_id // Common Laravel response structure
                                || data.user?.company_id; // Check if it's nested under the user object
                
                if (companyId) {
                    showMessage("2/2: Company registered. Linking user in Firestore...", 'info');
                    
                    // --- STEP 3.1: FIRESTORE UPDATE ---
                    // Only attempt to update if we have a valid firebaseUserID and we are in a live environment
                    const firebaseSuccess = (firebaseUserID && isLiveFirebase) 
                        ? await updateFirebaseUser(firebaseUserID, companyId.toString(), selectedRole) 
                        : true; 

                    if (firebaseSuccess) {
                        showMessage("Company registered and user linked. Redirecting to payment.", 'success');
                        goToStep(4);
                    } else {
                        // Log a warning but still proceed to payment (non-critical failure)
                        showMessage("Company registered, but failed to link company ID in Firestore. Proceeding to payment.", 'warning');
                        goToStep(4);
                    }
                    // ----------------------------------
                } else {
                    // This is the error message from the screenshot. It now indicates the API structure issue.
                    showMessage("Company registration succeeded, but API response is missing the Company ID in the expected fields (company.id, id, company_id). Please check your API response structure.", 'error');
                    console.error("CRITICAL: API Company Response is Missing ID. Full Response:", data);
                }

            } else {
                // If API returns an error status (e.g., 401 Unauthorized, 422 Validation)
                const errorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join('<br>') : `Company registration failed with status code ${response.status}.`);
                showMessage(errorMsg, 'error');
                console.error("API Company Registration Error Response:", data);
            }
        } catch (error) {
            showMessage("A network error occurred during company registration or Firestore update.", 'error');
            console.error('Step 3 Error:', error);
        } finally {
            button.disabled = false;
            button.textContent = originalText;
        }
    }, false);
    
    // Step 4: Payment Redirection
    document.getElementById('paystack-redirect-btn').addEventListener('click', () => {
        window.location.href = PAYSTACK_REDIRECT_URL;
    });
</script>
@endpush