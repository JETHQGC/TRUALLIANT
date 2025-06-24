<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/scripts.php'; ?>




<div id="globalLoader" class="global-loader">
  <div class="loader-content text-center">
    <img src="images/Trualliant.gif" alt="Loading..." style="width: 200px;">

  </div>
</div>


<!-- Offcanvas Sidebar (mobile only) -->
<div class="offcanvas offcanvas-start d-lg-none bg-light" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileSidebarLabel">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <?php include 'includes/menubar.php'; ?>
  </div>
</div>
<!-- Offcanvas Sidebar (mobile only) -->


<!-- Page Wrapper -->
<div class="d-flex flex-column min-vh-100">
  <div class="container-fluid flex-grow-1 d-flex flex-column">

    <div class="row flex-grow-1">


    <!-- Static Sidebar (desktop only) -->
 <div class="col-lg-2 d-none d-lg-block bg-light p-0 flex-shrink-0">

      <?php include 'includes/menubar.php'; ?>
    </div>
  <!-- Static Sidebar (desktop only) -->

    <!-- Main Content -->
   <div class="col-lg-10 d-flex flex-column pt-0 pe-0 pb-0 ps-0">
 <div class="flex-grow-1 overflow-auto">

   <section class="py-3 px-3 mb-3 border-bottom shadow-sm bg-light">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <h4 class="mb-0" style="color: #0e1e40; font-weight: 700;">Deployment</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
             <li class="breadcrumb-item">
              <a href="dashboard.php" style="text-decoration: none; color: #f36523; font-weight: bold; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-home" style="color: #f36523;"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #0e1e40; font-weight: 600;">Deployment</li>
            </ol>
          </nav>
        </div>
      </section>



<section class="content container-fluid">
  <div id="alertContainer">
    <?php if (isset($_SESSION['error'])): ?> 
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-warning me-2"></i><strong>Error:</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check me-2"></i><strong>Success:</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
  </div>
</section>



<?php
// assumes session.php has set $user['name'], but we no longer filter by recruiter here

$sql = "
  SELECT 
    e.*,
    c.campaign,
    c.cluster,
    c.assigned_date,
    c.recommendation,
    c.removal_reason
  FROM employee e
  LEFT JOIN campaign c ON c.employee_id = e.id
  AND c.assigned_date = (
    SELECT MAX(c2.assigned_date)
    FROM campaign c2
    WHERE c2.employee_id = e.id
  )
  ORDER BY e.id DESC
";




$stmt = $conn->prepare($sql);
// no bind_param needed any more
$stmt->execute();
$result = $stmt->get_result();

$rows = [];
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

$stmt->close();
?>






<?php
// Source badge color mapping
$sourceColorMap = [
  'Facebook' => 'badge-color-1',
  'Referral' => 'badge-color-2',
  'School Partnership' => 'badge-color-3',
  'PESO' => 'badge-color-4',
  'NISU' => 'badge-color-5',
  'Job Fair' => 'badge-color-6',
  'DOLE REFERRAL' => 'badge-color-7',
  'Facebook Organic' => 'badge-color-8',
  'B Facebook' => 'badge-color-9',
  'NA' => 'badge-color-10'
];

