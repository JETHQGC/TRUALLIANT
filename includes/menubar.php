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
  } 
  else {
    $dashboardPage = 'dashboard.php'; // fallback
  }

  $recruitmentPages = ['source.php', 'interview.php', 'assessment.php', 'orientation.php', 'endorsement.php'];
  $isRecActive = in_array($currentPage, $recruitmentPages);
?>
<div class="position-sticky pt-3">
  <!-- USER PROFILE -->
  <div class="d-flex align-items-center px-3 py-3 border-bottom">
  <img src="images/profile.jpg" alt="User Image" class="rounded-circle me-3" width="45" height="45">
  <div>
    <!-- Display the name instead of username -->
    <div class="fw-semibold mb-1" style="font-size:14px;"><?php echo htmlspecialchars($name); ?></div>

    <!-- Show "Online" status with username -->
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

          <!-- SOURCE -->
          <li class="nav-item">
            <a href="source.php"
               class="nav-link d-flex align-items-center gap-2 rounded-0
                 <?php echo $currentPage === 'source.php' ? 'text-primary fw-semibold' : ''; ?>
                 <?php echo !$isSourceUser ? 'disabled' : ''; ?>">
              <i class="<?php echo $currentPage === 'source.php' ? 'fas' : 'far'; ?> fa-circle" style="width:20px;"></i>
              Source
            </a>
          </li>

          <!-- INTERVIEW -->
          <li class="nav-item">
            <a href="interview.php"
               class="nav-link d-flex align-items-center gap-2 rounded-0
                 <?php echo $currentPage === 'interview.php' ? 'text-primary fw-semibold' : ''; ?>
                 <?php echo !$isRecruitmentUser ? 'disabled' : ''; ?>">
              <i class="<?php echo $currentPage === 'interview.php' ? 'fas' : 'far'; ?> fa-circle" style="width:20px;"></i>
              Interview
            </a>
          </li>

          <!-- ASSESSMENT -->
          <li class="nav-item">
            <a href="assessment.php"
               class="nav-link d-flex align-items-center gap-2 rounded-0
                 <?php echo $currentPage === 'assessment.php' ? 'text-primary fw-semibold' : ''; ?>
                 <?php echo !$isRecruitmentUser ? 'disabled' : ''; ?>">
              <i class="<?php echo $currentPage === 'assessment.php' ? 'fas' : 'far'; ?> fa-circle" style="width:20px;"></i>
              Assessment
            </a>
          </li>

          <!-- ORIENTATION -->
          <li class="nav-item">
            <a href="orientation.php"
               class="nav-link d-flex align-items-center gap-2 rounded-0
                 <?php echo $currentPage === 'orientation.php' ? 'text-primary fw-semibold' : ''; ?>
                 <?php echo !$isRecruitmentUser ? 'disabled' : ''; ?>">
              <i class="<?php echo $currentPage === 'orientation.php' ? 'fas' : 'far'; ?> fa-circle" style="width:20px;"></i>
              Orientation
            </a>
          </li>

          <!-- ENDORSEMENT -->
          <li class="nav-item">
            <a href="endorsement.php"
               class="nav-link d-flex align-items-center gap-2 rounded-0
                 <?php echo $currentPage === 'endorsement.php' ? 'text-primary fw-semibold' : ''; ?>
                 <?php echo !$isRecruitmentUser ? 'disabled' : ''; ?>">
              <i class="<?php echo $currentPage === 'endorsement.php' ? 'fas' : 'far'; ?> fa-circle" style="width:20px;"></i>
              Endorsement
            </a>
          </li>
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
