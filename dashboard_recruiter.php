<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/scripts.php'; ?>




<!-- Global Loader -->
<div id="globalLoader" class="global-loader">
  <div class="loader-content text-center">
    <img src="images/Trualliant.gif" alt="Loading..." style="width: 200px;">
  </div>
</div>

<!-- Offcanvas Sidebar (Mobile) -->
<div class="offcanvas offcanvas-start d-lg-none bg-light" tabindex="-1" id="mobileSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <?php include 'includes/menubar.php'; ?>
  </div>
</div>
 
<!-- Page Wrapper -->
<div class="d-flex flex-column min-vh-100">
  <div class="container-fluid flex-grow-1 d-flex flex-column">
    <div class="row flex-grow-1">
      <!-- Static Sidebar -->
      <div class="col-lg-2 d-none d-lg-block bg-light p-0 flex-shrink-0" style="height: 100vh;">
        <?php include 'includes/menubar.php'; ?>
      </div>

      <!-- Main Content -->
      <div class="col-lg-10 d-flex flex-column pt-0 pe-0 pb-0 ps-0">
        <div class="flex-grow-1 overflow-auto">

          <!-- Breadcrumb -->
          <section class="py-3 px-3 mb-3 border-bottom shadow-sm bg-light">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
              <h4 class="mb-0" style="color: #0e1e40; font-weight: 700;">Dashboard</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent">
                  <li class="breadcrumb-item">
                    <a href="dashboard.php" style="text-decoration: none; color: #f36523; font-weight: bold; display: flex; align-items: center; gap: 6px;">
                      <i class="fa fa-home" style="color: #f36523;"></i> Home
                    </a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page" style="color: #0e1e40; font-weight: 600;">Dashboard</li>
                </ol>
              </nav>
            </div>
          </section>

          <?php
          $name = isset($user['name']) ? $user['name'] : '';

      $mypendinginterview = $conn->query("SELECT COUNT(*) AS count FROM source WHERE recruiter = '$name' AND NOT EXISTS (SELECT 1 FROM initial_interview WHERE initial_interview.source_id = source.source_id)")->fetch_assoc()['count'];
