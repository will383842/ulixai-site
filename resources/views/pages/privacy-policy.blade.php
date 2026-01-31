<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Privacy Policy - Ulixai | Data Protection & Privacy 2025</title>
  <meta name="description" content="Read Ulixai's Privacy Policy. Learn how we collect, use, and protect your personal data. GDPR, CCPA, and LGPD compliant. Updated January 2025.">
  <meta name="keywords" content="privacy policy, data protection, GDPR, CCPA, personal data, privacy rights, Ulixai privacy">
  <meta name="author" content="Ulixai - Williams Jullin">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <link rel="canonical" href="https://ulixai.com/privacy-policy" />
  <meta name="theme-color" content="#2563EB">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://ulixai.com/privacy-policy">
  <meta property="og:title" content="Privacy Policy - Ulixai">
  <meta property="og:description" content="Learn how Ulixai collects, uses, and protects your personal data. GDPR, CCPA, and LGPD compliant.">
  <meta property="og:image" content="https://ulixai.com/images/og-privacy.jpg">
  <meta property="og:locale" content="en_US">
  <meta property="og:site_name" content="Ulixai">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="https://ulixai.com/privacy-policy">
  <meta name="twitter:title" content="Privacy Policy - Ulixai">
  <meta name="twitter:description" content="Learn how we protect your personal data.">

  <link rel="icon" type="image/png" sizes="64x64" href="/images/faviccon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

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
      line-height: 1.8;
      -webkit-font-smoothing: antialiased;
    }

    .container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
    @media (min-width: 640px) { .container { padding: 0 24px; } }

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

    .hero-content { text-align: center; max-width: 800px; margin: 0 auto; }
    .hero h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--text); }
    @media (min-width: 768px) { .hero h1 { font-size: 3.5rem; } }
    .hero .subtitle { font-size: 1.1rem; color: var(--text-light); max-width: 600px; margin: 0 auto; }
    .hero .last-updated { font-size: 0.9rem; color: var(--text-muted); margin-top: 1rem; }

    /* Content Section */
    .content-section { padding: 60px 0 100px; background: var(--bg-light); }

    .policy-card {
      background: white;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }

    .policy-card h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .policy-card h2 i { font-size: 1.25rem; }

    .policy-card h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--text);
      margin: 1.5rem 0 0.75rem;
    }

    .policy-card p, .policy-card li {
      color: var(--text-light);
      margin-bottom: 1rem;
    }

    .policy-card ul {
      list-style: none;
      padding-left: 0;
    }

    .policy-card ul li {
      position: relative;
      padding-left: 1.5rem;
    }

    .policy-card ul li::before {
      content: '\f00c';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      position: absolute;
      left: 0;
      color: var(--success);
      font-size: 0.8rem;
    }

    .highlight-box {
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(168, 85, 247, 0.05));
      border-left: 4px solid var(--primary);
      padding: 20px;
      border-radius: 8px;
      margin: 1.5rem 0;
    }

    .highlight-box p { margin-bottom: 0; }

    /* Table of Contents */
    .toc {
      background: white;
      border-radius: 16px;
      padding: 30px;
      margin-bottom: 40px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .toc h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: var(--text); }
    .toc ul { list-style: none; padding: 0; display: grid; gap: 8px; }
    @media (min-width: 768px) { .toc ul { grid-template-columns: repeat(2, 1fr); } }
    .toc a { color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 8px; padding: 8px 0; transition: color 0.2s; }
    .toc a:hover { color: var(--accent); }
    .toc a i { font-size: 0.75rem; }

    /* Footer */
    .footer { background: var(--text); color: white; padding: 40px 0; text-align: center; }
    .footer p { color: var(--text-muted); }
    .footer a { color: var(--primary-light); text-decoration: none; }

    /* Back Button */
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      margin-bottom: 2rem;
      transition: color 0.2s;
    }
    .back-link:hover { color: var(--accent); }
  </style>
</head>
<body>

<section class="hero">
  <div class="container">
    <div class="hero-content">
      <h1>Privacy Policy</h1>
      <p class="subtitle">We are committed to protecting your privacy and ensuring your personal data is handled responsibly.</p>
      <p class="last-updated"><i class="fas fa-calendar-alt"></i> Last updated: January 31, 2025</p>
    </div>
  </div>
</section>

