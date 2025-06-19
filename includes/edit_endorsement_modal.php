<?php
include 'includes/conn.php';
  $recruiters = [];
  $tr = $conn->query("SELECT username, name FROM user WHERE username LIKE 'trainer%' ORDER BY name");
  while ($t = $tr->fetch_assoc()) {
      $trainers[] = $t;
  }
?>

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
          <ul class="nav nav-tabs mb-4" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detailsTab" type="button" role="tab">
                Details
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#interviewTab" type="button" role="tab">
                Endorsement
              </button>
            </li>
          </ul>

          <div class="tab-content">
         <style>
     /* Colon after dt */
      #detailsTab dt::after {
        content: ":";
        margin-right: 0.25rem;
        color: #666;
      }

</style>

<!-- DETAILS TAB -->
<div class="tab-pane fade show active" id="detailsTab" role="tabpanel">
  <div class="row gx-4">
    <!-- Source Info Panel -->
 <div class="col-md-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
           <div class="card-header py-2" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
      <h6 class="mb-0 text-white" style="font-weight: 600; letter-spacing: 0.3px;">
        Source Information
        <span style="color: #f36523;">●</span>
      </h6>
    </div>
        <div class="card-body">
          <dl class="row mb-0" id="detailsTab">
            <dt class="col-sm-4 text-muted">ID</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext fw-bold" id="edit_source_id" name="source_id">
            </dd>

                        <dt class="col-sm-4 text-muted">Source Date</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext fw-bold" id="edit_source_date" name="source_date">
            </dd>


            

          </dl>
        </div>
      </div>
    </div>

    <!-- Personal Info Panel -->
     <div class="col-md-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
          <div class="card-header py-2" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
      <h6 class="mb-0 text-white" style="font-weight: 600; letter-spacing: 0.3px;">
        Personal Information
        <span style="color: #f36523;">●</span>
      </h6>
    </div>
        <div class="card-body">
          <dl class="row mb-0" id="detailsTab">
            <dt class="col-sm-4 text-muted">Name</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext fw-bold" id="edit_name" name="name">
            </dd>

            <dt class="col-sm-4 text-muted">Phone</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_phone" name="phone">
            </dd>

            <dt class="col-sm-4 text-muted">Age</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_age" name="age">
            </dd>

            <dt class="col-sm-4 text-muted">Birthdate</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_birthdate" name="birthdate">
            </dd>

            <dt class="col-sm-4 text-muted">Email</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_email" name="email">
            </dd>

            <dt class="col-sm-4 text-muted">Address</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_address" name="address">
            </dd>

            <dt class="col-sm-4 text-muted">City / Municipality</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_city_municipality" name="city_municipality">
            </dd>

            <dt class="col-sm-4 text-muted">Education</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_educational_attainment" name="educational_attainment">
            </dd>

            <dt class="col-sm-4 text-muted">School</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_name_of_school" name="name_of_school">
            </dd>

            <dt class="col-sm-4 text-muted">Year Last Attended</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_year_last_attended" name="year_last_attended">
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</div>



            <!-- INTERVIEW TAB -->
           <!-- INTERVIEW TAB -->
<!-- ASSESSMENT TAB -->
<div class="tab-pane fade" id="interviewTab" role="tabpanel">
  <h6 class="small text-secondary mb-3">Orientation</h6>
  <div class="row gx-3">


     <div class="col-md-6 mb-3">
  <label class="form-label">Shift</label>
  <select class="form-select" id="edit_shift" name="shift" required>
    <option value="">Select...</option>
    <option value="Day">Day</option>
    <option value="Night">Night</option>
  </select>
</div>

    <div class="col-md-6 mb-3">
      <label class="form-label">Facilitator</label>
      <select class="form-control" id="edit_facilitator" name="facilitator">
    <option value="">-- Select Trainer --</option>
    <?php foreach ($trainers as $tra): ?>
      <option value="<?= htmlspecialchars($tra['name']) ?>">
        <?= htmlspecialchars($tra['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>




    <div class="col-md-6 mb-3">
      <label class="form-label">Confirmation</label>
      <select class="form-select" id="edit_confirmation" name="confirmation">
        <option value="" disabled selected>Select Confirmation</option>
        <option value="Confirmed">Confirmed</option>
        <option value="Not Confirmed">Not Confirmed</option>
      </select>
</div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Second Confirmation</label>
      <select class="form-select" id="edit_second_confirmation" name="second_confirmation">
        <option value="" disabled selected>Select Second Confirmation</option>
        <option value="Confirmed">Confirmed</option>
        <option value="Not Confirmed">Not Confirmed</option>
      </select>
</div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Emergency Contact Person</label>
      <input type="text" class="form-control" id="edit_emergency_contact_person" name="emergency_contact_person">
</div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Emergency Contact Number</label>
      <input type="text" class="form-control" id="edit_emergency_contact_number" name="emergency_contact_number">
</div>
    <div class="col-md-6 mb-3">
      <label class="form-label  ">Emergency Contact Address</label>
      <input type="text" class="form-control" id="edit_emergency_contact_address" name="emergency_contact_address">
</div>

   <div class="col-md-6 mb-3">
      <label class="form-label">Signed Contract</label>
      <select class="form-select" id="edit_signed_contract" name="signed_contract">
        <option value="" disabled selected>Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
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
