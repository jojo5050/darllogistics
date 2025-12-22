@extends('layout.landing')
@section('title', 'Reset Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div id="loading-state" class="text-center">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Verifying reset request...</p>
            </div>

            <div id="reset-card" class="card shadow-sm border-0 rounded-lg d-none">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4 font-weight-bold">Create New Password</h4>
                    <p id="user-email-display" class="text-center text-muted small"></p>

                    <div id="msg" class="alert d-none"></div>

                    <form id="resetForm">
                        <div class="mb-3">
                            <label class="form-label small font-weight-bold">New Password</label>
                            <input type="password" id="new_password" class="form-control" minlength="6" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small font-weight-bold">Confirm New Password</label>
                            <input type="password" id="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" id="submitBtn" class="btn btn-primary w-100 py-2">Update Password</button>
                    </form>
                </div>
            </div>

            <div id="error-state" class="alert alert-danger d-none">
                The reset link is invalid or has expired. Please request a new one.
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.__firebase_config = @json(config('firebase_frontend'), JSON_FORCE_OBJECT);
</script>

<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
    import { getAuth, verifyPasswordResetCode, confirmPasswordReset } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";

    const cfg = window.__firebase_config || {};
    const app = initializeApp(cfg);
    const auth = getAuth(app);

    // 1. Extract the action code from the URL (oobCode is the key parameter)
    const urlParams = new URLSearchParams(window.location.search);
    const actionCode = urlParams.get('oobCode');

    const loadingState = document.getElementById('loading-state');
    const resetCard = document.getElementById('reset-card');
    const errorState = document.getElementById('error-state');
    const emailDisplay = document.getElementById('user-email-display');
    const msgBox = document.getElementById('msg');
    
    let userEmail = '';

    // Verify the code is valid
    async function initReset() {
        if (!actionCode) {
            loadingState.classList.add('d-none');
            errorState.classList.remove('d-none');
            return;
        }

        try {
          
            userEmail = await verifyPasswordResetCode(auth, actionCode);
            emailDisplay.innerText = `Resetting password for: ${userEmail}`;
            
            loadingState.classList.add('d-none');
            resetCard.classList.remove('d-none');
        } catch (error) {
            console.error(error);
            loadingState.classList.add('d-none');
            errorState.classList.remove('d-none');
        }
    }

    document.getElementById('resetForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const newPass = document.getElementById('new_password').value;
        const confirmPass = document.getElementById('confirm_password').value;
        const submitBtn = document.getElementById('submitBtn');

        if (newPass !== confirmPass) {
            showMsg('Passwords do not match', 'error');
            return;
        }

        submitBtn.disabled = true;
        showMsg('Synchronizing updates...', 'info');

        try {
            // STEP 1: Update Firebase first 
            await confirmPasswordReset(auth, actionCode, newPass);

            // STEP 2: Update MySQL 
        
            const response = await fetch('/api/user/sync-password-reset', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email: userEmail,
                    new_password: newPass,
                
                    token: 'verified_via_firebase' 
                })
            });

            const result = await response.json();
            if (!result.success) throw new Error(result.message);

            showMsg('✅ Success! Your password has been updated. You can now log in.', 'success');
            setTimeout(() => window.location.href = '/login', 3000);

        } catch (error) {
            showMsg(error.message, 'error');
            submitBtn.disabled = false;
        }
    });

    function showMsg(text, type) {
        msgBox.className = `alert d-block alert-${type === 'error' ? 'danger' : (type === 'success' ? 'alert-success' : 'info')}`;
        msgBox.innerText = text;
    }

    initReset();
</script>
@endpush