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
          <h4 class="mb-0" style="color: #0e1e40; font-weight: 700;">Recruitment</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
             <li class="breadcrumb-item">
              <a href="dashboard.php" style="text-decoration: none; color: #f36523; font-weight: bold; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-home" style="color: #f36523;"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #0e1e40; font-weight: 600;">Recruitment</li>
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
$sql = "SELECT 
          s.*, 
          p.personal_info_id, p.name, p.phone, p.age, p.birthdate, p.email, p.address,
          p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended
        FROM source s
        LEFT JOIN personal_info p ON s.source_id = p.source_id
        WHERE s.deleted = 0
        ORDER BY s.source_id DESC";


$query = $conn->query($sql);
$rows = [];
while ($row = $query->fetch_assoc()) {
  $rows[] = $row;
}
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
  'Withdrawn - Personal Reason' => 'badge-color-29'
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
  data-bs-target="#addModal"
  onmouseover="this.style.backgroundColor='#0e1e40'; this.style.color='white';"
  onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#0e1e40';">
  + New
</button>
<!-- End: + New Button with Inline Hover Effect -->
            </div>



            <div class="card-body">
                <div class="datatable-wrapper">
                  
  <table id="mergedTable" class="table table-hover align-left text-nowrap shadow-sm rounded-3 mb-0" style="width:100%; border-collapse: separate; border-spacing: 0;">

    <thead class="table-light">
      <tr>
        <th>Source No.</th>
        <th>Mode</th>
        <th>Date</th>
        <th>Source</th>
        <th>Referrer</th>
        <th>Sourced By</th>
        <th>Recruiter</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Scheduled Interview</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $row['source_id'] ?></td>
          <td><?= $row['mode'] ?></td>
          <td><?= $row['source_date'] ?></td>
          <td><span class="badge <?= getFixedColorClass($row['source'], $sourceColorMap) ?>"><?= strtoupper($row['source']) ?></span></td>
          <td><?= $row['referrer'] ?></td>
          <td><?= $row['source_by'] ?></td>
          <td><?= $row['recruiter'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['phone'] ?></td>
          <td><?= $row['scheduled_interview'] ?></td>
          <td><span class="badge <?= getFixedColorClass($row['status'], $statusColorMap) ?>"><?= strtoupper($row['status']) ?></span></td>
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



<!-- Global Delete Modal -->
<!-- Global Delete Modal -->
<div class="modal fade" id="globalDeleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header" style="background-color: #0e1e40;">
        <h5 class="modal-title fw-bold text-white">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
     <div class="modal-body fw-semibold" style="color: #0e1e40;">
      Are you sure you want to delete Source ID: 
        <strong id="deleteSourceIdDisplay" style="color: #0e1e40;"></strong>?
      </div>
      <div class="modal-footer">
        <form id="deleteForm">
          <input type="hidden" name="id" id="deleteSourceIdInput">
          <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
         <!-- Start: Delete Button with Hover Effect via JS -->
<button type="submit"
  class="btn btn-danger fw-bold text-white"
  style="background-color: #f36523;"
  onmouseover="this.style.backgroundColor='#d14e10';"
  onmouseout="this.style.backgroundColor='#f36523';">
  Delete
</button>
<!-- End: Delete Button with Hover Effect via JS -->

        </form>
      </div>
    </div>
  </div>
</div>









            </div>
          </div>
        </section>

</div>

        <footer class="bg-light border-top text-center py-0 flex-shrink-0">
        <?php include 'includes/footer.php'; ?>
      </footer>

<!-- Edit Modal -->
  <?php include 'includes/edit_source_modal.php'; ?>



<!-- Add Record Modal -->
<?php include 'includes/add_source_modal.php'; ?>
 <!-- Main Content -->








<script>
  const currentSource = <?= json_encode($user['name']); ?>;
  const currentSourceusername = <?= json_encode($user['username']); ?>;
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
  'Withdrawn - Personal Reason': 'badge-color-29'
};

