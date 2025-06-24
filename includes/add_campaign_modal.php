

<div class="modal fade" id="addCampaignModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="addForm">
      <div class="modal-content border-0 shadow-sm rounded-3">
        <div class="modal-header" style="background-color: #0e1e40;">
          <h5 class="modal-title fw-bold text-white">Transfer Employee</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">

          <!-- Employee Section -->
          <h6 class="text-primary fw-semibold mb-3">Employee Details</h6>
          <div class="row g-3 align-items-start">
            <div class="col-md-12 d-flex">
              <label class="w-25 text-end pe-3 pt-2">Employee <span class="text-danger">*</span></label>
              <select class="form-control select2" name="employee_id" id="employeeDropdown" required>
                <option value="">-- Select Employee --</option>
                <?php foreach ($employees as $emp): ?>
                  <option 
                    value="<?= $emp['id'] ?>"
                    data-empid="<?= htmlspecialchars($emp['emp_id']) ?>"
                    data-position="<?= htmlspecialchars($emp['position']) ?>"
                    data-status="<?= htmlspecialchars($emp['emp_status']) ?>"
                    data-campaign="<?= htmlspecialchars($emp['latest_campaign']) ?>"
                    data-date="<?= htmlspecialchars($emp['latest_assigned_date']) ?>"
                  >
                    <?= htmlspecialchars($emp['employee_name']) ?> (<?= htmlspecialchars($emp['emp_id']) ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-12 mt-3" id="infoCard" style="display: none;">
              <div class="border rounded bg-light p-3">
                <div class="row text-center text-md-start g-3">
                  <div class="col-md-3">
                    <small class="text-muted">Agent ID</small>
                    <div id="infoEmpId" class="fw-semibold">—</div>
                  </div>
                  <div class="col-md-3">
                    <small class="text-muted">Current Status</small>
                    <div id="infoStatus" class="fw-semibold text-success">—</div>
                  </div>
                  <div class="col-md-3">
                    <small class="text-muted">Current Campaign</small>
                    <div id="infoCampaign" class="fw-semibold">—</div>
                  </div>
                  <div class="col-md-3">
                    <small class="text-muted">Deployment Date</small>
                    <div id="infoDate" class="fw-semibold">—</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-4">

          <!-- Source Info -->
          <h6 class="text-primary fw-semibold mb-3">Source Info</h6>
          <div class="row g-3">

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Assigned Date <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="assigned_date" required>
            </div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Recommendation <span class="text-danger">*</span></label>
              <select class="form-control" name="recommendation" required>
                <option value="">-- Select Recommendation --</option>
                <option value="Endorsed to Deployment">Endorsed to Deployment</option>
                <option value="Endorsed to HR">Endorsed to HR</option>
                <option value="EOC">EOC</option>
              </select>
            </div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Campaign <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="campaign" required>
            </div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Cluster <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="cluster" required>
            </div>

            <div class="col-md-12 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Removal Reason</label>
              <select class="form-control" name="removal_reason">
                <option value="">-- For transferred or removed candidates only --</option>
                <option value="Poor Performance">Poor Performance</option>
                <option value="Attendance">Attendance</option>
                <option value="Client Escalation">Client Escalation</option>
                <option value="Campaign Reduction">Campaign Reduction</option>
                <option value="Campaign Pause">Campaign Pause</option>
                <option value="Behavioral Issue">Behavioral Issue</option>
              </select>
            </div>

          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
          <button type="submit"
            class="btn fw-bold text-white px-4"
            style="background-color: #0e1e40; border: none; transition: background-color 0.3s ease;"
            onmouseover="this.style.backgroundColor='#f36523';"
            onmouseout="this.style.backgroundColor='#0e1e40';">
            Submit
          </button>
        </div>

      </div>
    </form>
  </div>
</div>

<script>
let lastEditedEmployeeId = null; // set this from outside if needed

$(document).ready(function () {
  $('.select2').select2({
    dropdownParent: $('#addCampaignModal')
  });

  $('#addCampaignModal').on('shown.bs.modal', function () {
    $.ajax({
      url: 'get_active_employees.php',
      type: 'GET',
      dataType: 'json',
      success: function (employees) {
        const $dropdown = $('#employeeDropdown');
        $dropdown.empty().append('<option value="">-- Select Employee --</option>');

        employees.forEach(emp => {
          const option = $('<option>')
            .val(emp.id)
            .attr('data-empid', emp.emp_id)
            .attr('data-position', emp.position)
            .attr('data-status', emp.emp_status)
            .attr('data-campaign', emp.latest_campaign)
            .attr('data-date', emp.latest_assigned_date)
            .text(`${emp.employee_name} (${emp.emp_id})`);

          $dropdown.append(option);
        });

        if (lastEditedEmployeeId) {
          $dropdown.val(lastEditedEmployeeId).trigger('change');
        }

        $dropdown.trigger('change'); // refresh Select2
      }
    });
  });

  $('#employeeDropdown').on('change', function () {
    const selected = $(this).find(':selected');
    const empId = selected.data('empid') || '—';
    const status = selected.data('status') || '—';
    const campaign = selected.data('campaign') || '—';
   const rawDate = selected.data('date') || '—';
$('#infoDate').text(rawDate !== '—' ? rawDate : '—');


    $('#infoEmpId').text(empId);
    $('#infoStatus').text(status);
    $('#infoCampaign').text(campaign);
    $('#infoDate').text(rawDate !== '—' ? rawDate : '—');

    $('#infoCard').show();
  });
});
</script>

