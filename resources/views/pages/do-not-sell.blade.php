<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Do Not Sell My Personal Information - {{ $settings->site_name ?? 'ULIX AI' }} | CCPA Rights</title>
  <meta name="description" content="Exercise your California Consumer Privacy Act (CCPA) rights. Learn how {{ $settings->site_name ?? 'ULIX AI' }} handles your personal information and how to opt-out.">
  <meta name="keywords" content="CCPA, do not sell, personal information, privacy rights, California privacy, opt-out, data protection">
  <meta name="author" content="{{ $settings->site_name ?? 'ULIX AI' }}">
  <meta name="robots" content="noindex, follow">
  <link rel="canonical" href="{{ url('/privacy/do-not-sell') }}" />
  <meta name="theme-color" content="#2563EB">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/privacy/do-not-sell') }}">
  <meta property="og:title" content="Do Not Sell My Personal Information - {{ $settings->site_name ?? 'ULIX AI' }}">
  <meta property="og:description" content="Exercise your CCPA rights and manage your personal information preferences.">
  <meta property="og:locale" content="en_US">
  <meta property="og:site_name" content="{{ $settings->site_name ?? 'ULIX AI' }}">

  <link rel="icon" type="image/png" sizes="64x64" href="/images/faviccon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #2563EB;
      --primary-light: #60A5FA;
      --accent: #A855F7;
      --success: #10B981;
      --text: #0F172A;
      --text-light: #64748B;
      --text-muted: #94A3B8;
      --bg: #FFFFFF;
      --bg-light: #F8FAFC;
      --border: #E2E8F0;
    }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: var(--text);
      background: var(--bg);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Hero Section */
    .hero {
      position: relative;
      min-height: 40vh;
      display: flex;
      align-items: center;
      padding: 120px 0 60px;
      background:
        radial-gradient(circle at 20% 30%, rgba(37, 99, 235, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.08) 0%, transparent 50%),
        linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);
    }

    .hero-content {
      text-align: center;
      width: 100%;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(168, 85, 247, 0.1));
      border: 1px solid rgba(37, 99, 235, 0.2);
      padding: 8px 16px;
      border-radius: 50px;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--primary);
      margin-bottom: 24px;
    }

    .hero h1 {
      font-size: clamp(2rem, 5vw, 3rem);
      font-weight: 700;
      margin-bottom: 16px;
      background: linear-gradient(135deg, var(--text) 0%, var(--primary) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-subtitle {
      font-size: 1.125rem;
      color: var(--text-light);
      max-width: 600px;
      margin: 0 auto;
    }

    /* Content Section */
    .content-section {
      padding: 60px 0;
    }

    .content-card {
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px;
      margin-bottom: 24px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .content-card h2 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 16px;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .content-card h2 i {
      color: var(--primary);
    }

    .content-card p {
      color: var(--text-light);
      margin-bottom: 16px;
    }

    .content-card ul {
      list-style: none;
      padding: 0;
    }

    .content-card ul li {
      padding: 12px 0;
      border-bottom: 1px solid var(--border);
      color: var(--text-light);
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .content-card ul li:last-child {
      border-bottom: none;
    }

    .content-card ul li i {
      color: var(--success);
      margin-top: 4px;
    }

    /* Info Box */
    .info-box {
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(168, 85, 247, 0.05));
      border: 1px solid rgba(37, 99, 235, 0.2);
      border-radius: 12px;
      padding: 24px;
      margin: 24px 0;
    }

    .info-box h3 {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 12px;
      color: var(--primary);
    }

    .info-box p {
      color: var(--text-light);
      margin: 0;
    }

    /* Contact Section */
    .contact-section {
      background: var(--bg-light);
      border-radius: 16px;
      padding: 40px;
      text-align: center;
      margin-top: 40px;
    }

    .contact-section h2 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 16px;
    }

    .contact-section p {
      color: var(--text-light);
      margin-bottom: 24px;
    }

    .contact-email {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--primary);
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .contact-email:hover {
      background: #1d4ed8;
      transform: translateY(-2px);
    }

    /* Rights List */
    .rights-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 24px;
    }

    .right-item {
      background: var(--bg-light);
      border-radius: 12px;
      padding: 24px;
      border: 1px solid var(--border);
    }

    .right-item h4 {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--text);
    }

    .right-item p {
      font-size: 0.875rem;
      color: var(--text-light);
      margin: 0;
    }

    /* Footer */
    .page-footer {
      padding: 40px 0;
      text-align: center;
      border-top: 1px solid var(--border);
      margin-top: 60px;
    }

    .page-footer p {
      color: var(--text-muted);
      font-size: 0.875rem;
    }

    .page-footer a {
      color: var(--primary);
      text-decoration: none;
    }

    .page-footer a:hover {
      text-decoration: underline;
    }

    /* Back Button */
    .back-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      margin-bottom: 24px;
      transition: all 0.3s ease;
    }

    .back-btn:hover {
      gap: 12px;
    }
  </style>