$mypendingassessment = $conn->query("
  SELECT COUNT(*) AS count 
  FROM source s
  INNER JOIN initial_interview i ON s.source_id = i.source_id
  WHERE s.recruiter = '$name'
    AND i.initial_interview = 'Passed'
    AND NOT EXISTS (
      SELECT 1 
      FROM assessment a 
      WHERE a.source_id = s.source_id
    )
")->fetch_assoc()['count'];

      $pendingorientation = $conn->query("
  SELECT COUNT(*) AS count 
  FROM source s
  INNER JOIN assessment a ON s.source_id = a.source_id
  WHERE a.assessment_status = 'Passed'
    AND NOT EXISTS (
      SELECT 1 
      FROM orientation o 
      WHERE o.source_id = s.source_id
    )
")->fetch_assoc()['count'];

          $kpiCards = [
            ['title' => 'Pending Interview', 'count' => number_format($mypendinginterview), 'icon' => 'fas fa-database'],
            ['title' => 'Pending Assessment', 'count' => number_format($mypendingassessment), 'icon' => 'fas fa-user-check'],
             ['title' => 'Orientation Not Scheduled', 'count' => number_format($pendingorientation), 'icon' => 'fas fa-user-check']
           
          ];

          $recent = $conn->query("
            SELECT s.source_id, s.source_date, p.name, p.birthdate, s.status, i.initial_interview, a.assessment_status, o.orientation_status, e.signed_contract, t.trainee_status
            FROM source s
            LEFT JOIN personal_info p ON s.source_id = p.source_id
            LEFT JOIN initial_interview i ON s.source_id = i.source_id
            LEFT JOIN assessment a ON s.source_id = a.source_id
            LEFT JOIN orientation o ON s.source_id = o.source_id
            LEFT JOIN endorsement e ON s.source_id = e.source_id
            LEFT JOIN training t ON e.endorsement_id = t.endorsement_id
            ORDER BY s.source_id DESC
          ");
          ?>

          <!-- KPI Cards -->
          <div class="kpi-flex-container">
            <?php foreach ($kpiCards as $card): ?>
              <div class="kpi-card">
                <div class="kpi-text">
                  <h6><?= htmlspecialchars($card['title']) ?></h6>
                  <h4><?= htmlspecialchars($card['count']) ?></h4>
                </div>
                <div class="kpi-icon">
                  <i class="fa <?= $card['icon'] ?>"></i>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Recent Applicants Table -->
          <div class="card mt-3 mx-3 my-3" style="border-top: 4px solid #0e1e40;">
            <div class="card-header bg-white border-bottom">
              <span class="fw-semibold" style="color: #0e1e40;">Application History</span>
            </div>

          <div class="card-body">
  <div class="table-responsive">
   <table id="mergedTable" class="table table-hover align-left text-nowrap shadow-sm rounded-3 mb-0" style="width:100%; border-collapse: separate; border-spacing: 0;">

    <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Source Date</th>
          <th>Name</th>
          <th>Birthdate</th>
          <th>Status</th>
          <th>Interview</th>
          <th>Assessment</th>
          <th>Orientation</th>
          <th>Signed Contract</th>
          <th>Training</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $recent->fetch_assoc()): ?>
          <?php
            $status = strtoupper($row['status'] ?? 'Unknown');
            $badgeColor = '';
            $icon = '';

            if ($status === 'NEW') {
              $badgeColor = 'background-color:rgb(218, 228, 220); color: #155724; border-radius: 10px;';
              $icon = 'fa-check-circle';
            } elseif ($status === 'PREVIOUS TA EMPLOYEE NOT FOR REHIRE') {
              $badgeColor = 'background-color: #f8d7da; color: #721c24; border-radius: 10px;';
              $icon = 'fa-times-circle';
            } else {
              $badgeColor = 'background-color: #e2e3e5; color:rgb(71, 118, 156); border-radius: 10px;';
              $icon = 'fa-question-circle';
            }
          ?>
          <tr>
            <td><?= htmlspecialchars($row['source_id'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['source_date'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($row['name'] ?? 'N/A') ?></td>
            <td><?= !empty($row['birthdate']) ? date('M d, Y', strtotime($row['birthdate'])) : '—' ?></td>
            <td>
              <span class="badge px-3 py-2 d-inline-block" style="<?= $badgeColor ?>">
                <i class="fa <?= $icon ?>"></i> <?= htmlspecialchars($status) ?>
              </span>
            </td>
            <td><?= htmlspecialchars($row['initial_interview'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['assessment_status'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['orientation_status'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['signed_contract'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['trainee_status'] ?? '—') ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

          </div>
        </div>

        <!-- Footer -->
        <footer class="bg-light border-top text-center py-0 flex-shrink-0">
          <?php include 'includes/footer.php'; ?>
        </footer>
      </div>
    </div>
  </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('globalLoader');
    if (loader) {
      setTimeout(() => {
        loader.classList.add('hidden');
        loader.style.display = 'none';
      }, 100);
    }

 
const table = $('#mergedTable').DataTable({
  deferRender: true,
  paging: true,
  info: true,
  fixedHeader: true,
  lengthChange: false,
  pageLength: 5,
  order: [[0, 'desc']], // 👈 Sort first column (index 0) descending
  language: {
    search: "_INPUT_",
    searchPlaceholder: "Search records...",
    lengthMenu: "Show _MENU_ entries",
  },
  columnDefs: [
    { orderable: false, targets: -1 }  // disable sorting on the checkbox column
  ],
  dom:
    "<'datatable-controls d-flex flex-wrap justify-content-between align-items-center mb-2'<'datatable-length'l><'datatable-search'f>>" +
    "<'datatable-wrapper table-responsive't>" +
    "<'datatable-footer d-flex justify-content-between align-items-center mt-2'<'datatable-info'i><'datatable-paging'p>>",
  initComplete: function () {
    const loader = document.getElementById('globalLoader');
    if (loader) {
      loader.classList.add('hidden');
      setTimeout(() => loader.style.display = 'none', 300);
    }
  }
});
  });

  window.addEventListener("pageshow", function (event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
      window.location.reload();
    }
  });
</script>
