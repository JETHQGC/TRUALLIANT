<?php
  session_start();
  include 'includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Trualliant</title>
  <base target="_top">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">

  <style>
    /* Starry Background */
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
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

    /* Hover Stars */
    .star {
      position: absolute;
      width: 13px;
      height: 13px;
      pointer-events: none;
      z-index: 9999;
      animation: sparkle 1s ease-out forwards;
      clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 100%, 50% 75%, 21% 100%, 32% 57%, 2% 35%, 39% 35%);
      box-shadow: 0 0 20px 6px white;
    }

    @keyframes sparkle {
      0% { transform: scale(1) translateY(0); opacity: 1; }
      100% { transform: scale(2.5) translateY(-80px); opacity: 0; }
    }

    /* Orbiting Corners */
    .corner-orbit {
      position: absolute;
      width: 0;
      height: 0;
      overflow: visible;
      pointer-events: none;
    }

    .corner-orbit::before {
      content: '';
      position: absolute;
      width: 12px;
      height: 12px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      box-shadow: 0 0 10px 3px rgba(255, 255, 255, 0.7);
    }

    .top-left    { top: 0; left: 0; }
    .top-right   { top: 0; right: 0; }
    .bottom-left { bottom: 0; left: 0; }
    .bottom-right{ bottom: 0; right: 0; }

    .top-left::before {
      animation: orbit-top-left 5s linear infinite;
    }
    .top-right::before {
      animation: orbit-top-right 5s linear infinite;
    }
    .bottom-left::before {
      animation: orbit-bottom-left 5s linear infinite;
    }
    .bottom-right::before {
      animation: orbit-bottom-right 5s linear infinite;
    }

    @keyframes orbit-top-left {
      0% { transform: rotate(0deg) translate(0, -40px); }
      100% { transform: rotate(360deg) translate(0, -40px); }
    }

    @keyframes orbit-top-right {
      0% { transform: rotate(0deg) translate(40px, 0); }
      100% { transform: rotate(360deg) translate(40px, 0); }
    }

    @keyframes orbit-bottom-left {
      0% { transform: rotate(0deg) translate(0, 40px); }
      100% { transform: rotate(360deg) translate(0, 40px); }
    }

    @keyframes orbit-bottom-right {
      0% { transform: rotate(0deg) translate(-40px, 0); }
      100% { transform: rotate(360deg) translate(-40px, 0); }
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

    <div class="right-panel" style="position: relative;">
      <!-- Orbiting elements -->
      <div class="corner-orbit top-left"></div>
      <div class="corner-orbit top-right"></div>
      <div class="corner-orbit bottom-left"></div>
      <div class="corner-orbit bottom-right"></div>

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

      <form id="forgot-form" style="display: none;">
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

  <script>
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    setInterval(() => nextSlide(), 3000);

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    function switchForm(id) {
      document.getElementById('login-form').style.display = id === 'login-form' ? 'block' : 'none';
      document.getElementById('forgot-form').style.display = id === 'forgot-form' ? 'block' : 'none';
    }

    document.getElementById('login-form').addEventListener('submit', function (e) {
      e.preventDefault();
      document.getElementById('loading-overlay').style.display = 'flex';
      setTimeout(() => this.submit(), 2000);
    });

    // Star effect on mousemove
    document.addEventListener('mousemove', function(e) {
      if (window.lastStarTime && Date.now() - window.lastStarTime < 100) return;
      window.lastStarTime = Date.now();

      const star = document.createElement('div');
      star.classList.add('star');
      const hue = Math.floor(Math.random() * 360);
      const color = `hsl(${hue}, 100%, 70%)`;
      star.style.backgroundColor = color;
      star.style.boxShadow = `0 0 20px 6px ${color}`;
      star.style.left = `${e.clientX - 25}px`;
      star.style.top = `${e.clientY - 25}px`;
      document.body.appendChild(star);
      setTimeout(() => star.remove(), 1000);
    });

    window.addEventListener("pageshow", function (event) {
      if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        window.location.reload();
      }
    });
  </script>
</body>
</html>
