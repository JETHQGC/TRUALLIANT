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
          <h4 class="mb-0" style="color: #0e1e40; font-weight: 700;">Training</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
             <li class="breadcrumb-item">
              <a href="dashboard.php" style="text-decoration: none; color: #f36523; font-weight: bold; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-home" style="color: #f36523;"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #0e1e40; font-weight: 600;">Training</li>
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
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    i.bpo_exp,
    e.date_endorsed, e.endorsement_id,
    t.batch, t.trainer, t.day1_attendance, t.ta_credential, t.trainee_status, t.status_date, t.status_remarks
  FROM source s
  LEFT JOIN personal_info p ON s.source_id = p.source_id
  LEFT JOIN endorsement e ON s.source_id = e.source_id
  LEFT JOIN initial_interview i ON s.source_id = i.source_id
  LEFT JOIN training t ON e.endorsement_id = t.endorsement_id
  WHERE 
    e.signed_contract = 'Yes'
    AND e.date_endorsed IS NOT NULL
    AND e.date_endorsed != ''
    AND e.date_endorsed != '0000-00-00'
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
  // Statuses to retain
  'Email Sent' => 'badge-color-11',
  'Pending' => 'badge-color-12',

  // Termination Reasons
  'No Show Day 1 - Endorsed to Recruitment' => 'badge-color-13',
  'Terminated - Training Absences' => 'badge-color-14',
  'Terminated - Trainee Poor Performance' => 'badge-color-15',
  'Terminated - Resigned' => 'badge-color-16',
  'Terminated - Nesting Absences' => 'badge-color-17',
  'Terminated - Nesting Poor Performance' => 'badge-color-18',

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
  'Deployment Pool - Premium' => 'badge-color-30',
  'Premium - Synergy' => 'badge-color-31',
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

        <div class="card-header bg-white border-bottom d-flex align-items-center">
  <span class="fw-semibold" style="color: #0e1e40;">Records</span>
  <div class="ms-auto d-flex gap-2">
    <!-- Send Orientation Schedule -->
  

    <!-- Mark as Present (start disabled) -->
    <button id="endorse_btn" class="btn btn-sm"
  style="background-color: #f36523; color: white; border-color: #ffffff;"
  onmouseover="this.style.backgroundColor='#0e1e40';"
  onmouseout="this.style.backgroundColor='#f36523';">
  <i class="fa fa-check me-1"></i>
  Send Training Schedule
</button>
  </div>
