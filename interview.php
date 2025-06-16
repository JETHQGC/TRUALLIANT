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
          <h4 class="mb-0" style="color: #0e1e40; font-weight: 700;">Interview</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
             <li class="breadcrumb-item">
              <a href="dashboard.php" style="text-decoration: none; color: #f36523; font-weight: bold; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-home" style="color: #f36523;"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #0e1e40; font-weight: 600;">Interview</li>
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
    s.source_id,
    s.mode,
    s.source_date,
    s.source_by,
    s.recruiter,
    s.scheduled_interview,
    s.status,
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    i.bpo_exp, i.expected_salary, i.previous_salary, i.incentives, i.benefits,
    i.reason_for_leaving, i.medical_condition, i.can_work_shifting_sched,
    i.can_work_weekend_holidays, i.can_work_onsite, i.fully_vaccinated,
    i.currently_studying, i.initial_interview, i.second_call_attempt, i.third_call_attempt
  FROM source s
  LEFT JOIN personal_info p     ON s.source_id = p.source_id
  LEFT JOIN initial_interview i ON s.source_id = i.source_id
  WHERE 
    s.deleted = 0
    AND s.status IN ('New','For Rehire Check')
  ORDER BY s.source_id DESC
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
  'New' => 'badge-color-11',
  'For Assessment' => 'badge-color-12',
  'No Answer' => 'badge-color-13',
  'Unattended' => 'badge-color-14',
  'Wrong Number' => 'badge-color-15',
  'Not Interested' => 'badge-color-16',
  'Previous TA Employee not For Rehire' => 'badge-color-17',
  'For Rehire Check' => 'badge-color-18',
  'Failed' => 'badge-color-19',
  'Passed' => 'badge-color-20',
  'JO Sent' => 'badge-color-21',
  'JO Accepted' => 'badge-color-22',
  'Endorsed to Training' => 'badge-color-23',
  'Failed - Studying' => 'badge-color-24',
  'Waiting for Graduation' => 'badge-color-25',
  'For Support' => 'badge-color-26',
  'Withdrawn - Low Salary' => 'badge-color-27',
  'Withdrawn - HMO' => 'badge-color-28',
  'Withdrawn - Personal Reason' => 'badge-color-29',
  'Pending' => 'badge-color-30' // Default color for pending status
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

<!-- End: + New Button with Inline Hover Effect -->
            </div>



            <div class="card-body">
                 <div class="datatable-wrapper">
                  
  <table id="mergedTable" class="table table-hover align-left text-nowrap shadow-sm rounded-3 mb-0" style="width:100%; border-collapse: separate; border-spacing: 0;">

    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Source Date</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Sourced By</th>
        <th>Recruiter</th>
        <th>Scheduled Interview</th>
        <th>Second Call</th>
        <th>Third Call</th>
        <th>Interview Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $row['source_id'] ?></td>
          <td><?= $row['source_date'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['phone'] ?></td>
          <td><?= $row['source_by'] ?></td>
          <td><?= $row['recruiter'] ?></td>
          <td><?= $row['scheduled_interview'] ?></td>
         <td><?= $row['second_call_attempt'] ?></td>
          <td><?= $row['third_call_attempt'] ?></td>
       <td>
  <span class="badge <?= getFixedColorClass(
      !empty($row['initial_interview']) ? $row['initial_interview'] : 'Pending',
      $statusColorMap
    ) ?>">
    <?= strtoupper(
      !empty($row['initial_interview']) ? $row['initial_interview'] : 'Pending'
    ) ?>
  </span>
</td>

        
       
          
          <td>
          <div class="d-flex gap-1">
          <!-- Edit Button -->
          <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;" data-id='<?= json_encode($row) ?>'>
          <i class="fa fa-edit"></i>
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
  <?php include 'includes/edit_interview_modal.php'; ?>












<script>
    const currentRecruiter = <?= json_encode($user['name']); ?>;
    const currentRecruiterusername = <?= json_encode($user['username']); ?>;


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
  'New': 'badge-color-11',
  'For Assessment': 'badge-color-12',
  'No Answer': 'badge-color-13',
  'Unattended': 'badge-color-14',
  'Wrong Number': 'badge-color-15',
  'Not Interested': 'badge-color-16',
  'Previous TA Employee not For Rehire': 'badge-color-17',
  'For Rehire Check': 'badge-color-18',
  'Failed': 'badge-color-19',
  'Passed': 'badge-color-20',
  'JO Sent': 'badge-color-21',
  'JO Accepted': 'badge-color-22',
  'Endorsed to Training': 'badge-color-23',
  'Failed - Studying': 'badge-color-24',
  'Waiting for Graduation': 'badge-color-25',
  'For Support': 'badge-color-26',
  'Withdrawn - Low Salary': 'badge-color-27',
  'Withdrawn - HMO': 'badge-color-28',
  'Withdrawn - Personal Reason': 'badge-color-29',
  'Pending': 'badge-color-30' // Default color for pending status
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
   currentRow = $(this).closest('tr'); // 🔧 Store the current table row
  const data = $(this).data('id'); // JSON-parsed row data

 // 1) Only users whose username starts with "recruiter" may act as recruiter