function getFixedColorClass(value, map) {
  return map[value] || 'badge-color-default';
}



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



$('#addForm').on('submit', function (e) {
  e.preventDefault();

  const formData = $(this).serialize();

  $.ajax({
    type: 'POST',
    url: 'add_source.php',
    data: formData,
    dataType: 'json',
    success: function (response) {
      if (response.status === 'success') {
        $('#alertContainer').html(`
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check me-2"></i><strong>Success:</strong> ${response.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `);

      

        // Fetch full new data and add row to table
        $.ajax({
          url: 'get_source_single_record.php',
          type: 'GET',
          data: { id: response.source_id },
          dataType: 'json',
          success: function (data) {
            const table = $('#mergedTable').DataTable();

            table.row.add([
              data.source_id,
              data.mode,
              data.source_date,
              `<span class="badge ${getFixedColorClass(data.source, sourceColorMap)}">${data.source.toUpperCase()}</span>`,
              data.referrer || '',
              data.source_by,
              data.recruiter,
              data.name,
              data.phone,
              data.scheduled_interview || '',
              `<span class="badge ${getFixedColorClass(data.status, statusColorMap)}">${data.status.toUpperCase()}</span>`,
              `<div class="d-flex gap-1">
                <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;" data-id='${JSON.stringify(data)}'>
                  <i class="fa fa-edit"></i>
                </button>
               
              </div>`
            ]).draw(false);


          }
        });

          $('#addModal').modal('hide');
        $('#addForm')[0].reset();
      } else {
        $('#alertContainer').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-warning me-2"></i><strong>Error:</strong> ${response.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `);
      }
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






  $('#mergedTable').on('click', '.deleteBtn', function () {
     const $row = $(this).closest('tr');

  // 2) pull the “Sourced By” text (column index 5, zero-based)
  const sourceBy = $row.find('td').eq(5).text().trim();

  // 3) compare to currentSource
  if (sourceBy !== currentSource) {
    $('#alertContainer').html(`
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle me-2"></i>
        You’re not the sourcer for this record.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
    return;
  }
    const sourceId = $(this).data('id');
    $('#deleteSourceIdDisplay').text(sourceId);
    $('#deleteSourceIdInput').val(sourceId);
    $('#globalDeleteModal').modal('show');
  });


  

  // AJAX delete form submit
 $('#deleteForm').on('submit', function (e) {
  e.preventDefault();
  const sourceId = $('#deleteSourceIdInput').val();

  $.ajax({
    url: 'delete_source.php',
    method: 'POST',
    data: { id: sourceId },
    dataType: 'json',
    success: function (response) {
      if (response.status === 'success') {
        const table = $('#mergedTable').DataTable();
        const row = $(`.deleteBtn[data-id="${sourceId}"]`).closest('tr');
        table.row(row).remove().draw();

        $('#globalDeleteModal').modal('hide');

        // Insert success alert
        const alertHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check me-2"></i><strong>Success:</strong> ${response.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        $('#alertContainer').html(alertHTML);
      } else {
        // Insert error alert
        const alertHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-warning me-2"></i><strong>Error:</strong> ${response.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        $('#alertContainer').html(alertHTML);
      }
    },
    error: function () {
      const alertHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-warning me-2"></i><strong>Error:</strong> An error occurred while deleting the record.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
      $('#alertContainer').html(alertHTML);
    }
  });
}); 
let currentRow = null;


$('#mergedTable').on('click', '.editBtn', function () { 
   currentRow = $(this).closest('tr'); // 🔧 Store the current table row
  const data = $(this).data('id'); // JSON-parsed row data
 if (!currentSourceusername.toLowerCase().startsWith('source')) {
    $('#alertContainer').html(`
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa fa-lock me-2"></i>
        Only users in the “source” group can edit source records.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
    return;
  }

  // 2) Even if you’re a source user, you can only delete your own records
  if (data.source_by !== currentSource) {
    $('#alertContainer').html(`
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle me-2"></i>
        You’re not the sourcer for this record.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `);
    return;
  }




$('#editModalTitle').text(data.name || 'Edit Record');

  // Source Info
  $('#edit_source_id').val(data.source_id);
  $('#edit_mode').val(data.mode);
  $('#edit_source_date').val(data.source_date);
  $('#edit_source').val(data.source);
  $('#edit_referrer').val(data.referrer);
  $('#edit_source_by').val(data.source_by);
  $('#edit_recruiter').val(data.recruiter);
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

  



  // Show modal
  $('#editModal').modal('show');



  





});

$('#editModal').on('shown.bs.modal', function () {
  // Force the "Source Info" tab to show (the one with #sourceTab as target)
  const sourceTab = new bootstrap.Tab(document.querySelector('[data-bs-target="#sourceTab"]'));
  sourceTab.show();
});





$('#editForm').on('submit', function (e) {
  e.preventDefault();



  const formData = $(this).serialize();
  const sourceId = $('#edit_source_id').val();

  $.ajax({
    type: 'POST',
    url: 'update_source.php',
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
        url: 'get_source_single_record.php',
        type: 'GET',
        data: { id: sourceId },
        dataType: 'json',
        success: function (data) {
          const table = $('#mergedTable').DataTable();

          // ✅ Step 3: Update DataTable row
          table.row(currentRow).data([
            data.source_id,
            data.mode,
            data.source_date,
          `<span class="badge ${getFixedColorClass(data.source, sourceColorMap)}">${data.source.toUpperCase()}</span>`,
            data.referrer || '',
            data.source_by,
            data.recruiter,
            data.name,
            data.phone,
            data.scheduled_interview || '',
          `<span class="badge ${getFixedColorClass(data.status, statusColorMap)}">${data.status.toUpperCase()}</span>`,
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






setInterval(() => {
  $.ajax({
    url: 'real_time_source_record.php',
    type: 'GET',
    data: { after: latestSourceId },
    dataType: 'json',
    success: function (changes) {
      const table = $('#mergedTable').DataTable();

      changes.forEach(row => {
        latestSourceId = Math.max(latestSourceId, parseInt(row.source_id, 10));

        // Soft-deletion handling
        if (row.deleted === "1" || row.deleted === 1) {
          // find ANY matching row (visible or filtered)
          const delRow = table.row(function(idx, data) {
            return parseInt(data[0], 10) === parseInt(row.source_id, 10);
          });
          if (delRow.node()) {
            table.row(delRow).remove().draw(false);
          }
          return;
        }

        // Build action buttons
        const actionsHTML = `
          <div class="d-flex gap-1">
            <button class="btn btn-sm editBtn" style="background-color: #0e1e40; color: #ffffff;" data-id='${JSON.stringify(row)}'>
              <i class="fa fa-edit"></i>
            </button>
           
          </div>`;

        // New row data array
        const newRowData = [
          row.source_id,
          row.mode,
          row.source_date,
          `<span class="badge ${getFixedColorClass(row.source, sourceColorMap)}">${row.source.toUpperCase()}</span>`,
          row.referrer || '',
          row.source_by,
          row.recruiter,
          row.name,
          row.phone,
          row.scheduled_interview || '',
          `<span class="badge ${getFixedColorClass(row.status, statusColorMap)}">${row.status.toUpperCase()}</span>`,
          actionsHTML
        ];

        // → DataTables-aware lookup:
        const dtRow = table.row(function(idx, data) {
          // data[0] is the ID column
          return parseInt(data[0], 10) === parseInt(row.source_id, 10);
        });

        if (dtRow.node()) {
          // already exists (possibly filtered out) → update it
          dtRow.data(newRowData).draw(false);
        } else {
          // brand-new → insert it
          table.row.add(newRowData).draw(false);
        }
      });
    }
  });
}, 5000); // every 5 seconds







// Auto-fade and slide up after 3 seconds
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