// Status badge color mapping
$statusColorMap = [
  // Statuses to retain
  'Email Sent' => 'badge-color-11',
  'Pending' => 'badge-color-12',

  // Termination Reasons
  'New' => 'badge-color-13',
  'Active' => 'badge-color-14',
  'Terminated' => 'badge-color-15',
  'Resigned' => 'badge-color-16',
  'RTWO' => 'badge-color-17',
  'AWOL' => 'badge-color-18',

  // Training Assignments
  'Training - ADP' => 'badge-color-19',

  // Nesting Assignments
  'AQ - Nesting' => 'badge-color-20',
  'Call Trader - Nesting' => 'badge-color-21',
  'GENX - Nesting' => 'badge-color-22',
  'WGL - Nesting' => 'badge-color-23',
  'Jade ACA Nesting' => 'badge-color-24',
  'ECX GH - Nesting' => 'badge-color-25',
  'ECX GHE - Nesting' => 'badge-color-26',
  'ECX LM - Nesting' => 'badge-color-27',
  'Assurity - Nesting' => 'badge-color-28',
  'Konnect Leads - Nesting' => 'badge-color-29',

  // Premium Programs
  'Endorsed to Deployment' => 'badge-color-30',
  'Passed' => 'badge-color-31',
  'Premium - Zinnia Health Intake' => 'badge-color-32',
  'Premium - Ramzey CS' => 'badge-color-33',
  'Premium - Simpson' => 'badge-color-34',
  'Premium - We Level Up' => 'badge-color-35',
  'Premium - Dan Fulfillment' => 'badge-color-36',
  'Premium - Ryan Simpson Financial' => 'badge-color-37',

  // Endorsements and Other Statuses
  "Women's Society-Premium" => 'badge-color-38',
  'Deployment Pool - T4' => 'badge-color-39',
  'Deployment Pool - VSS' => 'badge-color-40',
  'Endorsed - Support' => 'badge-color-41',
  'Zeta PHARMA' => 'badge-color-42',
];



// Utility function to get the badge class
function getFixedColorClass($value, $map) {
  return isset($map[$value]) ? $map[$value] : 'badge-color-default';
}
?>







<section>
          <div class="card mt-3 mx-3 my-3" style="border-top: 4px solid #0e1e40;">

   <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <span class="fw-semibold" style="color: #0e1e40;">Records</span>
          <!-- Start: + New Button with Inline Hover Effect -->
<button class="btn btn-sm fw-bold"
  style="color: #0e1e40; border: 1px solid #0e1e40; background-color: #ffffff; border-radius: 8px;"
  data-bs-toggle="modal"
  data-bs-target="#addCampaignModal"
  onmouseover="this.style.backgroundColor='#0e1e40'; this.style.color='white';"
  onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#0e1e40';">
  -> Transfer Employee