if (!currentRecruiterusername.toLowerCase().startsWith('recruiter')) {
  $('#alertContainer').html(`
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="fa fa-lock me-2"></i>
      Only users in the “recruiter” group can edit interview records.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `);
  return;
}

// 2) Even if you’re in the recruiter group, you can only touch your own assignments
if (data.recruiter !== currentRecruiter) {
  $('#alertContainer').html(`
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fa fa-exclamation-triangle me-2"></i>
      You’re not the assigned recruiter for this record.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `);
  return;
}

// …proceed with showing modal or whatever…


  


$('#editModalTitle').text(data.name || 'Edit Record');

  // Source Info
  $('#edit_source_id').val(data.source_id);
  $('#edit_source_date').val(data.source_date);
  $('#edit_source_by').val(data.source_by);
  $('#edit_scheduled_interview').val(data.scheduled_interview);
  $('#edit_status').val(data.status);
 

  // Personal Info
  $('#edit_name').val(data.name);
  $('#edit_phone').val(data.phone);
  $('#edit_age').val(data.age);
  $('#edit_birthdate').val(data.birthdate);
  $('#edit_email').val(data.email);
  $('#edit_address').val(data.address);
  $('#edit_city_municipality').val(data.city_municipality);
  $('#edit_educational_attainment').val(data.educational_attainment);
  $('#edit_name_of_school').val(data.name_of_school);
  $('#edit_year_last_attended').val(data.year_last_attended);


  // Initial Interview Info
  $('#edit_bpo_exp').val(data.bpo_exp);
  $('#edit_expected_salary').val(data.expected_salary);
  $('#edit_previous_salary').val(data.previous_salary);
  $('#edit_incentives').val(data.incentives);
  $('#edit_benefits').val(data.benefits);
  $('#edit_reason_for_leaving').val(data.reason_for_leaving);
  $('#edit_medical_condition').val(data.medical_condition);
  $('#edit_can_work_shifting_sched').val(data.can_work_shifting_sched);
  $('#edit_can_work_weekend_holidays').val(data.can_work_weekend_holidays);
  $('#edit_can_work_onsite').val(data.can_work_onsite);
  $('#edit_fully_vaccinated').val(data.fully_vaccinated);
  $('#edit_currently_studying').val(data.currently_studying);
  $('#edit_initial_interview').val(data.initial_interview);
  $('#edit_second_call_attempt').val(data.second_call_attempt);
  $('#edit_third_call_attempt').val(data.third_call_attempt);
 



  // Show modal
  $('#editModal').modal('show');



  





});






$('#editForm').on('submit', function (e) {
  e.preventDefault();



  const formData = $(this).serialize();
  const sourceId = $('#edit_source_id').val();

  $.ajax({
    type: 'POST',
    url: 'update_interview.php',
    data: formData,
    dataType: 'json',
    success: function (response) {
      // ✅ Step 1: Show success alert
      $('#alertContainer').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa fa-check me-2"></i><strong>Success:</strong> ${response.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `);
$('#editModal').modal('hide');


      $.ajax({
        url: 'get_interview_single_record.php',
        type: 'GET',
        data: { id: sourceId },
        dataType: 'json',
        success: function (data) {
          const table = $('#mergedTable').DataTable();

          // ✅ Step 3: Update DataTable row
          table.row(currentRow).data([
            data.source_id,
            data.source_date,
            data.name,
            data.phone,
            data.source_by,
            data.recruiter,
            data.scheduled_interview || '',
            data.second_call_attempt || '',
            data.third_call_attempt || '',
            `<span class="badge ${getFixedColorClass(data.initial_interview, statusColorMap)}">${data.initial_interview.toUpperCase()}</span>`,

          
       
            `<div class="d-flex gap-1">
              <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;" data-id='${JSON.stringify(data)}'>
                <i class="fa fa-edit"></i>
              </button>
              

            </div>`
          ]).draw(false);

          
           

       
        } 
      });
    },
    error: function (xhr) {
      $('#alertContainer').html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-warning me-2"></i><strong>Error:</strong> ${xhr.responseText}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `);
    }
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