</div>





            <div class="card-body">
              
                 <div class="datatable-wrapper">
                  
  <table id="mergedTable" class="table table-hover align-left text-nowrap shadow-sm rounded-3 mb-0" style="width:100%; border-collapse: separate; border-spacing: 0;">

    <thead class="table-light">
      
      <tr>
        <th>ID</th>
        <th>Date Endorsed</th>
        <th>Name</th>
        <th>Batch</th>
        <th>Credentials</th>
        <th>Trainer</th>
        <th>Day 1</th>
        <th>Status</th>
        <th>Status Date</th>
        <th>Remarks</th>
        <th>Action</th>
        <th style="width: 1%;"><input type="checkbox" id="selectAll"></th>
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $row['source_id'] ?></td>
           <td><?= $row['date_endorsed'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['batch'] ?></td>
          <td><?= $row['ta_credential'] ?></td>
          <td><?= $row['trainer'] ?></td>
          <td>
            <?php if ($row['day1_attendance'] === 'Yes'): ?>
              <span class="badge bg-success">Yes</span>
            <?php elseif ($row['day1_attendance'] === 'No'): ?>
              <span class="badge bg-danger">No</span>
            <?php else: ?>
              <!-- Leave blank -->
            <?php endif; ?>
            </td>
            <td> <span class="badge <?= getFixedColorClass(!empty($row['trainee_status']) ? $row['trainee_status'] : 'Pending', $statusColorMap) ?>">
    <?= strtoupper(!empty($row['trainee_status']) ? $row['trainee_status'] : 'Pending') ?>
  </span></td>
          <td><?= $row['status_date'] ?></td>
          <td><?= $row['status_remarks'] ?></td>
      

          



          <td>
         <div class="d-flex gap-1">
  <!-- Edit Button -->
  <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;" 
    data-id="<?= $row['endorsement_id'] ?>">
    <i class="fa fa-edit"></i>
  </button>

  <!-- Scorecard Button -->
<?php
  $isDisabled = (empty($row['batch']) || $row['batch'] === '0000-00-00 00:00:00');
?>

<span 
  <?= $isDisabled ? 'data-bs-toggle="tooltip" title="Assign a batch to enable scorecard"' : '' ?>
>
  <button 
    class="btn btn-sm scorecardBtn" 
    style="background-color: #f36523; color: #ffffff;" 
    data-id="<?= $row['endorsement_id'] ?>" 
    data-name="<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>"
    <?= $isDisabled ? 'disabled' : '' ?>
  >
    <i class="fa fa-star"></i>
  </button>
</span>

</div>


         </td>
<td>
  <input
    type="checkbox"
    class="row-checkbox"
    value="<?= $row['endorsement_id'] ?>"
    <?= (
      empty($row['batch']) ||
      $row['batch'] === '0000-00-00 00:00:00' ||
      $row['trainee_status'] !== ''
    ) ? 'disabled' : '' ?>
  >
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
  <?php include 'includes/edit_training_modal.php'; ?>
   <?php include 'includes/send_training_schedule_modal.php'; ?>
  <?php include 'includes/edit_scorecard_modal.php'; ?>












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
  "No Show Day 1 - Endorsed to Recruitment": "badge-color-13",
  "Terminated - Training Absences": "badge-color-14",
  "Terminated - Trainee Poor Performance": "badge-color-15",
  "Terminated - Resigned": "badge-color-16",
  "Terminated - Nesting Absences": "badge-color-17",
  "Terminated - Nesting Poor Performance": "badge-color-18",

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
  "Deployment Pool - Premium": "badge-color-30",
  "Premium - Synergy": "badge-color-31",
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
  const endorsementId = $(this).data('id');

  // Show loading while fetching
  $('#editModalTitle').text('Loading...');
  $('#editModal').modal('show');
  $('#editForm input, #editForm select, #editForm textarea').prop('disabled', true);

  $.ajax({
    url: 'get_training_single_record.php',
    method: 'GET',
    data: { id: endorsementId },
    dataType: 'json',
    success: function (data) {
      $('#editModalTitle').text(data.name || 'Edit Record');

      // Source Info
      $('#edit_source_id').val(data.source_id);
      $('#edit_date_endorsed').val(data.date_endorsed);
      $('#edit_endorsement_id').val(data.endorsement_id);

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

      // Training Info
      $('#edit_batch').val(data.batch || '');
      $('#edit_trainer').val(data.trainer || '');
      $('#edit_attendance').val(data.day1_attendance || '');
      $('#edit_credential').val(data.ta_credential || '');
      $('#edit_trainee_status').val(data.trainee_status || '');
      $('#edit_status_date').val(data.status_date || '');
      $('#edit_remarks').val(data.status_remarks || '');

      $('#editForm input, #editForm select, #editForm textarea').prop('disabled', false);
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




let currentEndorsementId = null;
$('#mergedTable').on('click', '.scorecardBtn', function () {
   currentRow = $(this).closest('tr');
  currentEndorsementId = $(this).data('id');
  const traineeName = $(this).data('name');

  $('#scorecardModalLabel').text(`Scorecard: ${traineeName}`);
  $('#scorecardForm')[0].reset();
  $('#scoreSummary').empty();
  $('#scorecardActionBtn').text('Calculate').removeClass('btn-success').addClass('btn-primary');
  $('#scorecardModal').modal('show');

  // 🔁 Autofill via AJAX
  $.ajax({
    url: 'get_scorecard.php',
    method: 'GET',
    data: { id: currentEndorsementId },
    dataType: 'json',
    success: function (data) {
      if (!data) return;

      $('[name=call_control]').val(data.call_control || '');
      $('[name=rebuttals]').val(data.rebuttals || '');
      $('[name=script_adherence]').val(data.script_adherence || '');
      $('[name=professionalism]').val(data.professionalism || '');
      $('[name=closing]').val(data.closing || '');
      $('[name=product_knowledge]').val(data.product_knowledge || '');
      $('[name=dialer_howto]').val(data.dialer_how_to || '');
      $('[name=language]').val(data.language_101 || '');
    }
  });
});


 
$('#scorecardForm').on('submit', function (e) {
  e.preventDefault();

  const btn = $('#scorecardActionBtn');
  const v = name => parseFloat($(`[name=${name}]`).val()) || 0;

  if (btn.text() === 'Calculate') {
    // 🔢 Do calculations
    const callControl     = v('call_control');
    const rebuttals       = v('rebuttals');
    const scriptAdherence = v('script_adherence');
    const professionalism = v('professionalism');
    const closing         = v('closing');

    const mockCallWeights = {
      callControl: 0.40,
      rebuttals: 0.25,
      scriptAdherence: 0.20,
      professionalism: 0.10,
      closing: 0.05
    };

    const partialMockCall = (
      (callControl / 10) * mockCallWeights.callControl +
      (rebuttals / 10) * mockCallWeights.rebuttals +
      (scriptAdherence / 10) * mockCallWeights.scriptAdherence +
      (professionalism / 10) * mockCallWeights.professionalism +
      (closing / 10) * mockCallWeights.closing
    ) * 100;

    const finalMockCall = partialMockCall * 0.40 / 100;
    const productKnowledge = (v('product_knowledge') / 10) * 0.30;
    const dialerHowTo      = (v('dialer_howto') / 10) * 0.20;
    const language         = (v('language') / 10) * 0.10;

    const totalScore = (finalMockCall + productKnowledge + dialerHowTo + language) * 100;

$('#scoreSummary').html(`
  <div style="background-color: #e6f0ff; color: #0e1e40; padding: 24px; border-radius: 12px; font-family: 'Poppins', sans-serif; border: 1px solid #b3d1ff;">
    <div style="display: flex; flex-direction: column; gap: 18px;">

      <!-- Partial Mock Call -->
      <div style="border-left: 4px solid #0e1e40; padding-left: 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="font-weight: 600;">Partial Mock Call Score</div>
          <div style="background-color: #ffffff; color: #0e1e40; padding: 6px 14px; border-radius: 6px; font-weight: 600; border: 1px solid #ccdfff;">
            ${partialMockCall.toFixed(2)}%
          </div>
        </div>
        <div style="margin-top: 6px; height: 10px; background-color: #ccdfff; border-radius: 4px; overflow: hidden;">
          <div style="width: ${partialMockCall}%; height: 100%; background-color: #f36523;"></div>
        </div>
      </div>

      <!-- Final Mock Call -->
      <div style="border-left: 4px solid #0e1e40; padding-left: 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="font-weight: 600;">Final Mock Call <span style="opacity: 0.7;">(40%)</span></div>
          <div style="background-color: #ffffff; color: #0e1e40; padding: 6px 14px; border-radius: 6px; font-weight: 600; border: 1px solid #ccdfff;">
            ${(finalMockCall * 100).toFixed(2)}%
          </div>
        </div>
        <div style="margin-top: 6px; height: 10px; background-color: #ccdfff; border-radius: 4px; overflow: hidden;">
          <div style="width: ${(finalMockCall * 100)}%; height: 100%; background-color: #f36523;"></div>
        </div>
      </div>

      <!-- Product Knowledge -->
      <div style="border-left: 4px solid #0e1e40; padding-left: 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="font-weight: 600;">Product Knowledge <span style="opacity: 0.7;">(30%)</span></div>
          <div style="background-color: #ffffff; color: #0e1e40; padding: 6px 14px; border-radius: 6px; font-weight: 600; border: 1px solid #ccdfff;">
            ${(productKnowledge * 100).toFixed(2)}%
          </div>
        </div>
        <div style="margin-top: 6px; height: 10px; background-color: #ccdfff; border-radius: 4px; overflow: hidden;">
          <div style="width: ${(productKnowledge * 100)}%; height: 100%; background-color: #f36523;"></div>
        </div>
      </div>

      <!-- Dialer How-To -->
      <div style="border-left: 4px solid #0e1e40; padding-left: 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="font-weight: 600;">Dialer How-To <span style="opacity: 0.7;">(20%)</span></div>
          <div style="background-color: #ffffff; color: #0e1e40; padding: 6px 14px; border-radius: 6px; font-weight: 600; border: 1px solid #ccdfff;">
            ${(dialerHowTo * 100).toFixed(2)}%
          </div>
        </div>
        <div style="margin-top: 6px; height: 10px; background-color: #ccdfff; border-radius: 4px; overflow: hidden;">
          <div style="width: ${(dialerHowTo * 100)}%; height: 100%; background-color: #f36523;"></div>
        </div>
      </div>

      <!-- Language 101 -->
      <div style="border-left: 4px solid #0e1e40; padding-left: 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="font-weight: 600;">Language 101 <span style="opacity: 0.7;">(10%)</span></div>
          <div style="background-color: #ffffff; color: #0e1e40; padding: 6px 14px; border-radius: 6px; font-weight: 600; border: 1px solid #ccdfff;">
            ${(language * 100).toFixed(2)}%
          </div>
        </div>
        <div style="margin-top: 6px; height: 10px; background-color: #ccdfff; border-radius: 4px; overflow: hidden;">
          <div style="width: ${(language * 100)}%; height: 100%; background-color: #f36523;"></div>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <hr style="border-color: #b3d1ff; margin: 1.5rem 0;">

    <!-- Total Score -->
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <div style="font-size: 1.3rem; font-weight: bold; color: #f36523;">Total Score</div>
      <div style="background-color: #f36523; color: #ffffff; padding: 8px 20px; border-radius: 6px; font-weight: bold; font-size: 1.3rem;">
        ${totalScore.toFixed(2)}%
      </div>
    </div>
  </div>
`);


// 🔁 Change button to "Save" mode
btn.text('Save').removeClass('btn-primary').addClass('btn-success');

  } else {
    // 💾 SAVE to database using endorsement_id
    const postData = {
      endorsement_id: currentEndorsementId,
      call_control: v('call_control'),
      rebuttals: v('rebuttals'),
      script_adherence: v('script_adherence'),
      professionalism: v('professionalism'),
      closing: v('closing'),
      product_knowledge: v('product_knowledge'),
      dialer_how_to: v('dialer_howto'),
      language: v('language')
    };

    $('#scorecardActionBtn').prop('disabled', true).text('Saving...');

    $.post('save_scorecard.php', postData, function (response) {
      if (response.status === 'success') {
        $('#scoreSummary').append(`<div class="alert alert-success mt-3">Score saved successfully!</div>`);
           $.ajax({
      url: 'get_training_single_record.php',
      type: 'GET',
      data: { id: currentEndorsementId },
      dataType: 'json',
      success: function (data) {
        const table = $('#mergedTable').DataTable();
       const canCheck = (
  data.batch &&
  data.trainee_status === '' &&
  data.batch !== '0000-00-00 00:00:00'
);

   const checkboxCell = `
    <input
      type="checkbox"
      class="row-checkbox"
      value="${data.endorsement_id}"
      ${canCheck ? '' : 'disabled'}
    >
  `;

   const statusBadge = `<span class="badge ${getFixedColorClass(data.trainee_status || 'Pending', statusColorMap)}">${(data.trainee_status || 'Pending').toUpperCase()}</span>`;
   
       const isDisabled = !data.batch || data.batch === '0000-00-00 00:00:00';
const scorecardBtn = `
  <span ${isDisabled ? 'data-bs-toggle="tooltip" title="Assign a batch to enable scorecard"' : ''}>
    <button class="btn btn-sm scorecardBtn" style="background-color: #f36523; color: #ffffff;"
      data-id="${data.endorsement_id}" 
      data-name="${data.name.replace(/"/g, '&quot;')}"
      ${isDisabled ? 'disabled' : ''}>
      <i class="fa fa-star"></i>
    </button>
  </span>
`;
        table.row(currentRow).data([
          data.source_id,
          data.date_endorsed,
          data.name,
          data.batch,
          data.ta_credential,
          data.trainer,
          data.day1_attendance === 'Yes'
  ? '<span class="badge bg-success">Yes</span>'
  : data.day1_attendance === 'No'
    ? '<span class="badge bg-danger">No</span>'
    : '',
         statusBadge,
          data.status_date,
          data.status_remarks,
          `<div class="d-flex gap-1">
             <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
              data-id="${data.endorsement_id}">
              <i class="fa fa-edit"></i>
            </button>
            ${scorecardBtn}
           </div>`,
            checkboxCell,
        ]).draw(false);
      }
    });


    $('#scorecardModal').modal('hide');
      } else {
        $('#scoreSummary').append(`<div class="alert alert-danger mt-3">${response.message}</div>`);
      }
      $('#scorecardActionBtn').prop('disabled', false).text('Save');
    }, 'json');
  }
});






$('#editForm').on('submit', function (e) {
  e.preventDefault();

  // 1) show loader overlay
  $('#globalLoader').show();

  // 2) disable modal buttons so they can't close it
  $('#editCancelBtn, #editSaveBtn').prop('disabled', true);
  $('#editModal .btn-close').prop('disabled', true);

  const formData = $(this).serialize();
  const sourceId = $('#edit_endorsement_id').val();

  $.ajax({
    type: 'POST',
    url: 'update_training.php',
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
      url: 'get_training_single_record.php',
      type: 'GET',
      data: { id: sourceId },
      dataType: 'json',
      success: function (data) {
        const table = $('#mergedTable').DataTable();
       const canCheck = (
  data.batch &&
  data.trainee_status === '' &&
  data.batch !== '0000-00-00 00:00:00'
);

   const checkboxCell = `
    <input
      type="checkbox"
      class="row-checkbox"
      value="${data.endorsement_id}"
      ${canCheck ? '' : 'disabled'}
    >
  `;

   const statusBadge = `<span class="badge ${getFixedColorClass(data.trainee_status || 'Pending', statusColorMap)}">${(data.trainee_status || 'Pending').toUpperCase()}</span>`;
   
       const isDisabled = !data.batch || data.batch === '0000-00-00 00:00:00';
const scorecardBtn = `
  <span ${isDisabled ? 'data-bs-toggle="tooltip" title="Assign a batch to enable scorecard"' : ''}>
    <button class="btn btn-sm scorecardBtn" style="background-color: #f36523; color: #ffffff;"
      data-id="${data.endorsement_id}" 
      data-name="${data.name.replace(/"/g, '&quot;')}"
      ${isDisabled ? 'disabled' : ''}>
      <i class="fa fa-star"></i>
    </button>
  </span>
`;
        table.row(currentRow).data([
          data.source_id,
          data.date_endorsed,
          data.name,
          data.batch,
          data.ta_credential,
          data.trainer,
          data.day1_attendance === 'Yes'
  ? '<span class="badge bg-success">Yes</span>'
  : data.day1_attendance === 'No'
    ? '<span class="badge bg-danger">No</span>'
    : '',
         statusBadge,
          data.status_date,
          data.status_remarks,
          `<div class="d-flex gap-1">
             <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
              data-id="${data.endorsement_id}">
              <i class="fa fa-edit"></i>
            </button>
            ${scorecardBtn}
           </div>`,
            checkboxCell,
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





$('#selectAll').on('change', function() {
  const checked = this.checked;
  $('.row-checkbox:not(:disabled)').prop('checked', checked);
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





// when user clicks “Send Orientation Schedule”
$('#endorse_btn').on('click', () => { 
  // gather all enabled, checked boxes
  const checked = $('.row-checkbox:checked:not(:disabled)');
  if (!checked.length) {
    $('#alertContainer').html(`
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle me-2"></i>
        Please select at least one trainee.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
    return;
  }

  // build lists of IDs & names
  const ids = [], names = [];
  checked.each(function() {
    ids.push($(this).val());
    // assume Name is in the 3rd <td> (zero-based index 2)
    names.push($(this).closest('tr').find('td').eq(2).text());
  });

  // populate modal list
  $('#sendList').empty();
  names.forEach(n => $('#sendList').append(`<li>${n}</li>`));

  // stash IDs on the modal for when they confirm
  $('#sendEndorsementModal').data('ids', ids).modal('show');
});

// when they click “Confirm Send”
$('#confirmSendBtn').on('click', () => {
  $('#globalLoader').show();
  const modal = $('#sendEndorsementModal');
  const ids   = modal.data('ids') || [];

  $('#confirmSendBtn').prop('disabled', true);

  $.ajax({
    url: 'send_training_schedule.php',
    method: 'POST',
    data: { ids },
    dataType: 'json'
  })
  .done(resp => {
    $('#alertContainer').html(`
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check me-2"></i>${resp.message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);

    // for each selected ID, fetch back its updated row
    ids.forEach(id => {
      $.ajax({
        url: 'get_training_single_record.php',
        data: { id },
        dataType: 'json'
      }).done(data => {
        // locate the DataTable row by matching source_id
        const row = table.row(function(idx, rowData) {
          return parseInt(rowData[0], 10) === parseInt(data.source_id, 10);
        });

        if (!row.node()) return;

        // rebuild the row array exactly as your table expects:
        const canCheck = (
  data.batch &&
  data.trainee_status === '' &&
  data.batch !== '0000-00-00 00:00:00'
);
        const checkboxCell = `
    <input
      type="checkbox"
      class="row-checkbox"
      value="${data.endorsement_id}"
      ${canCheck ? '' : 'disabled'}
    >
  `;

  const statusBadge = `<span class="badge ${getFixedColorClass(data.trainee_status || 'Pending', statusColorMap)}">${(data.trainee_status || 'Pending').toUpperCase()}</span>`;
       const isDisabled = !data.batch || data.batch === '0000-00-00 00:00:00';
const scorecardBtn = `
  <span ${isDisabled ? 'data-bs-toggle="tooltip" title="Assign a batch to enable scorecard"' : ''}>
    <button class="btn btn-sm scorecardBtn" style="background-color: #f36523; color: #ffffff;"
      data-id="${data.endorsement_id}" 
      data-name="${data.name.replace(/"/g, '&quot;')}"
      ${isDisabled ? 'disabled' : ''}>
      <i class="fa fa-star"></i>
    </button>
  </span>
`;


        row.data([
         data.source_id,
          data.date_endorsed,
          data.name,
          data.batch,
          data.ta_credential,
          data.trainer,
          data.day1_attendance === 'Yes'
  ? '<span class="badge bg-success">Yes</span>'
  : data.day1_attendance === 'No'
    ? '<span class="badge bg-danger">No</span>'
    : '',
           statusBadge,
          data.status_date,
          data.status_remarks,
          `<div class="d-flex gap-1">
  <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
    data-id="${data.endorsement_id}">
    <i class="fa fa-edit"></i>
  </button>
   ${scorecardBtn}
</div>`,
            checkboxCell
        ]).draw(false);
      });
    });
  })
  .fail(xhr => {
    $('#alertContainer').html(`
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-warning me-2"></i>Error sending emails: ${xhr.responseText}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
  })
  .always(() => {
    $('#globalLoader').hide();
    $('#confirmSendBtn').prop('disabled', false);
    modal.modal('hide');
  });
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


