@include('includes.header')

{{-- ============================================
    SIGNUP PAGE - ULIXAI 2025/2026
    ✅ Google Auth Ready
    ✅ Multi-language Ready (texts hardcoded, ready to replace with __() later)
    ✅ Mobile Perfect
    ✅ Rock Solid Code
    ============================================ --}}

<style>
    #ulixai-signup-page {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 15px;
        background: #0f172a;
        position: relative;
        overflow-x: hidden;
    }

    #ulixai-signup-page * {
        box-sizing: border-box;
    }

    #ulixai-signup-page .gradient-bg {
        position: fixed;
        inset: 0;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
        opacity: 0.2;
        animation: gradientShift 15s ease infinite;
        z-index: 0;
        pointer-events: none;
    }

    @keyframes gradientShift {
        0%, 100% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.2) rotate(5deg); }
    }

    #ulixai-signup-page .particle {
        position: fixed;
        width: 4px;
        height: 4px;
        background: rgba(59, 130, 246, 0.7);
        border-radius: 50%;
        animation: float 20s infinite;
        z-index: 0;
        pointer-events: none;
    }

    #ulixai-signup-page .particle:nth-child(2) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 15s; }
    #ulixai-signup-page .particle:nth-child(3) { left: 80%; top: 30%; animation-delay: 2s; animation-duration: 18s; }
    #ulixai-signup-page .particle:nth-child(4) { left: 30%; top: 60%; animation-delay: 4s; animation-duration: 20s; }
    #ulixai-signup-page .particle:nth-child(5) { left: 70%; top: 70%; animation-delay: 6s; animation-duration: 16s; }
    #ulixai-signup-page .particle:nth-child(6) { left: 50%; top: 10%; animation-delay: 8s; animation-duration: 22s; }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        25% { transform: translate(100px, 100px) scale(1.5); }
        50% { transform: translate(-50px, 200px) scale(1); }
        75% { transform: translate(150px, 50px) scale(1.2); }
    }

    #ulixai-signup-page .signup-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        max-width: 400px;
        width: 100%;
        padding: 20px 25px;
        position: relative;
        z-index: 1;
        animation: slideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        max-height: calc(100vh - 140px);
        overflow-y: auto;
        overflow-x: hidden;
    }

    #ulixai-signup-page .signup-container::-webkit-scrollbar {
        width: 5px;
    }

    #ulixai-signup-page .signup-container::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    #ulixai-signup-page .signup-container::-webkit-scrollbar-thumb {
        background: rgba(29, 78, 216, 0.3);
        border-radius: 10px;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    #ulixai-signup-page .signup-container::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #1d4ed8, #3b82f6, #60a5fa, #1d4ed8);
        border-radius: 20px;
        z-index: -1;
        opacity: 0.5;
        filter: blur(15px);
        animation: glow 3s ease-in-out infinite;
    }

    @keyframes glow {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 0.8; }
    }

    #ulixai-signup-page h1 {
        text-align: center;
        font-size: 22px;
        color: #1e293b;
        margin: 0 0 5px 0;
        font-weight: 800;
        animation: fadeIn 0.8s ease-out 0.2s both;
    }

    #ulixai-signup-page .subtitle {
        text-align: center;
        color: #64748b;
        font-size: 13px;
        margin: 0 0 18px 0;
        animation: fadeIn 0.8s ease-out 0.3s both;
    }

    #ulixai-signup-page .fun-emoji {
        display: inline-block;
        animation: wave 2s ease-in-out infinite;
    }

    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(20deg); }
        75% { transform: rotate(-20deg); }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    #ulixai-signup-page .social-btn {
        width: 100%;
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: 700;
        color: #334155;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        margin-bottom: 15px;
        animation: fadeIn 0.8s ease-out 0.4s both;
        font-size: 14px;
    }

    #ulixai-signup-page .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
        border-color: #3b82f6;
    }

    #ulixai-signup-page .social-btn img {
        width: 18px;
        height: 18px;
    }

    #ulixai-signup-page .divider {
        display: flex;
        align-items: center;
        margin: 15px 0;
        animation: fadeIn 0.8s ease-out 0.5s both;
    }

    #ulixai-signup-page .divider::before,
    #ulixai-signup-page .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    #ulixai-signup-page .divider span {
        padding: 0 12px;
        font-size: 12px;
        color: #94a3b8;
        font-weight: 500;
    }

    #ulixai-signup-page .form-group {
        margin-bottom: 14px;
        animation: fadeIn 0.8s ease-out calc(0.6s + var(--delay, 0s)) both;
    }

    #ulixai-signup-page .form-group:nth-child(1) { --delay: 0s; }
    #ulixai-signup-page .form-group:nth-child(2) { --delay: 0.05s; }
    #ulixai-signup-page .form-group:nth-child(3) { --delay: 0.1s; }
    #ulixai-signup-page .form-group:nth-child(4) { --delay: 0.15s; }

    #ulixai-signup-page label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }

    #ulixai-signup-page label i {
        margin-right: 5px;
        color: #1d4ed8;
    }

    #ulixai-signup-page input[type="text"],
    #ulixai-signup-page input[type="email"],
    #ulixai-signup-page input[type="password"] {
        width: 100%;
        padding: 11px 14px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
        color: #1e293b;
        font-family: inherit;
    }

    #ulixai-signup-page input[type="text"]:focus,
    #ulixai-signup-page input[type="email"]:focus,
    #ulixai-signup-page input[type="password"]:focus {
        outline: none;
        border-color: #1d4ed8;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    #ulixai-signup-page .input-wrapper {
        position: relative;
    }

    #ulixai-signup-page .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #94a3b8;
        transition: color 0.3s;
        z-index: 10;
        font-size: 14px;
    }

    #ulixai-signup-page .password-toggle:hover {
        color: #1d4ed8;
    }

    #ulixai-signup-page .password-strength {
        height: 3px;
        background: #e2e8f0;
        border-radius: 3px;
        margin-top: 6px;
        overflow: hidden;
    }

    #ulixai-signup-page .password-strength-bar {
        height: 100%;
        width: 0;
        transition: all 0.3s ease;
        border-radius: 3px;
    }

    #ulixai-signup-page .password-strength-bar.weak {
        width: 33%;
        background: #ef4444;
    }

    #ulixai-signup-page .password-strength-bar.medium {
        width: 66%;
        background: #f59e0b;
    }

    #ulixai-signup-page .password-strength-bar.strong {
        width: 100%;
        background: #10b981;
    }

    #ulixai-signup-page .password-strength-text {
        font-size: 10px;
        margin-top: 4px;
        font-weight: 600;
    }

    #ulixai-signup-page .password-strength-text.weak { color: #ef4444; }
    #ulixai-signup-page .password-strength-text.medium { color: #f59e0b; }
    #ulixai-signup-page .password-strength-text.strong { color: #10b981; }

    #ulixai-signup-page .gender-toggle {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    #ulixai-signup-page .gender-option input[type="radio"] {
        display: none;
    }

    #ulixai-signup-page .gender-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
        gap: 6px;
        font-size: 13px;
    }

    #ulixai-signup-page .gender-option label:hover {
        border-color: #3b82f6;
        background: rgba(59, 130, 246, 0.05);
    }

    #ulixai-signup-page .gender-option input[type="radio"]:checked + label {
        border-color: #1d4ed8;
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        color: white;
    }

    #ulixai-signup-page .gender-option label i {
        font-size: 14px;
        margin-right: 0;
    }

    #ulixai-signup-page .submit-btn {
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 8px;
        box-shadow: 0 8px 20px rgba(29, 78, 216, 0.3);
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.8s ease-out 0.8s both;
    }

    #ulixai-signup-page .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(29, 78, 216, 0.4);
    }

    #ulixai-signup-page .submit-btn:active {
        transform: scale(0.98);
    }

    #ulixai-signup-page .error-message {
        font-size: 11px;
        color: #ef4444;
        margin-top: 5px;
        min-height: 16px;
        display: none;
    }

    #ulixai-signup-page .error-message.show { 
        display: block;
        animation: shake 0.5s;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    #ulixai-signup-page .success-message {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
        font-weight: 600;
        font-size: 13px;
        margin-top: 12px;
        display: none;
    }

    #ulixai-signup-page .terms {
        text-align: center;
        font-size: 10px;
        color: #64748b;
        margin-top: 15px;
        line-height: 1.4;
    }

    #ulixai-signup-page .terms a {
        color: #1d4ed8;
        text-decoration: none;
        font-weight: 600;
    }

    #ulixai-signup-page .terms a:hover {
        text-decoration: underline;
    }

    #ulixai-signup-page .login-link {
        text-align: center;
        margin-top: 12px;
        font-size: 12px;
        color: #64748b;
    }

    #ulixai-signup-page .login-link a {
        color: #1d4ed8;
        text-decoration: none;
        font-weight: 700;
    }

    #ulixai-signup-page .login-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        #ulixai-signup-page {
            padding: 15px 10px;
            min-height: calc(100vh - 100px);
        }
        
        #ulixai-signup-page .signup-container {
            padding: 18px 20px;
            max-height: calc(100vh - 120px);
            border-radius: 16px;
        }
        
        #ulixai-signup-page h1 { 
            font-size: 20px; 
            margin-bottom: 4px;
        }
        
        #ulixai-signup-page .subtitle {
            font-size: 12px;
            margin-bottom: 15px;
        }
        
        #ulixai-signup-page .form-group {
            margin-bottom: 12px;
        }
        
        #ulixai-signup-page .submit-btn { 
            padding: 12px; 
        }
    }

    @media (prefers-reduced-motion: reduce) {
        #ulixai-signup-page *, 
        #ulixai-signup-page *::before, 
        #ulixai-signup-page *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    @media (max-width: 900px) and (orientation: landscape) {
        #ulixai-signup-page .signup-container {
            max-height: 90vh;
        }
    }
