<?php
include 'includes/recruiter_names.php';
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
                Assessment
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
    <!-- Source Info Panel -->
    <div class="col-md-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-light py-2">
          <h6 class="mb-0">Source Info</h6>
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

            <dt class="col-sm-4 text-muted">Sourced By</dt>
            <dd class="col-sm-8">
              <input readonly type="text" class="form-control-plaintext" id="edit_source_by" name="source_by">
            </dd>

            

          </dl>
        </div>
      </div>
    </div>

    <!-- Personal Info Panel -->
    <div class="col-md-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-light py-2">
          <h6 class="mb-0">Personal Info</h6>
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
  <h6 class="small text-secondary mb-3">Assessment</h6>
  <div class="row gx-3">

    <!-- Comprehension -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Comprehension</label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_comprehension" name="comprehension" required>
    </div>

    <!-- Pronunciation -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Pronunciation</label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_pronunciation" name="pronunciation" required>
    </div>

    <!-- Active Listening -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Active Listening</label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_active_listening" name="active_listening" required>
    </div>

    <!-- Diction -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Diction</label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_diction" name="diction" required>
    </div>

    <!-- Intonation -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Intonation</label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_intonation" name="intonation" required>
    </div>

    <!-- Typing Test -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Typing Test</label>
      <input type="number" min="0" max="100" class="form-control" id="edit_typing_test" name="typing_test" required>
    </div>

    <!-- Script Reading -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Script Reading</label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_script_reading" name="script_reading" required>
    </div>

    <!-- Link -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Script Reading Link</label>
      <input type="url" class="form-control" id="edit_link" name="link" required>
    </div>

    <!-- Total Score (read-only) -->
    <div class="col-md-6 mb-3">
      <label class="form-label">Total Score</label>
      <input type="text" class="form-control fw-bold" name="total_score" id="total_score" readonly>
    </div>

  </div>
</div>



          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>

      </div>
    </form>
  </div>
</div>