</button>
<!-- End: + New Button with Inline Hover Effect -->
            </div>
        





            <div class="card-body">
              
                 <div class="datatable-wrapper">
                  
  <table id="mergedTable" class="table table-hover align-left text-nowrap shadow-sm rounded-3 mb-0" style="width:100%; border-collapse: separate; border-spacing: 0;">

    <thead class="table-light">
      
      <tr>
        <th>No.</th>
        <th>Emp ID</th>
        <th>Name</th>
        <th>TIN</th>
        <th>SSS</th>
        <th>PHIC</th>
        <th>HDMF</th>
        <th>Date Hired</th>
        <th>Position</th>
        <th>Campaign</th>
         <th>Department</th>
        <th>Employment Status</th>
        <th>Action</th>
       
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['emp_id'] ?></td>
          <td><?= htmlspecialchars($row['employee_name'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($row['tin'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($row['sss'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($row['phic'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($row['pag_ibig'], ENT_QUOTES) ?></td>
          <td><?= $row['date_hired'] ?></td>
          <td><?= htmlspecialchars($row['position'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($row['campaign'], ENT_QUOTES) ?></td>
          <td><?= htmlspecialchars($row['cluster'], ENT_QUOTES) ?></td>
          
             <td> <span class="badge <?= getFixedColorClass(!empty($row['emp_status']) ? $row['emp_status'] : 'Pending', $statusColorMap) ?>">
    <?= strtoupper(!empty($row['emp_status']) ? $row['emp_status'] : 'Pending') ?>
  </span></td>
          
         <td>
  <div class="d-flex gap-1">
    <!-- Edit Button -->
    <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
      data-id="<?= $row['id'] ?>">
      <i class="fa fa-edit"></i>
    </button>

    <!-- History Button -->
    <button class="btn btn-sm historyBtn" style="background-color: #ff5722; color: #ffffff;"
      data-id="<?= $row['id'] ?>" title="View History">
      <i class="fa fa-clock-rotate-left"></i>
    </button>
  </div>
</td>


        </tr>

      <?php endforeach; ?>
    </tbody>
  </table>
</div>













            </div>
          </div>
        </section>

</div>

        <footer class="bg-light border-top text-center py-0 flex-shrink-0">
        <?php include 'includes/footer.php'; ?>
      </footer>

<!-- Edit Modal -->
  <?php include 'includes/edit_deployment_modal.php'; ?>
ard_modal.php'; ?>
  
<?php include 'includes/add_campaign_modal.php'; ?>
  <?php include 'includes/history_modal.php'; ?>

  











<script>



const sourceColorMap = {
  'Facebook': 'badge-color-1',
  'Referral': 'badge-color-2',
  'School Partnership': 'badge-color-3',
  'PESO': 'badge-color-4',
  'NISU': 'badge-color-5',
  'Job Fair': 'badge-color-6',
  'DOLE REFERRAL': 'badge-color-7',
  'Facebook Organic': 'badge-color-8',
  'B Facebook': 'badge-color-9',
  'NA': 'badge-color-10'
};

const statusColorMap = {
  // Statuses to retain
  "Email Sent": "badge-color-11",
  "Pending": "badge-color-12",

  // Termination Reasons


    // Termination Reasons
  "New" : "badge-color-13",
  "Active": "badge-color-14",
  "Terminated": "badge-color-15",
  "Resigned": "badge-color-16",
  "RTWO": "badge-color-17",
  "AWOL": "badge-color-18",

  // Training Assignments
  "Training - ADP": "badge-color-19",

  // Nesting Assignments
  "AQ - Nesting": "badge-color-20",
  "Call Trader - Nesting": "badge-color-21",
  "GENX - Nesting": "badge-color-22",
  "WGL - Nesting": "badge-color-23",
  "Jade ACA Nesting": "badge-color-24",
  "ECX GH - Nesting": "badge-color-25",
  "ECX GHE - Nesting": "badge-color-26",
  "ECX LM - Nesting": "badge-color-27",
  "Assurity - Nesting": "badge-color-28",
  "Konnect Leads - Nesting": "badge-color-29",

  // Premium Programs
  "Endorsed to Deployment": "badge-color-30",
  "Passed": "badge-color-31",
  "Premium - Zinnia Health Intake": "badge-color-32",
  "Premium - Ramzey CS": "badge-color-33",
  "Premium - Simpson": "badge-color-34",
  "Premium - We Level Up": "badge-color-35",
  "Premium - Dan Fulfillment": "badge-color-36",
  "Premium - Ryan Simpson Financial": "badge-color-37",

  // Endorsements and Other Statuses
  "Women's Society-Premium": "badge-color-38",
  "Deployment Pool - T4": "badge-color-39",
  "Deployment Pool - VSS": "badge-color-40",
  "Endorsed - Support": "badge-color-41",
  "Zeta PHARMA": "badge-color-42"
};


function getFixedColorClass(value, map) {
  return map[value] || 'badge-color-default';
}



// 👉 activate tooltips on any [data-bs-toggle="tooltip"]
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el =>
  new bootstrap.Tooltip(el)
);


  $(document).ready(function () {
let latestSourceId = parseInt($('#mergedTable tbody tr:first-child td:first-child').text()) || 0;


  const loader = document.getElementById('globalLoader');
const table = $('#mergedTable').DataTable({
  deferRender: true,
  scrollCollapse: true,
  paging: true,
  info: true,
  fixedHeader: true,
  order: [[0, 'desc']],
  lengthMenu: [10, 25, 50, 100],
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









let currentRow = null;

$('#mergedTable').on('click', '.editBtn', function () {
  currentRow = $(this).closest('tr');
  const employeeId = $(this).data('id');
 
  // Show loading while fetching
  $('#editModalTitle').text('Loading...');
  $('#editModal').modal('show');


  $.ajax({
    url: 'get_deployment_single_record.php',
    method: 'GET',
    data: { id: employeeId },
    dataType: 'json',
    success: function (data) {
      $('#editModalTitle').text(data.employee_name || 'Edit Record');

      // Source Info
      $('#edit_id').val(data.id);
     

      // Personal Info
      $('#edit_name').val(data.employee_name);
      $('#edit_phone').val(data.mobile_no);
      $('#edit_birthdate').val(data.birthdate);
      $('#edit_email').val(data.email_address);
      $('#edit_address').val(data.address);
  



      // Training Info
      $('#edit_emp_id').val(data.emp_id || '');
      $('#edit_tin').val(data.tin || '');
      $('#edit_sss').val(data.sss || '');
      $('#edit_phic').val(data.phic || '');
      $('#edit_pagibig').val(data.pag_ibig || '');
      $('#edit_position').val(data.position || '');
      $('#edit_status').val(data.emp_status || '');

    

      
    },
    error: function () {
      $('#editModalTitle').text('Error loading data');
      $('#editForm input, #editForm select, #editForm textarea').prop('disabled', false);
      $('#alertContainer').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-warning me-2"></i><strong>Error:</strong> Unable to fetch record.
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `);
    }
  });
});




$('#mergedTable').on('click', '.historyBtn', function () {
  const empId = $(this).data('id');

  $.ajax({
    url: 'get_deployment_history.php', // ← you need to create this endpoint
    type: 'GET',
    data: { id: empId },
    dataType: 'json',
    success: function (response) {
      $('#historyName').text(response.employee_name || 'Employee');
      $('#historyEmpId').text(response.emp_id || '—');
      $('#historyStatus').text(response.emp_status || '—');
      $('#historyCampaign').text(response.campaign || '—');
      $('#historyDate').text(response.assigned_date || '—');

      const timeline = $('#historyTimeline');
      timeline.empty();

      response.history.forEach(entry => {
        const entryHtml = `
          <div class="timeline-entry">
            <div class="card p-3">
              <div class="d-flex justify-content-between">
                <div class="fw-semibold">${entry.title}</div>
                <small class="text-muted">${entry.date}</small>
              </div>
              <div class="mt-1">${entry.description}</div>
              ${entry.meta ? `<div class="mt-2 small text-muted">${entry.meta}</div>` : ''}
            </div>
          </div>
        `;
        timeline.append(entryHtml);
      });

      $('#historyModal').modal('show');
    },
    error: function () {
      alert('Failed to load deployment history.');
    }
  });
});












$('#editForm').on('submit', function (e) {
  e.preventDefault();

  // 1) show loader overlay
  $('#globalLoader').show();

  // 2) disable modal buttons so they can't close it
  $('#editCancelBtn, #editSaveBtn').prop('disabled', true);
  $('#editModal .btn-close').prop('disabled', true);

  const formData = $(this).serialize();
  const Id = $('#edit_id').val();

  $.ajax({
    type: 'POST',
    url: 'update_deployment.php',
    data: formData,
    dataType: 'json'
  })
  .done(function (response) {
    // show success alert
    $('#alertContainer').html(`
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check me-2"></i><strong>Success:</strong> ${response.message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);

    // fetch updated row and redraw
    $.ajax({
      url: 'get_deployment_single_record.php',
      type: 'GET',
      data: { id: Id },
      dataType: 'json',
      success: function (data) {
        const table = $('#mergedTable').DataTable();
     



   const statusBadge = `<span class="badge ${getFixedColorClass(data.emp_status || 'Pending', statusColorMap)}">${(data.emp_status || 'Pending').toUpperCase()}</span>`;
   
       
        table.row(currentRow).data([
          data.id,
          data.emp_id,
          data.employee_name,
          data.tin,
          data.sss,
          data.phic,
          data.pag_ibig,
          data.date_hired,
          data.position,
          data.campaign,
          data.cluster,
         statusBadge,
          `<div class="d-flex gap-1">
  <!-- Edit Button -->
  <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
    data-id="${data.id}" data-bs-toggle="tooltip" title="Edit">
    <i class="fa fa-edit"></i>
  </button>

  <!-- History Button -->
  <button class="btn btn-sm historyBtn" style="background-color: #ff5722; color: #ffffff;"
    data-id="${data.id}" data-bs-toggle="tooltip" title="View History">
    <i class="fa fa-clock-rotate-left"></i>
  </button>
</div>
`
        ]).draw(false);
      }
    });

    // close the modal
    $('#editModal').modal('hide');
  })
  .fail(function (xhr) {
    $('#alertContainer').html(`
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-warning me-2"></i><strong>Error:</strong> ${xhr.responseText}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
  })
  .always(function () {
    // 5) hide loader & re-enable buttons
    $('#globalLoader').hide();
    $('#editCancelBtn, #editSaveBtn').prop('disabled', false);
    $('#editModal .btn-close').prop('disabled', false);
  });
});



$('#addForm').on('submit', function (e) {
  e.preventDefault();

  // 1) Show loader
  $('#globalLoader').show();

  // 2) Disable modal buttons
  $('#addCancelBtn, #addSaveBtn').prop('disabled', true);
  $('#addCampaignModal .btn-close').prop('disabled', true);

  const formData = $(this).serialize();

  $.ajax({
    type: 'POST',
    url: 'add_campaign.php',
    data: formData,
    dataType: 'json'
  })
  .done(function (response) {
    if (response.status === 'success') {
      $('#alertContainer').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa fa-check me-2"></i><strong>Success:</strong> ${response.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `);

      // Fetch updated campaign record
      $.ajax({
        url: 'get_deployment_single_record.php',
        type: 'GET',
        data: { id: response.employee_id },
        dataType: 'json',
        success: function (data) {
          const table = $('#mergedTable').DataTable();

          // Find existing row with the same employee ID
          const rowIndex = table.rows().eq(0).filter(function (idx) {
            return table.cell(idx, 0).data() == data.id; // Adjust to column index where emp_id appears
          });

          const statusBadge = `<span class="badge ${getFixedColorClass(data.emp_status || 'Pending', statusColorMap)}">${(data.emp_status || 'Pending').toUpperCase()}</span>`;

          if (rowIndex.length > 0) {
            table.row(rowIndex[0]).data([
              data.id,
              data.emp_id,
              data.employee_name,
              data.tin,
              data.sss,
              data.phic,
              data.pag_ibig,
              data.date_hired,
              data.position,
              data.campaign,
              data.cluster,
              statusBadge,
              `<div class="d-flex gap-1">
  <!-- Edit Button -->
  <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
    data-id="${data.id}" data-bs-toggle="tooltip" title="Edit">
    <i class="fa fa-edit"></i>
  </button>

  <!-- History Button -->
  <button class="btn btn-sm historyBtn" style="background-color: #ff5722; color: #ffffff;"
    data-id="${data.id}" data-bs-toggle="tooltip" title="View History">
    <i class="fa fa-clock-rotate-left"></i>
  </button>
</div>
`
            ]).draw(false);
          }

          $('#addCampaignModal').modal('hide');
          $('#addForm')[0].reset();
        }
      });
    } else {
      $('#alertContainer').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-warning me-2"></i><strong>Error:</strong> ${response.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `);
    }
  })
  .fail(function (xhr) {
    $('#alertContainer').html(`
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-warning me-2"></i><strong>Error:</strong> ${xhr.responseText}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
  })
  .always(function () {
    // 5) Re-enable modal controls
    $('#globalLoader').hide();
    $('#addCancelBtn, #addSaveBtn').prop('disabled', false);
    $('#addCampaignModal .btn-close').prop('disabled', false);
  });
});









$(function() {
  const container = document.getElementById('alertContainer');
  const obs = new MutationObserver(mutations => {
    mutations.forEach(m => {
      m.addedNodes.forEach(node => {
        if (node.nodeType === 1 && node.classList.contains('alert')) {
          // auto‐fade and slide up after 3s
          setTimeout(() => {
            $(node).fadeTo(500, 0).slideUp(500, () => $(node).remove());
          }, 3000);
        }
      });
    });
  });
  obs.observe(container, { childList: true });
});










  });


window.addEventListener("pageshow", function (event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
      // Force reload from server
      window.location.reload();
    }
  });





</script>








</div>
     
    </div>
  </div>
</div>
<!-- Page Wrapper -->


