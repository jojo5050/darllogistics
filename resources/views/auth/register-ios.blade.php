@extends('layout.landing') 
@section('title', 'Home | '.env('APP_NAME'))

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div id="app" class="card shadow-lg border-top border-4 border-success rounded-3">
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
import { getAuth, signInAnonymously, signInWithCustomToken, createUserWithEmailAndPassword, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
import { getFirestore, doc, setDoc, setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

// Set log level to see detailed Firebase logs in the console
setLogLevel('debug');

// --- Global Variables (Mandatory for Canvas Environment) ---
const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : null;
const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

if (!firebaseConfig) {
    console.error("Firebase configuration is missing. Cannot initialize app.");
    document.body.innerHTML = '<div class="text-center p-8 text-red-600">FATAL ERROR: Firebase config is not available.</div>';
}

// --- Firebase Initialization ---
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

let currentUserId = null;
let isAuthReady = false;

// --- DOM Elements ---
const form = document.getElementById('registration-form');
const statusMessage = document.getElementById('status-message');
const submitBtn = document.getElementById('submit-btn');

function showStatus(message, isSuccess = true) {
    statusMessage.textContent = message;
    statusMessage.classList.remove('hidden', 'bg-red-100', 'text-red-700', 'border-red-300', 'bg-green-100', 'text-green-700', 'border-green-300');
    if (isSuccess) {
        statusMessage.classList.add('bg-green-100', 'text-green-700', 'border-green-300');
    } else {
        statusMessage.classList.add('bg-red-100', 'text-red-700', 'border-red-300');
    }
}

// --- 1. Initial Authentication (for Firestore access) ---
async function initializeAuth() {
    try {
        if (initialAuthToken) {
            await signInWithCustomToken(auth, initialAuthToken);
            console.log("Signed in with custom token.");
        } else {
            await signInAnonymously(auth);
            console.log("Signed in anonymously.");
        }
    } catch (error) {
        console.error("Initial sign-in failed:", error);
        showStatus(`Initial authentication failed: ${error.message}. Database operations might fail.`, false);
    }
}

// Listener to update user ID and readiness state
onAuthStateChanged(auth, (user) => {
    isAuthReady = true;
    currentUserId = user ? user.uid : null;
    console.log("Auth state changed. Ready state:", isAuthReady, "Current UID:", currentUserId);
    if (!currentUserId) {
        // If we are unexpectedly signed out, re-run initialization.
        initializeAuth();
    }
});


// --- 2. Registration and Firestore Save Logic ---
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    submitBtn.disabled = true;
    showStatus('1/2. Attempting to register user in Firebase Auth...', false);

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const name = document.getElementById('name').value;

    if (!isAuthReady) {
        showStatus('Authentication is still loading. Please wait a moment and try again.', false);
        submitBtn.disabled = false;
        return;
    }

    try {
        // Step A: Firebase Authentication - Create User
        const userCredential = await createUserWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;
        const newUserId = user.uid;

        showStatus(`2/2. User created in Auth (UID: ${newUserId}). Now saving profile to Firestore...`, true);

        // Step B: Firestore - Save Profile Data
        const profileData = {
            fullName: name,
            email: email,
            role: 'user', // Default role
            createdAt: new Date().toISOString(),
            testConfirmed: true,
        };

        // Path: /artifacts/{appId}/users/{userId}/profiles/user_profile
        const userDocPath = `artifacts/${appId}/users/${newUserId}/profiles`;
        const userDocRef = doc(db, userDocPath, 'user_profile');

        await setDoc(userDocRef, profileData);

        // Success Feedback
        showStatus(`✅ SUCCESS! User '${email}' registered and profile saved to Firestore in collection: ${userDocPath}. Check your Firebase Console now!`, true);
        form.reset(); // Clear form on success

    } catch (error) {
        let errorMessage;
        if (error.code) {
            errorMessage = `Firebase Error (${error.code}): ${error.message}`;
        } else {
            errorMessage = `General Error: ${error.message}`;
        }
        
        console.error("Registration Failed:", error);
        showStatus(`❌ FAILURE: ${errorMessage}`, false);

    } finally {
        submitBtn.disabled = false;
    }
});

// Run initial auth setup
initializeAuth();
</script>
@endpush