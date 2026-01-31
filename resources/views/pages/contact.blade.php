<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>Contact Us - Ulixai</title>

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
      background: var(--bg);
      line-height: 1.6;
      font-size: 14px;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 50%, var(--secondary) 100%);
      color: white;
      text-align: center;
      padding: clamp(60px, 10vw, 100px) 20px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 50%);
      animation: pulse 15s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.5; }
      50% { transform: scale(1.1); opacity: 0.3; }
    }

    .hero h1 {
      font-size: clamp(28px, 5vw, 48px);
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

    /* Contact Section */
    .contact-section {
      background: var(--bg-light);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .contact-card {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      border-radius: 24px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr;
    }

    @media (min-width: 768px) {
      .contact-card {
        grid-template-columns: 1fr 2fr;
      }
    }

    /* Info Panel */
    .info-panel {
      background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
      color: white;
      padding: clamp(30px, 5vw, 50px);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .info-panel h2 {
      font-size: clamp(20px, 3vw, 28px);
      font-weight: 700;
      margin-bottom: 20px;
    }

    .info-panel p {
      font-size: clamp(14px, 2vw, 16px);
      opacity: 0.9;
      margin-bottom: 12px;
      line-height: 1.7;
    }

    .info-panel .icon {
      font-size: 24px;
      margin-right: 8px;
    }

    /* Form Panel */
    .form-panel {
      padding: clamp(30px, 5vw, 50px);
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    @media (min-width: 640px) {
      .form-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group.full-width {
      grid-column: 1 / -1;
    }

    .form-group label {
      font-size: 14px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 8px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 14px 16px;
      border: 2px solid var(--border);
      border-radius: 12px;
      font-size: 14px;
      font-family: inherit;
      transition: all 0.3s ease;
      background: var(--bg);
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 120px;
    }

    .checkbox-group {
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .checkbox-group input[type="checkbox"] {
      width: 20px;
      height: 20px;
      accent-color: var(--primary);
      margin-top: 2px;
    }

    .checkbox-group label {
      font-size: 13px;
      color: var(--text-light);
      font-weight: 400;
    }

    .checkbox-group a {
      color: var(--primary);
      text-decoration: underline;
    }

    .submit-btn {
      width: 100%;
      padding: 16px 32px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    /* Additional Info Section */
    .info-section {
      background: var(--bg-alt);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .info-grid {
      max-width: 1000px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
    }

    .info-card {
      background: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      text-align: center;
      transition: transform 0.3s ease;
    }

    .info-card:hover {
      transform: translateY(-5px);
    }

    .info-card .emoji {
      font-size: 40px;
      margin-bottom: 16px;
    }

    .info-card h3 {
      font-size: clamp(16px, 2vw, 20px);
      font-weight: 700;
      color: var(--text);
      margin-bottom: 12px;
    }

    .info-card p {
      font-size: 14px;
      color: var(--text-light);
      line-height: 1.6;
    }
  </style>
</head>
<body>
@include('includes.header')

<!-- Hero Section -->
<section class="hero">
  <h1>Need Help or Have Questions?</h1>
  <p>Our team is here to respond to all your inquiries quickly and efficiently. We typically reply within 24-72 hours.</p>
</section>

<!-- Contact Form Section -->
<section class="contact-section">
  <div class="contact-card">
    <!-- Info Panel -->
    <div class="info-panel">
      <h2>Let's Connect</h2>
      <p><span class="icon">📬</span> Whether it's a partnership inquiry, platform improvement request, or general question - we're here to help.</p>
      <p><span class="icon">⏱️</span> Average response time: 24-72 hours</p>
      <p><span class="icon">🌍</span> We support inquiries in multiple languages</p>
    </div>

    <!-- Form Panel -->
    <div class="form-panel">
      <form class="form-grid" id="contactForm">
        @csrf

        <div class="form-group full-width">
          <label for="title">Title</label>
          <select id="title" name="title" required>
            <option value="">Select</option>
            <option value="Mr.">Mr.</option>
            <option value="Mrs.">Mrs.</option>
            <option value="Ms.">Ms.</option>
            <option value="Dr.">Dr.</option>
          </select>
        </div>

        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="+33 6 12 34 56 78">
        </div>

        <div class="form-group full-width">
          <label for="subject">Subject</label>
          <select id="subject" name="subject" required>
            <option value="">Select a topic</option>
            <option value="partnership">Partnership Inquiry</option>
            <option value="support">Technical Support</option>
            <option value="feedback">Platform Feedback</option>
            <option value="affiliation">Affiliation Program</option>
            <option value="press">Press & Media</option>
            <option value="other">Other</option>
          </select>
        </div>

        <div class="form-group full-width">
          <label for="message">Your Message</label>
          <textarea id="message" name="message" rows="5" placeholder="Tell us how we can help you..." required></textarea>
        </div>

        <div class="form-group full-width">
          <div class="checkbox-group">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I accept the <a href="/terms">terms and conditions</a> and <a href="/privacy">privacy policy</a>.</label>
          </div>
        </div>

        <div class="form-group full-width">
          <button type="submit" class="submit-btn">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Additional Info Section -->
<section class="info-section">
  <div class="info-grid">
    <div class="info-card">
      <div class="emoji">🤝</div>
      <h3>Partnerships</h3>
      <p>Interested in partnering with Ulixai? We're always looking for innovative collaborations.</p>
    </div>
    <div class="info-card">
      <div class="emoji">💡</div>
      <h3>Suggestions</h3>
      <p>Have ideas to improve our platform? We love hearing from our community.</p>
    </div>
    <div class="info-card">
      <div class="emoji">🛡️</div>
      <h3>Support</h3>
      <p>Experiencing issues? Our support team is ready to assist you.</p>
    </div>
  </div>
</section>

@include('includes.footer')

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();
  // Form submission logic here
  alert('Thank you for your message! We will get back to you soon.');
});
</script>
{{-- Floating Bug Report Button --}}
@include('components.floating-bug-report')

</body>
</html>
