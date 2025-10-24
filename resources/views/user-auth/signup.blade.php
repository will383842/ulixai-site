@include('includes.header')

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  :root {
    --primary: #1d4ed8;
    --primary-dark: #1e40af;
    --primary-light: #3b82f6;
  }

  body {
    overflow-x: hidden;
  }

  .signup-section {
    min-height: 100vh;
    min-height: 100dvh;
    background: #0f172a;
    position: relative;
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    overscroll-behavior-y: contain;
  }

  /* Animated gradient background - TOUJOURS VISIBLE */
  .gradient-bg {
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
    opacity: 0.25;
    animation: gradientShift 15s ease infinite;
    z-index: 0;
    pointer-events: none;
  }

  @keyframes gradientShift {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.2) rotate(5deg); }
  }

  @media (prefers-reduced-motion: reduce) {
    .gradient-bg { animation: none; }
  }

  /* Floating particles - TOUJOURS VISIBLES */
  .particle {
    position: fixed;
    width: 5px;
    height: 5px;
    background: rgba(59, 130, 246, 0.8);
    border-radius: 50%;
    animation: float 20s infinite;
    z-index: 0;
    pointer-events: none;
    box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
  }

  .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 15s; }
  .particle:nth-child(2) { left: 80%; top: 30%; animation-delay: 2s; animation-duration: 18s; }
  .particle:nth-child(3) { left: 30%; top: 60%; animation-delay: 4s; animation-duration: 20s; }
  .particle:nth-child(4) { left: 70%; top: 70%; animation-delay: 6s; animation-duration: 16s; }
  .particle:nth-child(5) { left: 50%; top: 10%; animation-delay: 8s; animation-duration: 22s; }

  @keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    25% { transform: translate(100px, 100px) scale(1.5); }
    50% { transform: translate(-50px, 200px) scale(1); }
    75% { transform: translate(150px, 50px) scale(1.2); }
  }

  @media (prefers-reduced-motion: reduce) {
    .particle { animation: none; opacity: 0.4; }
  }

  .signup-container {
    background: rgba(255, 255, 255, 0.97);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    position: relative;
    z-index: 1;
    animation: slideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
    margin: 0 auto;
    width: 100%;
  }

  /* Desktop: container avec bordures arrondies */
  @media (min-width: 768px) {
    .signup-section {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }

    .signup-container {
      border-radius: 24px;
      box-shadow: 0 50px 100px rgba(0, 0, 0, 0.4);
      max-width: 600px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: clamp(32px, 5vw, 48px);
    }

    .signup-container::before {
      content: '';
      position: absolute;
      inset: -2px;
      background: linear-gradient(45deg, var(--primary), var(--primary-light), #60a5fa, var(--primary));
      border-radius: 24px;
      z-index: -1;
      opacity: 0.5;
      filter: blur(20px);
      animation: glow 3s ease-in-out infinite;
      pointer-events: none;
    }

    @keyframes glow {
      0%, 100% { opacity: 0.5; }
      50% { opacity: 0.8; }
    }
  }

  /* Mobile: plein écran, textes plus grands */
  @media (max-width: 767px) {
    .signup-section {
      padding: 0;
    }

    .signup-container {
      min-height: 100vh;
      min-height: 100dvh;
      border-radius: 0;
      padding: max(24px, env(safe-area-inset-top)) 24px max(24px, env(safe-area-inset-bottom)) 24px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @media (prefers-reduced-motion: reduce) {
    .signup-container { animation: none; }
  }

  .signup-container h1 {
    text-align: center;
    font-size: clamp(28px, 7vw, 32px);
    color: #1e293b;
    margin-block-end: 10px;
    font-weight: 800;
    animation: fadeIn 0.8s ease-out 0.2s both;
    line-height: 1.2;
  }

  .subtitle {
    text-align: center;
    color: #64748b;
    font-size: clamp(15px, 4vw, 17px);
    margin-block-end: 32px;
    animation: fadeIn 0.8s ease-out 0.3s both;
    line-height: 1.5;
  }

  .fun-emoji {
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

  @media (prefers-reduced-motion: reduce) {
    .fun-emoji, .signup-container h1, .subtitle { animation: none; }
  }

  .social-btn {
    width: 100%;
    padding: 17px;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    background: white;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    font-weight: 700;
    color: #334155;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    margin-block-end: 28px;
    animation: fadeIn 0.8s ease-out 0.4s both;
    font-size: clamp(15px, 4vw, 16px);
    min-height: 54px;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
  }

  @media (max-width: 767px) {
    .social-btn {
      min-height: 56px;
      padding: 18px;
    }
  }

  .social-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s;
  }

  @media (hover: hover) {
    .social-btn:hover::before { transform: translateX(100%); }
    .social-btn:hover {
      border-color: var(--primary);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(29, 78, 216, 0.2);
    }
  }

  .social-btn:active { 
    transform: scale(0.98); 
    box-shadow: 0 4px 12px rgba(29, 78, 216, 0.15);
  }

  .social-btn:focus-visible { outline: 3px solid var(--primary); outline-offset: 2px; }
  .social-btn img { 
    width: 24px; 
    height: 24px; 
  }

  .divider {
    display: flex;
    align-items: center;
    margin: 28px 0;
    color: #94a3b8;
    font-size: clamp(13px, 3.5vw, 14px);
    animation: fadeIn 0.8s ease-out 0.5s both;
  }

  .divider::before,
  .divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(to right, transparent, #cbd5e1, transparent);
  }

  .divider span {
    padding-inline: 16px;
    font-weight: 600;
  }

  .form-group {
    margin-block-end: 22px;
    animation: fadeIn 0.8s ease-out calc(0.6s + var(--delay, 0s)) both;
  }

  .form-group:nth-of-type(1) { --delay: 0s; }
  .form-group:nth-of-type(2) { --delay: 0.05s; }
  .form-group:nth-of-type(3) { --delay: 0.1s; }
  .form-group:nth-of-type(4) { --delay: 0.15s; }

  .form-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-block-end: 10px;
    font-size: clamp(14px, 3.5vw, 15px);
    font-weight: 700;
    color: #334155;
  }

  .form-group label i {
    color: var(--primary);
    font-size: clamp(16px, 4vw, 17px);
  }

  .form-group input[type="text"],
  .form-group input[type="email"],
  .form-group input[type="password"] {
    width: 100%;
    padding: 17px 18px;
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    font-size: clamp(15px, 4vw, 16px);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    font-family: inherit;
    touch-action: manipulation;
    -webkit-appearance: none;
    appearance: none;
    line-height: 1.5;
  }

  @media (max-width: 767px) {
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      padding: 18px 20px;
      font-size: 16px; /* Prevent iOS zoom */
    }
  }

  .form-group input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.12);
    background: #fafbfc;
  }

  .form-group input::placeholder { 
    color: #94a3b8;
    font-size: clamp(14px, 3.5vw, 15px);
  }

  .input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
  }

  .password-toggle {
    position: absolute;
    inset-inline-end: 16px;
    cursor: pointer;
    color: #94a3b8;
    transition: all 0.2s;
    padding: 12px;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
    font-size: clamp(18px, 5vw, 20px);
  }

  .password-toggle:hover { 
    color: var(--primary);
    transform: scale(1.1);
  }

  .password-toggle:active {
    transform: scale(0.95);
  }

  .password-strength {
    height: 6px;
    background: #e2e8f0;
    border-radius: 6px;
    margin-block-start: 10px;
    overflow: hidden;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
  }

  .password-strength-bar {
    height: 100%;
    width: 0%;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 6px;
  }

  .password-strength-bar.weak { width: 33%; background: linear-gradient(90deg, #ef4444, #f87171); box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3); }
  .password-strength-bar.medium { width: 66%; background: linear-gradient(90deg, #f59e0b, #fbbf24); box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3); }
  .password-strength-bar.strong { width: 100%; background: linear-gradient(90deg, #10b981, #34d399); box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3); }

  .password-strength-text {
    font-size: clamp(12px, 3vw, 13px);
    margin-block-start: 6px;
    font-weight: 700;
    transition: all 0.3s;
    min-height: 20px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .password-strength-text.weak { color: #ef4444; }
  .password-strength-text.medium { color: #f59e0b; }
  .password-strength-text.strong { color: #10b981; }

  .gender-toggle {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-block-start: 10px;
  }

  .gender-option { position: relative; }

  .gender-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }

  .gender-option label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 20px 14px;
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    font-size: clamp(14px, 3.5vw, 15px);
    font-weight: 700;
    color: #64748b;
    min-height: 60px;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
  }

  @media (max-width: 767px) {
    .gender-option label {
      min-height: 64px;
      padding: 22px 16px;
    }
  }

  .gender-option label i {
    font-size: clamp(24px, 6vw, 26px);
    color: #94a3b8;
    transition: all 0.2s;
  }

  .gender-option input:checked + label {
    border-color: var(--primary);
    background: linear-gradient(135deg, rgba(29, 78, 216, 0.08), rgba(59, 130, 246, 0.08));
    color: var(--primary);
    box-shadow: 0 4px 20px rgba(29, 78, 216, 0.2);
    transform: translateY(-2px);
  }

  .gender-option input:checked + label i {
    color: var(--primary);
    transform: scale(1.2);
  }

  @media (hover: hover) {
    .gender-option label:hover {
      border-color: var(--primary-light);
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(29, 78, 216, 0.15);
    }
  }

  .gender-option label:active { transform: scale(0.98) translateY(0); }
  .gender-option input:focus-visible + label { outline: 3px solid var(--primary); outline-offset: 2px; }

  .error-message {
    font-size: clamp(13px, 3.5vw, 14px);
    color: #ef4444;
    margin-block-start: 8px;
    display: none;
    font-weight: 600;
    animation: shake 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97);
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .error-message.show { 
    display: flex;
    min-height: 22px; 
  }

  .error-message::before {
    content: '⚠️';
    font-size: clamp(14px, 4vw, 16px);
  }

  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
    20%, 40%, 60%, 80% { transform: translateX(8px); }
  }

  .submit-btn {
    width: 100%;
    padding: 19px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: white;
    border: none;
    border-radius: 16px;
    font-size: clamp(16px, 4vw, 17px);
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    margin-block-start: 16px;
    position: relative;
    overflow: hidden;
    animation: fadeIn 0.8s ease-out 1s both;
    min-height: 58px;
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
    box-shadow: 0 4px 16px rgba(29, 78, 216, 0.3);
  }

  @media (max-width: 767px) {
    .submit-btn {
      min-height: 60px;
      padding: 20px;
    }
  }

  .submit-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--primary-light), #60a5fa);
    opacity: 0;
    transition: opacity 0.3s;
  }

  @media (hover: hover) {
    .submit-btn:hover::before { opacity: 1; }
    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 32px rgba(29, 78, 216, 0.4);
    }
  }

  .submit-btn:active { 
    transform: scale(0.98) translateY(0); 
    box-shadow: 0 4px 16px rgba(29, 78, 216, 0.3);
  }

  .submit-btn:focus-visible { outline: 3px solid var(--primary); outline-offset: 3px; }
  .submit-btn:disabled { 
    opacity: 0.6; 
    cursor: not-allowed; 
    transform: none !important;
    box-shadow: 0 2px 8px rgba(29, 78, 216, 0.2);
  }
  .submit-btn span { 
    position: relative; 
    z-index: 1;
    font-size: clamp(16px, 4vw, 17px);
  }

  .success-message {
    display: none;
    text-align: center;
    padding: 18px 20px;
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #166534;
    border-radius: 14px;
    margin-block-start: 20px;
    font-weight: 700;
    font-size: clamp(15px, 4vw, 16px);
    animation: slideDown 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.2);
  }

  @keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
  }

  .loading-dots span { animation: blink 1.4s infinite both; }
  .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
  .loading-dots span:nth-child(3) { animation-delay: 0.4s; }

  @keyframes blink {
    0%, 80%, 100% { opacity: 0; }
    40% { opacity: 1; }
  }

  .terms {
    text-align: center;
    font-size: clamp(12px, 3vw, 13px);
    color: #64748b;
    margin-block-start: 28px;
    line-height: 1.7;
    animation: fadeIn 0.8s ease-out 1.1s both;
  }

  .terms a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 700;
    transition: color 0.2s;
    touch-action: manipulation;
  }

  .terms a:hover { color: var(--primary-dark); text-decoration: underline; }
  .terms a:focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; border-radius: 3px; }

  .login-link {
    text-align: center;
    font-size: clamp(14px, 3.5vw, 15px);
    color: #64748b;
    margin-block-start: 20px;
    animation: fadeIn 0.8s ease-out 1.2s both;
  }

  .login-link a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 800;
    transition: all 0.2s;
    touch-action: manipulation;
  }

  .login-link a:hover { color: var(--primary-dark); text-decoration: underline; }
  .login-link a:focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; border-radius: 3px; }

  @media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
      animation-duration: 0.01ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.01ms !important;
    }
  }

  /* Haptic feedback simulation */
  @keyframes haptic {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(0.97); }
  }

  .haptic-feedback {
    animation: haptic 0.1s ease-out;
  }

  /* Performance optimizations */
  .signup-container,
  .social-btn,
  .submit-btn,
  .gender-option label {
    will-change: transform;
    transform: translateZ(0);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
</style>

<div class="signup-section">
  <div class="gradient-bg"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>

  <div class="signup-container">
    <h1>Join Ulixai <span class="fun-emoji">🚀</span></h1>
    <p class="subtitle">Start your journey with us today!</p>

    <a href="{{ route('google.login') }}" class="social-btn" aria-label="Continue with Google">
      <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="" aria-hidden="true" width="24" height="24">
      <span>Continue with Google</span>
    </a>

    <div class="divider">
      <span>or sign up with email</span>
    </div>

    @php 
      $affiliateCode = request()->query('code') ?? null;
    @endphp

    <form id="signupForm" method="POST" action="{{route('user.signupRegister')}}" autocomplete="off" novalidate>
      @csrf

      <div class="form-group">
        <label for="name">
          <i class="fas fa-user" aria-hidden="true"></i>
          <span>Full Name</span>
        </label>
        <input 
          type="text" 
          id="name" 
          name="name" 
          placeholder="John Doe" 
          required
          autocomplete="name"
          aria-describedby="error-name"
          aria-invalid="false"
        >
        <div class="error-message" id="error-name" role="alert" aria-live="polite"></div>
      </div>

      <div class="form-group">
        <label for="email">
          <i class="fas fa-envelope" aria-hidden="true"></i>
          <span>Email</span>
        </label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          placeholder="you@example.com" 
          required
          autocomplete="email"
          inputmode="email"
          aria-describedby="error-email"
          aria-invalid="false"
        >
        <div class="error-message" id="error-email" role="alert" aria-live="polite"></div>
      </div>

      <div class="form-group">
        <label for="password">
          <i class="fas fa-lock" aria-hidden="true"></i>
          <span>Password</span>
        </label>
        <div class="input-wrapper">
          <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Min. 6 characters" 
            required
            minlength="6"
            autocomplete="new-password"
            aria-describedby="error-password strengthText"
            aria-invalid="false"
          >
          <i class="fas fa-eye password-toggle" id="togglePassword" role="button" tabindex="0" aria-label="Toggle password visibility"></i>
        </div>
        <div class="password-strength">
          <div class="password-strength-bar" id="strengthBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="password-strength-text" id="strengthText" aria-live="polite"></div>
        <div class="error-message" id="error-password" role="alert" aria-live="polite"></div>
      </div>

      <input type="hidden" name="password_confirmation" id="password_confirmation" value="">

      <fieldset class="form-group">
        <legend>
          <i class="fas fa-venus-mars" aria-hidden="true"></i>
          <span>Gender</span>
        </legend>
        <div class="gender-toggle" role="radiogroup" aria-describedby="error-gender">
          <div class="gender-option">
            <input type="radio" name="gender" id="male" value="Male" required>
            <label for="male">
              <i class="fas fa-mars" aria-hidden="true"></i>
              <span>Male</span>
            </label>
          </div>
          <div class="gender-option">
            <input type="radio" name="gender" id="female" value="Female" required>
            <label for="female">
              <i class="fas fa-venus" aria-hidden="true"></i>
              <span>Female</span>
            </label>
          </div>
        </div>
        <div class="error-message" id="error-gender" role="alert" aria-live="polite"></div>
      </fieldset>

      <input type="hidden" name="affiliate_code" value="{{ $affiliateCode }}" aria-hidden="true">

      <button type="submit" id="signupBtnSubmit" class="submit-btn">
        <span>Let's Go! 🚀</span>
      </button>

      <div class="success-message" id="signup-success" role="status" aria-live="polite">
        ✨ Account created! Redirecting<span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>
      </div>

      <div class="error-message" id="signup-error" role="alert" aria-live="assertive" style="text-align: center; margin-block-start: 20px;"></div>
    </form>

    <p class="terms">
      By creating an account, you agree to our<br>
      <a href="#" tabindex="0">Terms</a> and <a href="#" tabindex="0">Privacy Policy</a>
    </p>

    <p class="login-link">
      Already a member? <a href="/login" tabindex="0">Sign in</a>
    </p>
  </div>
</div>

@include('includes.footer')

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const passwordConfirmation = document.getElementById('password_confirmation');

  if (togglePassword && passwordInput) {
    const toggleVisibility = function() {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      togglePassword.classList.toggle('fa-eye');
      togglePassword.classList.toggle('fa-eye-slash');
      
      togglePassword.classList.add('haptic-feedback');
      setTimeout(() => togglePassword.classList.remove('haptic-feedback'), 100);
      
      if ('vibrate' in navigator) navigator.vibrate(10);
    };

    togglePassword.addEventListener('click', toggleVisibility);
    togglePassword.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleVisibility();
      }
    });
  }

  const strengthBar = document.getElementById('strengthBar');
  const strengthText = document.getElementById('strengthText');

  if (passwordInput && strengthBar && strengthText) {
    passwordInput.addEventListener('input', function() {
      const password = this.value;
      const strength = calculatePasswordStrength(password);

      if (passwordConfirmation) passwordConfirmation.value = password;

      strengthBar.className = 'password-strength-bar';
      strengthText.className = 'password-strength-text';

      if (password.length === 0) {
        strengthText.textContent = '';
        strengthBar.setAttribute('aria-valuenow', '0');
        return;
      }

      if (strength === 'weak') {
        strengthBar.classList.add('weak');
        strengthText.classList.add('weak');
        strengthText.textContent = '🔴 Weak password';
        strengthBar.setAttribute('aria-valuenow', '33');
      } else if (strength === 'medium') {
        strengthBar.classList.add('medium');
        strengthText.classList.add('medium');
        strengthText.textContent = '🟡 Medium strength';
        strengthBar.setAttribute('aria-valuenow', '66');
      } else if (strength === 'strong') {
        strengthBar.classList.add('strong');
        strengthText.classList.add('strong');
        strengthText.textContent = '🟢 Strong password';
        strengthBar.setAttribute('aria-valuenow', '100');
        
        if ('vibrate' in navigator) navigator.vibrate([10, 50, 10]);
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

  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('signupForm');
    const signupBtn = document.getElementById('signupBtnSubmit');
    
    if (!form) return;

    const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value.trim()) validateField(this);
      });

      input.addEventListener('focus', function() {
        const errorId = 'error-' + this.name;
        const errorEl = document.getElementById(errorId);
        if (errorEl) {
          errorEl.classList.remove('show');
          errorEl.textContent = '';
          this.setAttribute('aria-invalid', 'false');
        }
      });
    });

    form.addEventListener('submit', function (e) {
      const successMsg = document.getElementById('signup-success');
      const errorMsg = document.getElementById('signup-error');
      
      if (successMsg) successMsg.style.display = 'none';
      if (errorMsg) errorMsg.style.display = 'none';
      
      ['name', 'email', 'password', 'gender'].forEach(f => {
        const errorEl = document.getElementById('error-' + f);
        if (errorEl) {
          errorEl.textContent = '';
          errorEl.classList.remove('show');
        }
      });

      document.querySelectorAll('input').forEach(input => {
        input.setAttribute('aria-invalid', 'false');
      });

      let valid = true;
      let firstInvalidField = null;

      const name = form.elements['name'].value.trim();
      const email = form.elements['email'].value.trim();
      const password = form.elements['password'].value;
      let gender = '';
      
      if (form.elements['gender'].length) {
        for (const radio of form.elements['gender']) {
          if (radio.checked) gender = radio.value;
        }
      } else {
        gender = form.elements['gender'].value;
      }

      if (!name) {
        showError('error-name', 'Name is required', document.getElementById('name'));
        if (!firstInvalidField) firstInvalidField = document.getElementById('name');
        valid = false;
      }
      
      if (!email) {
        showError('error-email', 'Email is required', document.getElementById('email'));
        if (!firstInvalidField) firstInvalidField = document.getElementById('email');
        valid = false;
      } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        showError('error-email', 'Please enter a valid email', document.getElementById('email'));
        if (!firstInvalidField) firstInvalidField = document.getElementById('email');
        valid = false;
      }
      
      if (!password) {
        showError('error-password', 'Password is required', document.getElementById('password'));
        if (!firstInvalidField) firstInvalidField = document.getElementById('password');
        valid = false;
      } else if (password.length < 6) {
        showError('error-password', 'Password must be at least 6 characters', document.getElementById('password'));
        if (!firstInvalidField) firstInvalidField = document.getElementById('password');
        valid = false;
      }
      
      if (!gender) {
        showError('error-gender', 'Please select your gender');
        if (!firstInvalidField) firstInvalidField = document.getElementById('male');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
        if (signupBtn) signupBtn.disabled = false;
        
        if ('vibrate' in navigator) navigator.vibrate([50, 100, 50]);

        if (firstInvalidField) {
          firstInvalidField.focus();
          setTimeout(() => {
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }, 100);
        }
        return false;
      }

      if ('vibrate' in navigator) navigator.vibrate(50);
    });
  });

  function validateField(field) {
    const errorId = 'error-' + field.name;
    const errorEl = document.getElementById(errorId);
    const value = field.value.trim();

    if (field.name === 'email' && value) {
      if (!/^\S+@\S+\.\S+$/.test(value)) {
        showError(errorId, 'Please enter a valid email', field);
      }
    }
  }

  function showError(elementId, message, inputElement) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
      errorElement.textContent = message;
      errorElement.classList.add('show');
    }
    if (inputElement) {
      inputElement.setAttribute('aria-invalid', 'true');
    }
  }

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!prefersReducedMotion) {
    setInterval(() => {
      const particles = document.querySelectorAll('.particle');
      if (particles.length > 0) {
        const randomParticle = particles[Math.floor(Math.random() * particles.length)];
        const blue1 = 59 + Math.random() * 100;
        const blue2 = 130 + Math.random() * 100;
        randomParticle.style.background = `rgba(${blue1}, ${blue2}, 246, 0.8)`;
      }
    }, 2000);
  }

  if ('ontouchstart' in window) {
    document.addEventListener('touchstart', function() {}, { passive: true });
    document.addEventListener('touchmove', function() {}, { passive: true });
  }

  const buttons = document.querySelectorAll('button, .social-btn, .gender-option label');
  buttons.forEach(button => {
    button.addEventListener('click', function() {
      if ('vibrate' in navigator) navigator.vibrate(10);
    });
  });
</script>