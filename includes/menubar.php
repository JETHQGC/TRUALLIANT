<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
  $username = isset($user['username']) ? strtolower($user['username']) : '';
  $name = isset($user['name']) ? strtolower($user['name']) : '';

  $isSourceUser = strpos($username, 'source') === 0;
  $isRecruitmentUser = strpos($username, 'recruiter') === 0;
  $isTrainerUser = strpos($username, 'trainer') === 0;
  $isAdminUser = strpos($username, 'admin') === 0;

  // Set dashboard file based on user role
  if ($isSourceUser) {
    $dashboardPage = 'dashboard_source.php';
  } elseif ($isRecruitmentUser) {
    $dashboardPage = 'dashboard_recruiter.php';
  } elseif ($isTrainerUser) {
    $dashboardPage = 'dashboard_trainer.php';
  } elseif ($isAdminUser) {
    $dashboardPage = 'dashboard_admin.php';
  } else {
    $dashboardPage = 'dashboard.php'; // fallback
  }

  $recruitmentPages = ['source.php', 'interview.php', 'assessment.php', 'orientation.php', 'endorsement.php'];
  $isRecActive = in_array($currentPage, $recruitmentPages);
?>

<!-- Orbit CSS -->
<style>
.profile-orbit {
  position: relative;
  width: 60px;
  height: 60px;
}
.profile-orbit img {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border: 2px solid #fff;
  object-fit: cover;
  box-shadow: 0 0 10px rgba(255,255,255,0.3);
}
.orbit-container {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 60px;
  height: 60px;
  transform: translate(-50%, -50%);
  animation: rotateOrbit 8s linear infinite;
  z-index: 1;
}
.orbit-dot {
  width: 10px;
  height: 10px;
  background: white;
  border-radius: 50%;
  position: absolute;
  top: 0;
  left: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 10px 2px rgba(255,255,255,0.6);
}
@keyframes rotateOrbit {
  from { transform: translate(-50%, -50%) rotate(0deg); }
  to   { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>

<div class="position-sticky pt-3">
  <!-- USER PROFILE -->
  <div class="d-flex align-items-center px-3 py-3 border-bottom">
    <div class="profile-orbit me-3">
      <img src="images/profile.jpg" alt="User Image">
      <div class="orbit-container">
        <div class="orbit-dot"></div>
      </div>
    </div>
    <div>
      <div class="fw-semibold mb-1" style="font-size:14px;"><?php echo htmlspecialchars($name); ?></div>
      <div class="d-flex align-items-center text-success gap-1" style="font-size:13px;">
        <span class="d-inline-block rounded-circle bg-success" style="width:10px;height:10px;"></span>
        <?php echo htmlspecialchars($username); ?>
      </div>
    </div>
  </div>

  <!-- MAIN NAVIGATION -->
  <ul class="nav flex-column mt-3">
    <!-- Dynamic Dashboard Tab -->
    <li class="nav-item">
      <a href="<?php echo $dashboardPage; ?>"
         class="nav-link d-flex align-items-center gap-2 rounded-0 <?php echo $currentPage === $dashboardPage ? 'nav-gradient text-white fw-semibold' : ''; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>

    <!-- Recruitment Menu -->
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2 rounded-0 <?php echo $isRecActive ? 'nav-gradient text-white fw-semibold' : ''; ?>"
         data-bs-toggle="collapse" href="#recruitmentSubmenu"
         aria-expanded="<?php echo $isRecActive ? 'true' : 'false'; ?>"
         aria-controls="recruitmentSubmenu">
        <i class="fa fa-users" style="width:20px;"></i>
        <span class="flex-grow-1">Recruitment</span>
        <i class="fa fa-angle-down"></i>
      </a>
      <div class="collapse <?php echo $isRecActive ? 'show' : ''; ?>" id="recruitmentSubmenu">
        <ul class="nav flex-column ps-3">
          <?php
          $subPages = [
            'source.php' => $isSourceUser,
            'interview.php' => $isRecruitmentUser,
            'assessment.php' => $isRecruitmentUser,
            'orientation.php' => $isRecruitmentUser,
            'endorsement.php' => $isRecruitmentUser
          ];
          foreach ($subPages as $page => $hasAccess) {
            $isActive = $currentPage === $page;
            $label = ucfirst(basename($page, '.php'));
            echo '<li class="nav-item">
                    <a href="'.$page.'" class="nav-link d-flex align-items-center gap-2 rounded-0 '.
                    ($isActive ? 'text-primary fw-semibold' : '').' '.(!$hasAccess ? 'disabled' : '').'">
                      <i class="'.($isActive ? 'fas' : 'far').' fa-circle" style="width:20px;"></i> '.$label.'
                    </a>
                  </li>';
          }
          ?>
        </ul>
      </div>
    </li>

    <!-- Training -->
    <li class="nav-item">
      <a href="training.php"
         class="nav-link d-flex align-items-center gap-2 rounded-0
           <?php echo $currentPage === 'training.php' ? 'nav-gradient text-white fw-semibold' : ''; ?>
           <?php echo !$isTrainerUser ? 'disabled' : ''; ?>">
        <i class="fa fa-chalkboard-teacher"></i> Training
      </a>
    </li>

    <!-- Deployment -->
    <li class="nav-item">
      <a href="deployment.php"
         class="nav-link d-flex align-items-center gap-2 rounded-0
           <?php echo $currentPage === 'deployment.php' ? 'nav-gradient text-white fw-semibold' : ''; ?>
           <?php echo !$isTrainerUser ? 'disabled' : ''; ?>">
        <i class="fa fa-chalkboard-teacher"></i> Deployment
      </a>
    </li>
  </ul>
</div>