<section class="content-section">
  <div class="container">
    <a href="/" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>

    <!-- Table of Contents -->
    <div class="toc">
      <h3><i class="fas fa-list"></i> Table of Contents</h3>
      <ul>
        <li><a href="#intro"><i class="fas fa-chevron-right"></i> Introduction</a></li>
        <li><a href="#data-collected"><i class="fas fa-chevron-right"></i> Data We Collect</a></li>
        <li><a href="#how-we-use"><i class="fas fa-chevron-right"></i> How We Use Your Data</a></li>
        <li><a href="#data-sharing"><i class="fas fa-chevron-right"></i> Data Sharing</a></li>
        <li><a href="#data-retention"><i class="fas fa-chevron-right"></i> Data Retention</a></li>
        <li><a href="#your-rights"><i class="fas fa-chevron-right"></i> Your Rights (GDPR/CCPA/LGPD)</a></li>
        <li><a href="#security"><i class="fas fa-chevron-right"></i> Security Measures</a></li>
        <li><a href="#cookies"><i class="fas fa-chevron-right"></i> Cookies & Tracking</a></li>
        <li><a href="#children"><i class="fas fa-chevron-right"></i> Children's Privacy</a></li>
        <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
      </ul>
    </div>

    <!-- Introduction -->
    <div class="policy-card" id="intro">
      <h2><i class="fas fa-shield-alt"></i> Introduction</h2>
      <p>Welcome to Ulixai ("we," "our," or "us"). This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our platform and services.</p>
      <p>By using Ulixai, you agree to the collection and use of information in accordance with this policy. If you do not agree with our policies and practices, please do not use our services.</p>

      <div class="highlight-box">
        <p><strong>Important:</strong> Ulixai is committed to compliance with GDPR (EU), CCPA (California), LGPD (Brazil), and other applicable data protection regulations.</p>
      </div>
    </div>

    <!-- Data We Collect -->
    <div class="policy-card" id="data-collected">
      <h2><i class="fas fa-database"></i> Data We Collect</h2>

      <h3>Personal Information</h3>
      <ul>
        <li>Name, email address, phone number</li>
        <li>Profile information (photo, bio, skills)</li>
        <li>Government-issued ID (for provider verification)</li>
        <li>Payment information (processed securely via Stripe/PayPal)</li>
        <li>Location data (country, city for service matching)</li>
      </ul>

      <h3>Usage Information</h3>
      <ul>
        <li>Device information (browser type, operating system)</li>
        <li>IP address and approximate location</li>
        <li>Pages visited and actions taken on our platform</li>
        <li>Communication history within the platform</li>
      </ul>

      <h3>Information from Third Parties</h3>
      <ul>
        <li>Social login data (Google) if you choose to sign up via OAuth</li>
        <li>Payment verification data from payment processors</li>
        <li>Identity verification results from our verification partners</li>
      </ul>
    </div>

    <!-- How We Use Your Data -->
    <div class="policy-card" id="how-we-use">
      <h2><i class="fas fa-cogs"></i> How We Use Your Data</h2>
      <p>We use the information we collect to:</p>
      <ul>
        <li>Provide, maintain, and improve our services</li>
        <li>Process transactions and send related information</li>
        <li>Match service requesters with qualified providers</li>
        <li>Verify provider identities and qualifications</li>
        <li>Send you technical notices, updates, and support messages</li>
        <li>Respond to your comments, questions, and customer service requests</li>
        <li>Detect, investigate, and prevent fraudulent transactions</li>
        <li>Comply with legal obligations and resolve disputes</li>
      </ul>
    </div>

    <!-- Data Sharing -->
    <div class="policy-card" id="data-sharing">
      <h2><i class="fas fa-share-nodes"></i> Data Sharing</h2>
      <p>We may share your information in the following situations:</p>

      <h3>With Other Users</h3>
      <p>When you use our services, certain information may be shared with other users (e.g., your profile, ratings, and reviews).</p>

      <h3>With Service Providers</h3>
      <p>We share data with third-party vendors who perform services on our behalf (payment processing, identity verification, email delivery).</p>

      <h3>For Legal Reasons</h3>
      <p>We may disclose your information if required by law, regulation, legal process, or governmental request.</p>

      <div class="highlight-box">
        <p><strong>We Never Sell Your Data:</strong> We do not sell, rent, or trade your personal information to third parties for marketing purposes.</p>
      </div>
    </div>

    <!-- Data Retention -->
    <div class="policy-card" id="data-retention">
      <h2><i class="fas fa-clock"></i> Data Retention</h2>
      <p>We retain your personal data only for as long as necessary to fulfill the purposes outlined in this policy, unless a longer retention period is required by law.</p>
      <ul>
        <li><strong>Account data:</strong> Retained while your account is active and up to 3 years after deletion</li>
        <li><strong>Transaction data:</strong> Retained for 7 years for tax and legal compliance</li>
        <li><strong>Communication logs:</strong> Retained for 2 years for dispute resolution</li>
        <li><strong>Analytics data:</strong> Aggregated and anonymized after 1 year</li>
      </ul>
    </div>

    <!-- Your Rights -->
    <div class="policy-card" id="your-rights">
      <h2><i class="fas fa-user-shield"></i> Your Rights (GDPR/CCPA/LGPD)</h2>
      <p>Depending on your location, you may have the following rights:</p>

      <h3>Right to Access</h3>
      <p>You can request a copy of all personal data we hold about you.</p>

      <h3>Right to Rectification</h3>
      <p>You can request that we correct any inaccurate or incomplete data.</p>

      <h3>Right to Erasure ("Right to be Forgotten")</h3>
      <p>You can request deletion of your personal data, subject to legal retention requirements.</p>

      <h3>Right to Data Portability</h3>
      <p>You can request your data in a structured, machine-readable format.</p>

      <h3>Right to Object</h3>
      <p>You can object to certain processing activities, including direct marketing.</p>

      <h3>Right to Withdraw Consent</h3>
      <p>Where processing is based on consent, you can withdraw it at any time.</p>

      <div class="highlight-box">
        <p><strong>California Residents (CCPA):</strong> You have the right to know what personal information we collect, request deletion, and opt-out of the sale of personal information. <a href="{{ route('privacy.do-not-sell') }}">Click here for "Do Not Sell My Personal Information"</a>.</p>
      </div>

      <p>To exercise any of these rights, please contact us at <a href="mailto:privacy@ulixai.com">privacy@ulixai.com</a> or use the data export feature in your account settings.</p>
    </div>

    <!-- Security -->
    <div class="policy-card" id="security">
      <h2><i class="fas fa-lock"></i> Security Measures</h2>
      <p>We implement industry-standard security measures to protect your data:</p>
      <ul>
        <li>SSL/TLS encryption for all data in transit</li>
        <li>Encrypted storage for sensitive data at rest</li>
        <li>Regular security audits and penetration testing</li>
        <li>Access controls and authentication requirements</li>
        <li>Secure payment processing via PCI-DSS compliant partners</li>
        <li>Document verification via Google Vision API with secure handling</li>
      </ul>
      <p>While we strive to protect your personal information, no method of transmission over the Internet is 100% secure. We cannot guarantee absolute security.</p>
    </div>

    <!-- Cookies -->
    <div class="policy-card" id="cookies">
      <h2><i class="fas fa-cookie-bite"></i> Cookies & Tracking</h2>
      <p>We use cookies and similar tracking technologies to improve your experience:</p>

      <h3>Essential Cookies</h3>
      <p>Required for the website to function (authentication, security, preferences).</p>

      <h3>Analytics Cookies</h3>
      <p>Help us understand how visitors interact with our website.</p>

      <h3>Marketing Cookies</h3>
      <p>Used to deliver relevant advertisements (with your consent).</p>

      <p>You can manage your cookie preferences at any time. <a href="{{ route('cookies.show') }}">Learn more about our cookie policy</a>.</p>
    </div>

    <!-- Children's Privacy -->
    <div class="policy-card" id="children">
      <h2><i class="fas fa-child"></i> Children's Privacy</h2>
      <p>Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with personal information, please contact us immediately.</p>
    </div>

    <!-- Contact -->
    <div class="policy-card" id="contact">
      <h2><i class="fas fa-envelope"></i> Contact Us</h2>
      <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
      <ul>
        <li><strong>Email:</strong> <a href="mailto:privacy@ulixai.com">privacy@ulixai.com</a></li>
        <li><strong>Data Protection Officer:</strong> <a href="mailto:dpo@ulixai.com">dpo@ulixai.com</a></li>
        <li><strong>Address:</strong> Ulixai, [Company Address]</li>
      </ul>
      <p>We will respond to your request within 30 days.</p>
    </div>

  </div>
</section>

<footer class="footer">
  <div class="container">
    <p>&copy; {{ date('Y') }} Ulixai. All rights reserved.</p>
    <p><a href="{{ route('terms.show') }}">Terms & Conditions</a> | <a href="{{ route('cookies.show') }}">Cookie Policy</a> | <a href="{{ route('privacy.do-not-sell') }}">Do Not Sell My Info</a></p>
  </div>
</footer>

</body>
</html>
