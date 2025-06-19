<!-- HEADER WITH ANIMATED STARFIELD -->
<header class="navbar navbar-expand-lg navbar-dark px-3 position-relative d-flex justify-content-between align-items-center"
        style="height: 70px; background: linear-gradient(to right, #0e1e40, rgb(59, 69, 88), #0e1e40); font-family: 'Poppins', sans-serif;">

  <!-- Starfield Background Layer -->
  <div class="starfield"></div>

  <!-- Brand -->
  <a href="dashboard.php" class="navbar-brand d-flex align-items-center position-relative" style="z-index: 2;">
    <img src="images/logo.jpg" alt="Logo"
         style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
    <span class="fw-bold ms-2" style="font-size: 1.2rem;">
      <span style="color: white;">TRU</span><span style="color: #f36523;">ALLIANT</span>
    </span>
  </a>

  <!-- Sidebar Toggle (Mobile) -->
  <button class="btn btn-primary me-2 d-lg-none position-relative" type="button"
          data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" style="z-index: 2;">
    <i class="fas fa-bars"></i>
  </button>

  <!-- User Dropdown -->
  <div class="dropdown position-relative" style="z-index: 2;">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
       id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="images/profile.jpg" alt="User" class="rounded-circle me-2" width="32" height="32">
      <strong><?php echo htmlspecialchars($user['name']); ?></strong>
    </a>

    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="userDropdown" style="z-index: 9999;">
      <li class="px-3 py-2 text-center">
        <img src="images/profile.jpg" alt="User" class="rounded-circle mb-2" width="60" height="60">
        <p class="mb-0"><?php echo htmlspecialchars($user['username']); ?></p>
        <small class="fw-bold" style="color: #0e1e40;"><?php echo htmlspecialchars($user['email']); ?></small>
      </li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#profile">Update</a></li>
      <li><a class="dropdown-item text-danger fw-bold" href="logout.php">Sign out</a></li>
    </ul>
  </div>
</header>

<!-- STARFIELD BACKGROUND STYLE -->
<style>
  .starfield {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    pointer-events: none;
    opacity: 0.2;
    background-image:
      radial-gradient(white 0.5px, transparent 1px),
      radial-gradient(white 0.5px, transparent 1px),
      radial-gradient(white 0.5px, transparent 1px);
    background-size: 50px 50px, 100px 100px, 150px 150px;
    background-position: 0 0, 50px 25px, 75px 75px;
    background-repeat: repeat;
    animation: starsMove 120s linear infinite;
  }

  @keyframes starsMove {
    0% {
      background-position: 0 0, 50px 25px, 75px 75px;
    }
    100% {
      background-position: 1000px 500px, 1050px 525px, 1100px 550px;
    }
  }
</style>

<!-- PROFILE MODAL -->
<?php include 'profile_modal.php'; ?>
