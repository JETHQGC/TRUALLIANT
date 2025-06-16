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
<link rel="stylesheet" href="css/login.css">

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

  // Intercept real form submission
  document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Stop immediate form submit
    document.getElementById('loading-overlay').style.display = 'flex';

    setTimeout(() => {
      this.submit(); // Submit after 2 seconds
    }, 2000);
  });

  window.addEventListener("pageshow", function (event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
      window.location.reload();
    }
  });
</script>


</body>
</html>