</style>

<div id="ulixai-signup-page">
    <div class="gradient-bg"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="signup-container">
        {{-- Texts hardcoded in English - Ready to replace with trans() later --}}
        <h1>Welcome! <span class="fun-emoji">👋</span></h1>
        <p class="subtitle">Create your account in 10 seconds ⚡</p>

        {{-- Google OAuth Button - Only shows if route exists --}}
        @if(Route::has('google.login'))
            <a href="{{ route('google.login') }}" class="social-btn">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="18" height="18">
                <span>Continue with Google</span>
            </a>
        @endif

        <div class="divider">
            <span>or with email</span>
        </div>

        @php 
            $affiliateCode = request()->query('code') ?? null;
        @endphp

        <form id="ulixaiSignupForm" method="POST" action="{{ route('user.signupRegister') }}" novalidate>
            @csrf
            
            <div class="form-group">
                <label for="ulixai-name">
                    <i class="fas fa-user"></i>
                    Full Name
                </label>
                <input type="text" 
                       id="ulixai-name" 
                       name="name" 
                       placeholder="John Doe" 
                       required 
                       autocomplete="name"
                       value="{{ old('name') }}">
                <div class="error-message" id="error-name">
                    @error('name') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="ulixai-email">
                    <i class="fas fa-envelope"></i>
                    Email
                </label>
                <input type="email" 
                       id="ulixai-email" 
                       name="email" 
                       placeholder="you@example.com" 
                       required
                       autocomplete="email"
                       value="{{ old('email') }}">
                <div class="error-message" id="error-email">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="ulixai-password">
                    <i class="fas fa-lock"></i>
                    Password
                </label>
                <div class="input-wrapper">
                    <input type="password" 
                           id="ulixai-password" 
                           name="password" 
                           placeholder="Min. 6 characters" 
                           required
                           autocomplete="new-password"
                           minlength="6">
                    <i class="fas fa-eye password-toggle" id="ulixaiTogglePassword"></i>
                </div>
                <div class="password-strength">
                    <div class="password-strength-bar" id="ulixaiStrengthBar"></div>
                </div>
                <div class="password-strength-text" id="ulixaiStrengthText"></div>
                <div class="error-message" id="error-password">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-venus-mars"></i>
                    Gender
                </label>
                <div class="gender-toggle">
                    <div class="gender-option">
                        <input type="radio" name="gender" id="ulixai-male" value="Male" required {{ old('gender') == 'Male' ? 'checked' : '' }}>
                        <label for="ulixai-male">
                            <i class="fas fa-mars"></i>
                            <span>Male</span>
                        </label>
                    </div>
                    <div class="gender-option">
                        <input type="radio" name="gender" id="ulixai-female" value="Female" required {{ old('gender') == 'Female' ? 'checked' : '' }}>
                        <label for="ulixai-female">
                            <i class="fas fa-venus"></i>
                            <span>Female</span>
                        </label>
                    </div>
                </div>
                <div class="error-message" id="error-gender">
                    @error('gender') {{ $message }} @enderror
                </div>
            </div>

            <input type="hidden" name="affiliate_code" value="{{ $affiliateCode }}">

            <button type="submit" class="submit-btn">
                <span>Let's Go! 🚀</span>
            </button>

            @if(session('success'))
                <div class="success-message" style="display:block;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="error-message show">
                    {{ session('error') }}
                </div>
            @endif
        </form>

        <p class="terms">
            By creating an account, you agree to our<br>
            <a href="/terms">Terms</a> and <a href="/privacy">Privacy Policy</a>
        </p>

        <p class="login-link">
            Already a member? <a href="/login">Sign in</a>
        </p>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    const togglePassword = document.getElementById('ulixaiTogglePassword');
    const passwordInput = document.getElementById('ulixai-password');
    const strengthBar = document.getElementById('ulixaiStrengthBar');
    const strengthText = document.getElementById('ulixaiStrengthText');
    const form = document.getElementById('ulixaiSignupForm');

    // Password toggle
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

    // Password strength
    if (passwordInput && strengthBar && strengthText) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);

            strengthBar.className = 'password-strength-bar';
            strengthText.className = 'password-strength-text';

            if (password.length === 0) {
                strengthText.textContent = '';
                return;
            }

            if (strength === 'weak') {
                strengthBar.classList.add('weak');
                strengthText.classList.add('weak');
                strengthText.textContent = '🔴 Weak';
            } else if (strength === 'medium') {
                strengthBar.classList.add('medium');
                strengthText.classList.add('medium');
                strengthText.textContent = '🟡 Medium';
            } else if (strength === 'strong') {
                strengthBar.classList.add('strong');
                strengthText.classList.add('strong');
                strengthText.textContent = '🟢 Strong';
            }
        });
    }

    function calculatePasswordStrength(password) {
        if (password.length < 6) return 'weak';
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        if (strength <= 2) return 'weak';
        if (strength <= 4) return 'medium';
        return 'strong';
    }

    // Form validation
    if (form) {
        form.addEventListener('submit', function(e) {
            // Clear errors
            document.querySelectorAll('#ulixai-signup-page .error-message').forEach(el => {
                if (!el.textContent.trim()) {
                    el.classList.remove('show');
                    el.textContent = '';
                }
            });

            let isValid = true;

            const name = document.getElementById('ulixai-name').value.trim();
            if (!name) {
                showError('error-name', '❌ Name required');
                isValid = false;
            } else if (name.length < 2) {
                showError('error-name', '❌ Name too short');
                isValid = false;
            }

            const email = document.getElementById('ulixai-email').value.trim();
            const emailRegex = /^\S+@\S+\.\S+$/;
            if (!email) {
                showError('error-email', '❌ Email required');
                isValid = false;
            } else if (!emailRegex.test(email)) {
                showError('error-email', '❌ Invalid email');
                isValid = false;
            }

            const password = passwordInput.value;
            if (!password) {
                showError('error-password', '❌ Password required');
                isValid = false;
            } else if (password.length < 6) {
                showError('error-password', '❌ Min. 6 characters');
                isValid = false;
            }

            const gender = document.querySelector('input[name="gender"]:checked');
            if (!gender) {
                showError('error-gender', '❌ Select gender');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    }

    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement && !errorElement.textContent.trim()) {
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }
    }

    // Sparkle particles
    setInterval(() => {
        const particles = document.querySelectorAll('#ulixai-signup-page .particle');
        if (particles.length > 0) {
            const randomParticle = particles[Math.floor(Math.random() * particles.length)];
            const blue1 = 59 + Math.random() * 100;
            const blue2 = 130 + Math.random() * 100;
            randomParticle.style.background = `rgba(${blue1}, ${blue2}, 246, 0.8)`;
        }
    }, 2000);
})();
</script>

@include('includes.footer')