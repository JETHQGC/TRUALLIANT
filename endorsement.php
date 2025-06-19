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
          <h4 class="mb-0" style="color: #0e1e40; font-weight: 700;">Endorsement</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
             <li class="breadcrumb-item">
              <a href="dashboard.php" style="text-decoration: none; color: #f36523; font-weight: bold; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-home" style="color: #f36523;"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #0e1e40; font-weight: 600;">Endorsement</li>
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
    s.source_date,
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    i.bpo_exp,
    e.shift, e.facilitator, e.confirmation, e.second_confirmation, e.emergency_contact_person, e.emergency_contact_number, e.emergency_contact_address,
    e.date_endorsed, e.signed_contract
  FROM source s
  LEFT JOIN personal_info p ON s.source_id = p.source_id
  LEFT JOIN assessment a ON s.source_id = a.source_id
  LEFT JOIN orientation o ON s.source_id = o.source_id
  LEFT JOIN initial_interview i ON s.source_id = i.source_id
  LEFT JOIN endorsement e ON s.source_id = e.source_id
  WHERE 
  o.orientation_status IN ('Present')
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
  'Present' => 'badge-color-21',
  'JO Accepted' => 'badge-color-22',
  'Endorsed to Training' => 'badge-color-23',
  'Failed - Studying' => 'badge-color-24',
  'Waiting for Graduation' => 'badge-color-25',
  'Email Sent' => 'badge-color-26',
  'Withdrawn - Low Salary' => 'badge-color-27',
  'Withdrawn - HMO' => 'badge-color-28',
  'Withdrawn - Personal Reason' => 'badge-color-29',
  'Pending' => 'badge-color-30'
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
  Endorse to Training
</button>
  </div>
</div>





            <div class="card-body">
              
                 <div class="datatable-wrapper">
                  
  <table id="mergedTable" class="table table-hover align-left text-nowrap shadow-sm rounded-3 mb-0" style="width:100%; border-collapse: separate; border-spacing: 0;">

    <thead class="table-light">
      
      <tr>
        <th>ID</th>
        <th>Source Date</th>
        <th>Name</th>
        <th>Shift</th>
        <th>Facilitator</th>
        <th>Confirmation</th>
        <th>Second Confirmation</th>
        <th>Contact Person</th>
        <th>Emergency Contact #</th>
        <th>Contact Address</th>
        <th>Signed Contract</th>
        <th>Date Endorsed</th>
        <th>Action</th>
        <th style="width: 1%;"><input type="checkbox" id="selectAll"></th>
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $row['source_id'] ?></td>
           <td><?= $row['source_date'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['shift'] ?></td>
          <td><?= $row['facilitator'] ?></td>
          <td><?= $row['confirmation'] ?></td>
          <td><?= $row['second_confirmation'] ?></td>
          <td><?= $row['emergency_contact_person'] ?></td>
          <td><?= $row['emergency_contact_number'] ?></td>
          <td><?= $row['emergency_contact_address'] ?></td>
      <td>
  <?php if ($row['signed_contract'] === 'Yes'): ?>
    <span class="badge bg-success">Yes</span>
  <?php elseif ($row['signed_contract'] === 'No'): ?>
    <span class="badge bg-danger">No</span>
  <?php else: ?>
    <!-- Leave blank -->
  <?php endif; ?>
</td>

          <td><?= $row['date_endorsed'] ?></td>



          <td>
          <div class="d-flex gap-1">
          <!-- Edit Button -->
          <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;" data-id='<?= json_encode($row) ?>'>
          <i class="fa fa-edit"></i>
          </button>

          
         </div>
         </td>
<td>
  <input
    type="checkbox"
    class="row-checkbox"
    value="<?= $row['source_id'] ?>"
    <?= (
      empty($row['shift']) ||
      empty($row['facilitator']) ||
      empty($row['confirmation']) ||
      empty($row['second_confirmation']) ||
      empty($row['emergency_contact_person']) ||
      empty($row['emergency_contact_number']) ||
      empty($row['emergency_contact_address']) ||
      $row['confirmation'] !== 'Confirmed' ||
      $row['second_confirmation'] !== 'Confirmed' ||
      empty($row['signed_contract']) ||
      $row['signed_contract'] !== 'Yes' ||
      empty($row['date_endorsed']) ||
      $row['date_endorsed'] !== '0000-00-00'
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
  <?php include 'includes/edit_endorsement_modal.php'; ?>
   <?php include 'includes/send_endorsement_confirmation_modal.php'; ?>













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
  'Present': 'badge-color-21',
  'JO Accepted': 'badge-color-22',
  'Endorsed to Training': 'badge-color-23',
  'Failed - Studying': 'badge-color-24',
  'Waiting for Graduation': 'badge-color-25',
  'Email Sent': 'badge-color-26',
  'Withdrawn - Low Salary': 'badge-color-27',
  'Withdrawn - HMO': 'badge-color-28',
  'Withdrawn - Personal Reason': 'badge-color-29',
  'Pending': 'badge-color-30'
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






$('#editModalTitle').text(data.name || 'Edit Record');

  // Source Info
  $('#edit_source_id').val(data.source_id);
  $('#edit_source_date').val(data.source_date);
  
 

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

// Endorsement Info
  $('#edit_shift').val(data.shift || '');
  $('#edit_facilitator').val(data.facilitator || '');
  $('#edit_confirmation').val(data.confirmation || '');
  $('#edit_second_confirmation').val(data.second_confirmation || '');
  $('#edit_emergency_contact_person').val(data.emergency_contact_person || '');
  $('#edit_emergency_contact_number').val(data.emergency_contact_number || '');
  $('#edit_emergency_contact_address').val(data.emergency_contact_address || '');
  $('#edit_signed_contract').val(data.signed_contract || '');



 



  // Show modal
  $('#editModal').modal('show');



  





});





