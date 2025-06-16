
<header class="navbar navbar-expand-lg navbar-dark px-3"
  style="background: linear-gradient(90deg, #0e1e40, #a13c6c, #f36523);">
  <a href="dashboard.php" class="navbar-brand d-flex align-items-center">
    <!-- Circular logo -->
    <img src="images/logo.jpg" alt="Logo" class="me-2" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
    <!-- Split colored brand name -->
    <span class="fw-bold glow-text">
      <span style="color: white;">TRU</span><span style="color: #f36523;">ALLIANT</span>
    </span>
  </a>


  <!-- Sidebar toggle button (triggers offcanvas) -->
  <button class="btn btn-primary me-2 d-lg-none" type="button"
          data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Navbar content -->
  <div class="ms-auto dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decorsation-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="images/profile.jpg" alt="User Image" class="rounded-circle me-2" width="32" height="32">
      <strong><?php echo htmlspecialchars($user['name']); ?></strong>
    </a>
<ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="userDropdown">
  <li class="px-3 py-2 text-center">
    <img src="images/profile.jpg" alt="User Image" class="rounded-circle mb-2" width="60" height="60">
    <p class="mb-0"><?php echo htmlspecialchars($user['username']); ?></p>
    <small style="font-weight: 700; color: #0e1e40;"><?php echo htmlspecialchars($user['email']); ?></small>
  </li>
  <li><hr class="dropdown-divider"></li>
  <a class="dropdown-item fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#profile">Update</a>
  <li><a class="dropdown-item text-danger fw-bold" href="logout.php">Sign out</a></li>
</ul>

  </div>
</header>

<?php include 'profile_modal.php'; ?>