</head>
<body>
  @include('includes.header-content')

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <span class="hero-badge">
          <i class="fas fa-shield-alt"></i>
          CCPA Compliance
        </span>
        <h1>Do Not Sell My Personal Information</h1>
        <p class="hero-subtitle">
          Exercise your rights under the California Consumer Privacy Act (CCPA) and other privacy regulations.
        </p>
      </div>
    </div>
  </section>

  <!-- Content Section -->
  <section class="content-section">
    <div class="container">
      <a href="/" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        Back to Home
      </a>

      <!-- Important Notice -->
      <div class="content-card">
        <h2><i class="fas fa-info-circle"></i> Important Notice</h2>
        <p>
          <strong>{{ $settings->site_name ?? 'ULIX AI' }} does not sell your personal information.</strong>
        </p>
        <p>
          We are committed to protecting your privacy. We do not sell, rent, or trade your personal information
          to third parties for monetary consideration. Your data is used solely to provide and improve our
          services as described in our Privacy Policy.
        </p>

        <div class="info-box">
          <h3>What We Do With Your Data</h3>
          <p>
            We use your personal information to: facilitate service requests between users and service providers,
            process payments through Stripe, communicate with you about your account, and improve our platform.
            We share data with service providers only to fulfill your requests.
          </p>
        </div>
      </div>

      <!-- Your Rights -->
      <div class="content-card">
        <h2><i class="fas fa-user-shield"></i> Your Privacy Rights</h2>
        <p>
          Under the CCPA and similar regulations (GDPR, LGPD, etc.), you have the following rights:
        </p>

        <div class="rights-grid">
          <div class="right-item">
            <h4><i class="fas fa-eye"></i> Right to Know</h4>
            <p>Request disclosure of the personal information we collect, use, and share about you.</p>
          </div>
          <div class="right-item">
            <h4><i class="fas fa-download"></i> Right to Portability</h4>
            <p>Download a copy of your personal data in a machine-readable format (JSON).</p>
          </div>
          <div class="right-item">
            <h4><i class="fas fa-trash-alt"></i> Right to Delete</h4>
            <p>Request deletion of your personal information, subject to certain legal exceptions.</p>
          </div>
          <div class="right-item">
            <h4><i class="fas fa-ban"></i> Right to Opt-Out</h4>
            <p>Opt out of the "sale" of your personal information (we don't sell your data).</p>
          </div>
          <div class="right-item">
            <h4><i class="fas fa-equals"></i> Right to Non-Discrimination</h4>
            <p>You won't be discriminated against for exercising your privacy rights.</p>
          </div>
          <div class="right-item">
            <h4><i class="fas fa-edit"></i> Right to Correct</h4>
            <p>Request correction of inaccurate personal information we hold about you.</p>
          </div>
        </div>
      </div>

      <!-- How to Exercise Rights -->
      <div class="content-card">
        <h2><i class="fas fa-hand-pointer"></i> How to Exercise Your Rights</h2>
        <p>You can exercise your privacy rights in the following ways:</p>

        <ul>
          <li>
            <i class="fas fa-check-circle"></i>
            <div>
              <strong>Export Your Data:</strong> If you have an account, go to
              <a href="{{ route('account.export-data') }}">Account Settings → Export My Data</a>
              to download all your personal information.
            </div>
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <div>
              <strong>Delete Your Account:</strong> You can delete your account and all associated data
              from your Account Settings page.
            </div>
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <div>
              <strong>Contact Our DPO:</strong> For any privacy-related requests, contact our
              Data Protection Officer at <a href="mailto:dpo@ulixai.com">dpo@ulixai.com</a>.
            </div>
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <div>
              <strong>Manage Cookies:</strong> Use our <a href="{{ route('cookies.show') }}">Cookie Settings</a>
              to control tracking and analytics cookies.
            </div>
          </li>
        </ul>
      </div>

      <!-- Categories of Personal Information -->
      <div class="content-card">
        <h2><i class="fas fa-database"></i> Categories of Personal Information We Collect</h2>
        <p>We may collect the following categories of personal information:</p>

        <ul>
          <li>
            <i class="fas fa-check-circle"></i>
            <strong>Identifiers:</strong> Name, email address, phone number, account ID
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <strong>Commercial Information:</strong> Transaction history, services requested/provided
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <strong>Financial Information:</strong> Payment details (processed securely via Stripe)
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <strong>Geolocation Data:</strong> Location for matching with nearby service providers
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <strong>Professional Information:</strong> For service providers: skills, certifications, reviews
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <strong>Internet Activity:</strong> Browsing history on our platform, interactions with our services
          </li>
        </ul>
      </div>

      <!-- Contact Section -->
      <div class="contact-section">
        <h2>Questions About Your Privacy?</h2>
        <p>
          Our Data Protection Officer is here to help. We respond to all privacy requests within 30 days.
        </p>
        <a href="mailto:dpo@ulixai.com" class="contact-email">
          <i class="fas fa-envelope"></i>
          Contact DPO: dpo@ulixai.com
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="page-footer">
    <div class="container">
      <p>
        Last updated: {{ now()->format('F j, Y') }} |
        <a href="/termsnconditions">Terms & Conditions</a> |
        <a href="/legal-notice">Legal Notice</a> |
        <a href="{{ route('cookies.show') }}">Cookie Policy</a>
      </p>
      <p style="margin-top: 12px;">
        &copy; {{ date('Y') }} {{ $settings->site_name ?? 'ULIX AI' }}. All rights reserved.
      </p>
    </div>
  </footer>

  @include('includes.footer')
</body>
</html>
