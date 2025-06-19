

<!-- Edit / Interview Modal -->
<div class="modal fade"
     id="editModal"
     tabindex="-1"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <form id="editForm" method="POST">
      <div class="modal-content border-0 shadow-sm rounded-3">

        <!-- Modal Header -->
        <div class="modal-header border-bottom-0 d-flex flex-column align-items-start gap-2" style="background-color: #0e1e40;">
          <!-- Candidate Name (will be injected via JS) -->
          <h5 class="modal-title fw-semibold m-0" id="editModalTitle">&nbsp;</h5>

        

          <!-- Close button -->
          <button type="button"
                  class="btn-close btn-close-white position-absolute end-0 top-0 m-3"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Tabs -->
     <!-- Tabs -->
          <ul class="nav nav-tabs mb-4" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detailsTab" type="button" role="tab"
                style="color: #0e1e40; font-weight: 600;  background-color: transparent;">
                Details
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#interviewTab" type="button" role="tab"
                style="color: #0e1e40; font-weight: 600; border-bottom: 3px solid transparent; background-color: transparent;">
                Training
              </button>
            </li>
          </ul>

          <div class="tab-content">
         <style>
  /* Add this to your page (e.g. in your <head> or a linked stylesheet) */
  #detailsTab dt::after {
    content: ":";
    margin-right: 0.25rem;
    color: #666;
  }
   
</style>

<!-- DETAILS TAB -->
<div class="tab-pane fade show active" id="detailsTab" role="tabpanel">
  <div class="row gx-4">

    <!-- Endorsement Information -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header py-2" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white fw-semibold">
            Endorsement Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label text-muted">ID</label>
            <input readonly type="text" class="form-control fw-bold" id="edit_source_id" name="source_id">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted">Endorsement ID</label>
            <input readonly type="text" class="form-control fw-bold" id="edit_endorsement_id" name="endorsement_id">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted">Endorsement Date</label>
            <input readonly type="text" class="form-control fw-bold" id="edit_date_endorsed" name="date_endorsed">
          </div>
        </div>
      </div>
    </div>

    <!-- Personal Information -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header py-2" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white fw-semibold">
            Personal Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
            <label class="form-label text-muted">Name</label>
            <input readonly type="text" class="form-control fw-bold" id="edit_name" name="name" style="font-size: 0.81rem;">
          </div>

            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Phone</label>
              <input readonly type="text" class="form-control" id="edit_phone" name="phone">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Age</label>
              <input readonly type="text" class="form-control" id="edit_age" name="age">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Birthdate</label>
              <input readonly type="text" class="form-control" id="edit_birthdate" name="birthdate">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Email</label>
              <input readonly type="text" class="form-control" id="edit_email" name="email"  style="font-size: 0.81rem;">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Address</label>
              <input readonly type="text" class="form-control" id="edit_address" name="address">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">City / Municipality</label>
              <input readonly type="text" class="form-control" id="edit_city_municipality" name="city_municipality">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Education</label>
              <input readonly type="text" class="form-control" id="edit_educational_attainment" name="educational_attainment">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">School</label>
              <input readonly type="text" class="form-control" id="edit_name_of_school" name="name_of_school">
            </div>
            <div class="col-md-6 mb-0">
              <label class="form-label text-muted">Year Last Attended</label>
              <input readonly type="text" class="form-control" id="edit_year_last_attended" name="year_last_attended">
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>



            <!-- INTERVIEW TAB -->
           <!-- INTERVIEW TAB -->
<!-- ASSESSMENT TAB -->
<div class="tab-pane fade" id="interviewTab" role="tabpanel">
  <h6 class="small text-secondary mb-3">Training</h6>
  <div class="row gx-3">


      <div class="col-md-6 mb-3">
      <label class="form-label">Batch</label>
      <input type="datetime-local"
             class="form-control"
             id="edit_batch"
             name="batch"
             placeholder="YYYY-MM-DD">
    </div>



    <div class="col-md-6 mb-3">
      <label class="form-label">Trainer</label>
      <input type="text" class="form-control" id="edit_trainer" name="trainer">
</div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Day 1 Attendance</label>
      <select class="form-select" id="edit_attendance" name="attendance">
        <option value="">Select...</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
</div>
   
    <div class="col-md-6 mb-3">
      <label class="form-label">Credential</label>
      <input type="text" class="form-control" id="edit_credential" name="credential">
</div>
    <!-- Trainee Status Dropdown -->
