@extends('layout.landing')
@section('title','Firebase Signup Test')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h4 class="mb-3">Firebase signup test (web only)</h4>

      <div id="msg" class="alert d-none"></div>

      <form id="fbSignupForm">
        @csrf
        <div class="mb-2">
          <input id="name" class="form-control" placeholder="Full name" required>
        </div>
        <div class="mb-2">
          <input id="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-2">
          <input id="password" type="password" class="form-control" placeholder="Password (min 6)" required>
        </div>
        <button id="submitBtn" class="btn btn-primary w-100" type="submit">Create Firebase user</button>
      </form>
    </div>
  </div>
</div>
@endsection


@push('scripts')
@verbatim
<script>
  // expose JSON object safely from config (forces object)
  window.__firebase_config = @json(config('firebase_frontend'), JSON_FORCE_OBJECT);
  console.log("Firebase config (frontend):", window.__firebase_config);
</script>

<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
  import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
  import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

  const cfg = window.__firebase_config || {};
  const msgBox = document.getElementById('msg');

  function showMsg(text, type = 'info') {
    msgBox.classList.remove('d-none','alert-info','alert-danger','alert-success','alert-warning');
    msgBox.classList.add('alert');
    if (type === 'error') msgBox.classList.add('alert-danger');
    else if (type === 'success') msgBox.classList.add('alert-success');
    else if (type === 'warning') msgBox.classList.add('alert-warning');
    else msgBox.classList.add('alert-info');
    msgBox.innerText = text;
  }

  if (!cfg.apiKey) {
    showMsg('Firebase web config is missing. Check config and .env, then run php artisan config:clear', 'error');
    console.warn('Missing firebase frontend config:', cfg);
    throw new Error('Missing firebase config'); // stop further execution so you can fix config
  }

  // Initialize Firebase
  const app = initializeApp(cfg);
  const auth = getAuth(app);
  const db = getFirestore(app);
  console.log('Firebase initialized (web).');

  // Form handling
  document.getElementById('fbSignupForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    showMsg('Working...', 'info');
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    if (password.length < 6) { showMsg('Password must be at least 6 characters', 'error'); return; }

    try {
      // Try creating the user
      const userCred = await createUserWithEmailAndPassword(auth, email, password);
      const uid = userCred.user.uid;
      console.log('Firebase user created uid=', uid);

      // Create a Firestore user document (path: users/{uid})
      await setDoc(doc(db, 'Users', uid), {
        uid,
        name,
        email,
        created_at: new Date().toISOString()
      });

      showMsg('Firebase Auth + Firestore profile created. UID: ' + uid, 'success');
    } catch (err) {
      console.error('Firebase error', err);
      // common cases
      if (err.code === 'auth/email-already-in-use') {
        showMsg('Email already exists in Firebase. Attempting sign-in to confirm...', 'warning');
        try {
          const signInCred = await signInWithEmailAndPassword(auth, email, password);
          showMsg('Signed in existing Firebase user. UID: ' + signInCred.user.uid, 'success');
        } catch (siErr) {
          console.error('Sign-in failed', siErr);
          showMsg('Sign-in failed for existing user: ' + (siErr.message || siErr.code), 'error');
        }
      } else if (err.code === 'auth/invalid-api-key') {
        showMsg('Invalid Firebase API key. Check .env and config.', 'error');
      } else {
        showMsg('Firebase error: ' + (err.message || err.code), 'error');
      }
    }
  });
</script>
@endverbatim
@endpush