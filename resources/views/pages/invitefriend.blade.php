<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>Invite Friends - Ulixai</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #2563EB;
      --primary-dark: #1E40AF;
      --primary-light: #60A5FA;
      --secondary: #8B5CF6;
      --accent: #EC4899;
      --success: #10B981;
      --warning: #F59E0B;
      --text: #0F172A;
      --text-light: #64748B;
      --text-muted: #94A3B8;
      --bg: #FFFFFF;
      --bg-light: #F8FAFC;
      --bg-alt: #F1F5F9;
      --border: #E2E8F0;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: var(--text);
      background: var(--bg-light);
      line-height: 1.6;
      font-size: 14px;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      text-align: center;
      padding: clamp(60px, 12vw, 120px) 20px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero h1 {
      font-size: clamp(32px, 6vw, 56px);
      font-weight: 800;
      margin-bottom: 16px;
      position: relative;
      z-index: 1;
    }

    .hero p {
      font-size: clamp(16px, 2.5vw, 20px);
      font-weight: 500;
      opacity: 0.95;
      max-width: 600px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    /* Main Section */
    .main-section {
      background: var(--bg-light);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .cards-grid {
      max-width: 1100px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr;
      gap: 30px;
    }

    @media (min-width: 768px) {
      .cards-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .card {
      background: white;
      border-radius: 20px;
      padding: clamp(24px, 4vw, 40px);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
    }

    .card h2 {
      font-size: clamp(18px, 2.5vw, 24px);
      font-weight: 700;
      color: var(--text);
      margin-bottom: 8px;
    }

    .card .subtitle {
      font-size: 14px;
      color: var(--text-light);
      margin-bottom: 24px;
    }

    /* Dashboard Link */
    .link-group {
      display: flex;
      gap: 12px;
      margin-bottom: 16px;
    }

    .link-group input {
      flex: 1;
      padding: 12px 16px;
      border: 2px solid var(--border);
      border-radius: 12px;
      font-size: 14px;
      font-family: inherit;
      background: var(--bg-light);
    }

    .copy-btn {
      padding: 12px 20px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .copy-btn:hover {
      background: var(--primary-dark);
    }

    .add-domain {
      color: var(--primary);
      font-size: 14px;
      font-weight: 600;
      background: none;
      border: none;
      cursor: pointer;
      margin-bottom: 30px;
      display: block;
    }

    .add-domain:hover {
      text-decoration: underline;
    }

    /* QR Code */
    .qr-section {
      text-align: center;
      padding: 30px;
      background: var(--bg-light);
      border-radius: 16px;
    }

    .qr-section img {
      margin-bottom: 16px;
      border-radius: 12px;
    }

    .qr-section p {
      font-size: 13px;
      color: var(--text-light);
    }

    /* Invite Form */
    .invite-form {
      display: flex;
      gap: 12px;
      margin-bottom: 30px;
    }

    .invite-form input {
      flex: 1;
      padding: 14px 18px;
      border: 2px solid var(--border);
      border-radius: 12px;
      font-size: 14px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .invite-form input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .send-btn {
      padding: 14px 24px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .send-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
    }

    /* Invited List */
    .invited-list {
      list-style: none;
      margin-bottom: 30px;
    }

    .invited-list li {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid var(--border);
      font-size: 14px;
    }

    .invited-list li:last-child {
      border-bottom: none;
    }

    .invited-list .email {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--text);
    }

    .invited-list .email img {
      width: 28px;
      height: 28px;
      border-radius: 50%;
    }

    .invited-list .status {
      font-size: 13px;
      color: var(--text-muted);
    }

    .invited-list .status.accepted {
      color: var(--success);
      font-weight: 600;
    }

    /* Seats Progress */
    .seats-info {
      padding: 20px;
      background: var(--bg-light);
      border-radius: 12px;
    }

    .seats-info p {
      font-size: 14px;
      color: var(--text-light);
      margin-bottom: 10px;
    }

    .progress-bar {
      width: 100%;
      height: 8px;
      background: var(--border);
      border-radius: 4px;
      overflow: hidden;
      margin-bottom: 12px;
    }

    .progress-bar .fill {
      height: 100%;
      background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 4px;
      transition: width 0.5s ease;
    }

    .manage-link {
      color: var(--primary);
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
    }

    .manage-link:hover {
      text-decoration: underline;
    }

    /* Benefits Section */
    .benefits-section {
      background: var(--bg-alt);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .benefits-grid {
      max-width: 1100px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 24px;
    }

    .benefit-card {
      background: white;
      padding: 30px;
      border-radius: 16px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .benefit-card .emoji {
      font-size: 40px;
      margin-bottom: 16px;
    }

    .benefit-card h3 {
      font-size: clamp(16px, 2vw, 18px);
      font-weight: 700;
      color: var(--text);
      margin-bottom: 10px;
    }

    .benefit-card p {
      font-size: 14px;
      color: var(--text-light);
    }
  </style>
</head>
<body>
@include('includes.header')
@include('wizards.requester.steps.popup_request_help')

<!-- Hero Section -->
<section class="hero">
  <h1>Invite Friends to Ulixai</h1>
  <p>Share your dashboard or invite people via email to join your team and start collaborating.</p>
</section>

<!-- Main Section -->
<section class="main-section">
  <div class="cards-grid">
    <!-- Dashboard Link & QR Code -->
    <div class="card">
      <h2>Your Dashboard is Published</h2>
      <p class="subtitle">Future changes will be published automatically.</p>

      <div class="link-group">
        <input type="text" readonly value="sales.ulixai.com" id="dashboardLink">
        <button class="copy-btn" onclick="copyDashboard()">Copy</button>
      </div>

      <button class="add-domain">+ Add custom domain</button>

      <div class="qr-section">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=sales.ulixai.com" alt="QR Code">
        <p>Scan this code with your phone to open your dashboard in the app.</p>
      </div>
    </div>

    <!-- Invite by Email -->
    <div class="card">
      <h2>Invite People to Your Dashboard</h2>
      <p class="subtitle">We'll email them instructions and a link to create an account.</p>

      <form class="invite-form" onsubmit="sendInvite(event)">
        <input type="email" placeholder="Enter email address" required>
        <button type="submit" class="send-btn">Send Invite</button>
      </form>

      <ul class="invited-list">
        <li>
          <span class="email">jack@ulixai.com</span>
          <span class="status">Invite sent</span>
        </li>
        <li>
          <span class="email">sienna@ulixai.com</span>
          <span class="status">Invite sent</span>
        </li>
        <li>
          <span class="email">frankie@ulixai.com</span>
          <span class="status">Invite sent</span>
        </li>
        <li>
          <span class="email">matt@ulixai.com</span>
          <span class="status">Invite sent</span>
        </li>
        <li>
          <span class="email">
            <img src="https://i.pravatar.cc/28?u=amelie" alt="Amelie">
            amelie@ulixai.com
          </span>
          <span class="status accepted">Invite accepted</span>
        </li>
      </ul>

      <div class="seats-info">
        <p>6/10 team seats used</p>
        <div class="progress-bar">
          <div class="fill" style="width: 60%;"></div>
        </div>
        <a href="#" class="manage-link">Manage seats</a>
      </div>
    </div>
  </div>
</section>

<!-- Benefits Section -->
<section class="benefits-section">
  <div class="benefits-grid">
    <div class="benefit-card">
      <div class="emoji">🎁</div>
      <h3>Earn Rewards</h3>
      <p>Get credits for every friend who joins and completes their first transaction.</p>
    </div>
    <div class="benefit-card">
      <div class="emoji">👥</div>
      <h3>Build Your Team</h3>
      <p>Collaborate with colleagues and share access to your dashboard.</p>
    </div>
    <div class="benefit-card">
      <div class="emoji">🚀</div>
      <h3>Grow Together</h3>
      <p>The more you invite, the more benefits you unlock for your entire team.</p>
    </div>
  </div>
</section>

@include('includes.footer')

<script>
function copyDashboard() {
  const input = document.getElementById('dashboardLink');
  navigator.clipboard.writeText(input.value).then(() => {
    const btn = document.querySelector('.copy-btn');
    btn.textContent = 'Copied!';
    setTimeout(() => btn.textContent = 'Copy', 2000);
  });
}

function sendInvite(e) {
  e.preventDefault();
  const email = e.target.querySelector('input[type="email"]').value;
  alert('Invitation sent to ' + email);
  e.target.reset();
}
</script>
{{-- Floating Bug Report Button --}}
@include('components.floating-bug-report')

</body>
</html>