<div class="col-md-6 mb-3">
  <label class="form-label">Trainee Status</label>
  <select class="form-select" id="edit_trainee_status" name="trainee_status">
    <!-- Training Termination Reasons -->
        <option value="Email Sent">Email Sent</option>
      <option value="No Show Day 1 - Endorsed to Recruitment">No Show Day 1 - Endorsed to Recruitment</option>
    <option value="Terminated - Training Absences">Terminated - Training Absences</option>
    <option value="Terminated - Trainee Poor Performance">Terminated - Trainee Poor Performance</option>
    <option value="Terminated - Resigned">Terminated - Resigned</option>

    <!-- Nesting Termination Reasons -->
    <option value="Terminated - Nesting Absences">Terminated - Nesting Absences</option>
    <option value="Terminated - Nesting Poor Performance">Terminated - Nesting Poor Performance</option>

    <!-- Training Assignments -->
    <option value="Training - ADP">Training - ADP</option>

    <!-- Nesting Assignments -->
    <option value="AQ - Nesting">AQ - Nesting</option>
    <option value="Call Trader - Nesting">Call Trader - Nesting</option>
    <option value="GENX - Nesting">GENX - Nesting</option>
    <option value="WGL - Nesting">WGL - Nesting</option>
    <option value="Jade ACA Nesting">Jade ACA Nesting</option>
    <option value="ECX GH - Nesting">ECX GH - Nesting</option>
    <option value="ECX GHE - Nesting">ECX GHE - Nesting</option>
    <option value="ECX LM - Nesting">ECX LM - Nesting</option>
    <option value="Assurity - Nesting">Assurity - Nesting</option>
    <option value="Konnect Leads - Nesting">Konnect Leads - Nesting</option>

    <!-- Premium Programs -->
    <option value="Deployment Pool - Premium">Deployment Pool - Premium</option>
    <option value="Premium - Synergy">Premium - Synergy</option>
    <option value="Premium - Zinnia Health Intake">Premium - Zinnia Health Intake</option>
    <option value="Premium - Ramzey CS">Premium - Ramzey CS</option>
    <option value="Premium - Simpson">Premium - Simpson</option>
    <option value="Premium - We Level Up">Premium - We Level Up</option>
    <option value="Premium - Dan Fulfillment">Premium - Dan Fulfillment</option>
    <option value="Premium - Ryan Simpson Financial">Premium - Ryan Simpson Financial</option>

    <!-- Endorsements and Other Statuses -->
    <option value="Women's Society-Premium">Women's Society-Premium</option>
    <option value="Deployment Pool - T4">Deployment Pool - T4</option>
    <option value="Deployment Pool - VSS">Deployment Pool - VSS</option>
    <option value="Endorsed - Support">Endorsed - Support</option>
    <option value="Zeta PHARMA">Zeta PHARMA</option>
   
  </select>
</div>

    <div class="col-md-6 mb-3">
      <label class="form-label">Status Date</label>
      <input type="date"
             class="form-control"
             id="edit_status_date"
             name="status_date"
             placeholder="YYYY-MM-DD">
    </div>

  <div class="col-md-6 mb-3">
      <label class="form-label">Status Remarks</label>
      <input type="text" class="form-control" id="edit_remarks" name="remarks">
</div>


 
  </div>
</div>


          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
           <button type="submit" class="btn btn-primary" 
            style="background-color: #0e1e40; border-color: #0e1e40;" 
            onmouseover="this.style.backgroundColor='#f36523'; this.style.borderColor='#f36523';" 
            onmouseout="this.style.backgroundColor='#0e1e40'; this.style.borderColor='#0e1e40';">
            <strong>Save Changes</strong>
          </button>
        </div>

      </div>
    </form>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
  const batch = document.getElementById('edit_batch');
  const trainee = document.getElementById('edit_trainee_status');

  const trainingInputs = [
    document.getElementById('edit_trainer'),
    document.getElementById('edit_attendance'),
    document.getElementById('edit_trainee_status'),
    document.getElementById('edit_credential'),
    document.getElementById('edit_status_date'),
    document.getElementById('edit_remarks'),
  ];

  function updateTrainingInputs() {
    const batchBlank = !batch.value.trim();
    const traineeBlank = !trainee.value.trim();
    const disable = batchBlank || traineeBlank;
    trainingInputs.forEach(input => {
      if (input) input.disabled = disable;
    });
  }

  // Re-run when modal is shown (after form fields are populated)
  $('#editModal').on('shown.bs.modal', updateTrainingInputs);

  // Live update as user modifies values
  [batch, trainee].forEach(el => {
    el.addEventListener('input', updateTrainingInputs);
    el.addEventListener('change', updateTrainingInputs);
  });
});
</script>





