<?php
  session_start();
  include 'includes/conn.php'; // Ensure DB connection for login
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Trualliant</title>
  <base target="_top">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(to right, #0e1e40, rgb(59, 69, 88), #0e1e40);
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 0;
      background-image: 
        radial-gradient(white 0.8px, transparent 1px),
        radial-gradient(white 0.8px, transparent 1px),
        radial-gradient(white 0.8px, transparent 1px);
      background-size: 40px 40px, 80px 80px, 120px 120px;
      background-position: 0 0, 20px 40px, 60px 80px;
      animation: starDrift 160s linear infinite;
      opacity: 0.4;
    }

    @keyframes starDrift {
      0% {
        background-position: 0 0, 20px 40px, 60px 80px;
      }
      100% {
        background-position: 1000px 500px, 1020px 540px, 1060px 580px;
      }
    }

    .container {
      display: flex;
      width: 900px;
      max-width: 100%;
      border-radius: 10px;
      overflow: hidden;
      background-color: #fff;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .left-panel {
      flex: 1;
      background-color: #0e1e40;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .slideshow {
      position: relative;
      width: 90%;
      max-width: 350px;
      height: 350px;
      overflow: hidden;
      margin-bottom: 30px;
      border-radius: 8px;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .slide.active {
      opacity: 1;
    }

    .slider-controls {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
      padding: 0 10px;
    }

    .slider-controls span {
      background-color: rgba(255, 255, 255, 0.3);
      color: #fff;
      font-size: 24px;
      padding: 6px 12px;
      cursor: pointer;
      border-radius: 50%;
      transition: background-color 0.3s ease;
    }

    .slider-controls span:hover {
      background-color: rgba(255, 255, 255, 0.6);
    }

    .left-panel h3 {
      font-size: 20px;
      margin-top: 10px;
      text-align: center;
      max-width: 90%;
    }

    .right-panel {
      flex: 1;
      background-color: rgba(255, 255, 255, 0.95);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      position: relative;
    }

    .logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 20px;
    }

    .right-panel h1 {
      font-size: 28px;
      margin-bottom: 10px;
      color: #0e1e40;
    }

    .right-panel h2 {
      font-size: 16px;
      margin-bottom: 30px;
      font-weight: 300;
      color: #333;
    }

    form {
      width: 100%;
      max-width: 300px;
      display: none;
      flex-direction: column;
      align-items: stretch;
      opacity: 0;
      transform: scale(0.95);
    }

    form.active {
      display: flex;
    }

    .fade-in {
      animation: fadeInForm 0.3s forwards;
    }

    .fade-out {
      animation: fadeOut 0.3s forwards;
    }

    @keyframes fadeInForm {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeOut {
      from { opacity: 1; transform: scale(1); }
      to { opacity: 0; transform: scale(0.95); }
    }

    .input-field {
      margin-bottom: 20px;
    }

    .input-field input {
      width: 100%;
      padding: 12px;
      border: none;
      border-bottom: 1px solid #ccc;
      background: transparent;
      font-size: 14px;
      outline: none;
      color: #333;
    }

    .input-field input::placeholder {
      color: #999;
    }

    .forgot {
      font-size: 12px;
      text-align: right;
      color: #666;
      margin-bottom: 20px;
      cursor: pointer;
    }

    .signin-btn {
      background: #0e1e40;
      color: white;
      padding: 12px;
      border: none;
      font-size: 16px;
      border-radius: 50px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
      background-size: 200% auto;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
      margin-bottom: 10px;
    }

    .signin-btn:hover {
      background-image: linear-gradient(to left, #f36523, #0e1e40);
      background-position: right center;
      transform: translateY(-2px);
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
    }

    .external-links {
      text-align: center;
      margin-top: 15px;
    }

    .external-links a {
      margin: 0 10px;
      display: inline-block;
      transition: transform 0.3s ease;
    }

    .external-links a:hover img {
      transform: scale(1.2);
    }

    .social-icon {
      width: 28px;
      height: 28px;
      border-radius: 50%;
    }

    .error {
      color: #ff4d4d;
      text-align: center;
      margin-top: 10px;
    }

    #loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(236, 236, 236, 0.726);
      backdrop-filter: blur(2px);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    h5.follow-us {
      font-size: 14px;
      font-weight: normal;
      text-align: center;
      margin-top: 20px;
      color: #333;
    }

    /* 🌟 Star Trail Styles */
    #stars-container {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 10000;
    }

    .star {
      position: absolute;
      width: 16px;
      height: 16px;
      background: transparent;
      clip-path: polygon(
        50% 0%, 61% 35%, 98% 35%, 68% 57%,
        79% 91%, 50% 70%, 21% 91%, 32% 57%,
        2% 35%, 39% 35%
      );
      opacity: 1;
      animation: star-fade 0.8s ease-out forwards;
    }

    @keyframes star-fade {
      0% {
        opacity: 1;
        transform: scale(1.2);
      }
      100% {
        opacity: 0;
        transform: translateY(-30px) scale(0.3);
      }
    }

    /* Orbiting Orbs */
    .orbit-container {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 500;
    }

    .orb {
      position: absolute;
      width: 20px;
      height: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 50%;
      animation: orbit 8s linear infinite;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
    }

    .orbit-1 {
      top: 0;
      left: 0;
      animation-delay: 1s;
      animation-duration: 7s;
    }

    .orbit-2 {
      bottom: 0;
      left: 0;
      animation-delay: 1s;
      animation-duration: 7s;
    }

    .orbit-3 {
      top: 0;
      right: 0;
      animation-delay: 1s;
      animation-duration: 7s;
    }

    .orbit-4 {
      bottom: 0;
      right: 0;
      animation-delay: 1s;
      animation-duration: 7s;
    }

    @keyframes orbit {
      0%   { transform: translate(0, 0) rotate(0deg) translateX(60px) rotate(0deg); }
      100% { transform: translate(0, 0) rotate(360deg) translateX(60px) rotate(-360deg); }
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <div class="slideshow">
        <img class="slide active" src="images/Truallaint Recruitment.jpg" alt="Recruitment">
        <img class="slide" src="images/Trualliant Call Center Agents.jpg" alt="Call Center Agents">
        <img class="slide" src="images/Trualliant Campaign.jpg" alt="Opportunities">
        <div class="slider-controls">
          <span onclick="prevSlide()">&#10094;</span>
          <span onclick="nextSlide()">&#10095;</span>
        </div>
      </div>
      <h3>Empowering careers through meaningful connections and opportunity.</h3>
    </div>

    <div class="right-panel">
      <img src="images/logo.jpg" alt="Trualliant Logo" class="logo">
      <h1>Trualliant</h1>
      <h2>Please sign in to continue</h2>

      <form id="login-form" class="active fade-in" action="login.php" method="POST">
        <div class="input-field">
          <input type="text" id="username" name="username" placeholder="Username or Email" required>
        </div>
        <div class="input-field">
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="forgot" onclick="switchForm('forgot-form')">Forgot password?</div>
        <button class="signin-btn" type="submit" name="login">Sign in</button>

        <h5 class="follow-us">Follow us on Socials</h5>
        <div class="external-links">
          <a href="https://www.facebook.com/TrualliantInc" target="_blank" title="Facebook">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/2048px-2021_Facebook_icon.svg.png" alt="Facebook" class="social-icon">
          </a>
          <a href="https://trualliant.com/" target="_blank" title="Trualliant Website">
            <img src="images/logo.jpg" alt="Website" class="social-icon">
          </a>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
          <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
      </form>

      <form id="forgot-form">
        <div class="input-field">
          <input type="email" placeholder="Enter your email" required>
        </div>
        <button class="signin-btn" type="submit">Reset Password</button>
        <button class="signin-btn" type="button" onclick="switchForm('login-form')">Back</button>
      </form>

      <div id="loading-overlay">
        <img src="images/Trualliant.gif" alt="Loading..." style="width: 220px; height: 220px;">
      </div>
    </div>
  </div>

  <div id="stars-container"></div>

  <!-- Orbiting Elements -->
<div class="orbit-container">
  <div class="orb orbit-1"></div>
  <div class="orb orbit-2"></div>
  <div class="orb orbit-3"></div>
  <div class="orb orbit-4"></div>
</div>


  <script>
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    setInterval(() => nextSlide(), 3000);

    function showSlide(index) {
      slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    function switchForm(formId) {
      document.querySelectorAll('form').forEach(f => {
        f.classList.remove('fade-in');
        f.classList.add('fade-out');
        setTimeout(() => {
          f.classList.remove('active', 'fade-out');
          if (f.id === formId) {
            f.classList.add('active', 'fade-in');
          }
        }, 300);
      });
    }

    document.getElementById('login-form').addEventListener('submit', function (e) {
      e.preventDefault();
      document.getElementById('loading-overlay').style.display = 'flex';
      setTimeout(() => this.submit(), 2000);
    });

    // Star trail effect
    const starColors = ['#f7c843', '#ff4d6d', '#76e3ff', '#8eff6c', '#ffd700', '#ff66ff'];
    const starsContainer = document.getElementById('stars-container');

    function createStar(x, y) {
      const star = document.createElement('div');
      star.className = 'star';
      star.style.left = `${x}px`;
      star.style.top = `${y}px`;
      star.style.backgroundColor = starColors[Math.floor(Math.random() * starColors.length)];
      starsContainer.appendChild(star);
      setTimeout(() => star.remove(), 800);
    }

    document.addEventListener('mousemove', e => createStar(e.clientX, e.clientY));
    document.addEventListener('scroll', () => {
      const x = window.innerWidth / 2;
      const y = window.scrollY + window.innerHeight / 2;
      createStar(x + Math.random() * 80 - 40, y + Math.random() * 80 - 40);
    });

    window.addEventListener("pageshow", function (event) {
      if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        window.location.reload();
      }
    });
  </script>
</body>
</html>