$('#editForm').on('submit', function (e) {
  e.preventDefault();

  // 1) show loader overlay
  $('#globalLoader').show();

  // 2) disable modal buttons so they can't close it
  $('#editCancelBtn, #editSaveBtn').prop('disabled', true);
  $('#editModal .btn-close').prop('disabled', true);

  const formData = $(this).serialize();
  const sourceId = $('#edit_source_id').val();

  $.ajax({
    type: 'POST',
    url: 'update_endorsement.php',
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
      url: 'get_endorsement_single_record.php',
      type: 'GET',
      data: { id: sourceId },
      dataType: 'json',
      success: function (data) {
        const table = $('#mergedTable').DataTable();
       const canCheck = (
  data.shift &&
  data.facilitator &&
  data.confirmation &&
  data.second_confirmation &&
  data.emergency_contact_person &&
  data.emergency_contact_number &&
  data.emergency_contact_address &&
  data.confirmation === 'Confirmed' &&
  data.second_confirmation === 'Confirmed' &&
  data.date_endorsed &&
  data.signed_contract &&
  data.signed_contract === 'Yes' &&
  data.date_endorsed == '0000-00-00'
);

   const checkboxCell = `
    <input
      type="checkbox"
      class="row-checkbox"
      value="${data.source_id}"
      ${canCheck ? '' : 'disabled'}
    >
  `;
        table.row(currentRow).data([
          data.source_id,
          data.source_date,
          data.name,
          data.shift,
          data.facilitator,
          data.confirmation,
          data.second_confirmation,
          data.emergency_contact_person,
          data.emergency_contact_number,
          data.emergency_contact_address,
         data.signed_contract === 'Yes'
  ? '<span class="badge bg-success">Yes</span>'
  : data.signed_contract === 'No'
    ? '<span class="badge bg-danger">No</span>'
    : '',

          data.date_endorsed,
          `<div class="d-flex gap-1">
             <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
                     data-id='${JSON.stringify(data)}'>
               <i class="fa fa-edit"></i>
             </button>
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
        Please select at least one applicant.
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
    url: 'send_endorsement.php',
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
        url: 'get_endorsement_single_record.php',
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
  data.shift &&
  data.facilitator &&
  data.confirmation &&
  data.second_confirmation &&
  data.emergency_contact_person &&
  data.emergency_contact_number &&
  data.emergency_contact_address &&
  data.confirmation === 'Confirmed' &&
  data.second_confirmation === 'Confirmed' &&
  data.signed_contract &&
  data.signed_contract === 'Yes' &&
  data.date_endorsed &&
  data.date_endorsed == '0000-00-00'
);
        const checkboxCell = `
    <input
      type="checkbox"
      class="row-checkbox"
      value="${data.source_id}"
      ${canCheck ? '' : 'disabled'}
    >
  `;
       

        row.data([
         data.source_id,
          data.source_date,
          data.name,
          data.shift,
          data.facilitator,
          data.confirmation,
          data.second_confirmation,
          data.emergency_contact_person,
          data.emergency_contact_number,
          data.emergency_contact_address,
          data.signed_contract === 'Yes'
  ? '<span class="badge bg-success">Yes</span>'
  : data.signed_contract === 'No'
    ? '<span class="badge bg-danger">No</span>'
    : '',
          data.date_endorsed,
          `<div class="d-flex gap-1">
             <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;"
                     data-id='${JSON.stringify(data)}'>
               <i class="fa fa-edit"></i>
             </button>
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


