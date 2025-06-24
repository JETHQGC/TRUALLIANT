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
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detailsTab" type="button" role="tab"
        style="color: #0e1e40; font-weight: 600;  background-color: transparent;">
        Details
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#interviewTab" type="button" role="tab"
        style="color: #0e1e40; font-weight: 600; border-bottom: 3px solid transparent; background-color: transparent;">
        Assessment
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
  <div class="row g-3"><!-- g-3 = tighter row gap -->

    <!-- Endorsement Information -->
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header py-2 px-3" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white" style="font-size: 14px; font-weight: 600; letter-spacing: 0.3px;">
            Endorsement Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body p-3 pt-2">
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">ID</label>
            <input type="text" readonly class="form-control form-control-sm fw-bold" value="21">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Endorsement ID</label>
            <input type="text" readonly class="form-control form-control-sm fw-bold" value="13">
          </div>
          <div class="mb-1">
            <label class="form-label mb-1 text-muted">Endorsement Date</label>
            <input type="text" readonly class="form-control form-control-sm fw-bold" value="2025-06-15">
          </div>
        </div>
      </div>
    </div>

    <!-- Personal Information -->
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header py-2 px-3" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white" style="font-size: 14px; font-weight: 600; letter-spacing: 0.3px;">
            Personal Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body p-3 pt-2">
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Name</label>
            <input type="text" readonly class="form-control form-control-sm fw-bold" value="Reynor Merzo">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Phone</label>
            <input type="text" readonly class="form-control form-control-sm" value="09391234567">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Age</label>
            <input type="text" readonly class="form-control form-control-sm" value="22">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Birthdate</label>
            <input type="text" readonly class="form-control form-control-sm" value="2025-06-11">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Email</label>
            <input type="text" readonly class="form-control form-control-sm" value="reynormerzo.qgc@">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Address</label>
            <input type="text" readonly class="form-control form-control-sm" value="Oton">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">City / Municipality</label>
            <input type="text" readonly class="form-control form-control-sm" value="Iloilo City">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">Education</label>
            <input type="text" readonly class="form-control form-control-sm" value="Not Qualified">
          </div>
          <div class="mb-2">
            <label class="form-label mb-1 text-muted">School</label>
            <input type="text" readonly class="form-control form-control-sm" value="WVSU">
          </div>
          <div class="mb-1">
            <label class="form-label mb-1 text-muted">Year Last Attended</label>
            <input type="text" readonly class="form-control form-control-sm" value="2019">
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
  <!-- Assessment Section Header -->
  <div class="px-3 py-2 mb-3" style="background-color: #f0f2f7; border-radius: 6px;">
    <h6 class="mb-0 fw-bold text-dark" style="color: #0e1e40;">Assessment</h6>
  </div>

  <div class="row gx-3 gy-2">

    <style>
      .form-horizontal-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .form-horizontal-row label {
        flex: 0 0 120px;
        margin-bottom: 0;
        font-size: 0.82rem;
        font-weight: 600;
        color: #0e1e40;
      }
      .form-horizontal-row input {
        flex: 1;
        font-size: 0.82rem;
      }
    </style>
    <!-- Comprehension -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Comprehension</strong></label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_comprehension" name="comprehension">
    </div>
    <!-- Pronunciation -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Pronunciation</strong></label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_pronunciation" name="pronunciation">
    </div>
    <!-- Active Listening -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Active Listening</strong></label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_active_listening" name="active_listening">
    </div>
    <!-- Diction -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Diction</strong></label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_diction" name="diction">
    </div>
    <!-- Intonation -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Intonation</strong></label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_intonation" name="intonation">
    </div>
    <!-- Typing Test -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Typing Test</strong></label>
      <input type="number" min="0" max="100" class="form-control" id="edit_typing_test" name="typing_test">
    </div>
    <!-- Script Reading -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Script Reading</strong></label>
      <input type="number" min="0" max="5" class="form-control score-field" id="edit_script_reading" name="script_reading">
    </div>
    <!-- Link -->
    <div class="col-md-6 mb-3">
      <label class="form-label"><strong>Link</strong></label>
      <input type="url" class="form-control" id="edit_link" name="link">
    </div>
    <!-- Total Score (read-only) -->
    <!-- Total Score (read-only numeric) -->
<div class="col-md-6 mb-3">
  <label class="form-label"><strong>Total Score</strong></label>
<input type="text" class="form-control fw-bold" name="total_score" id="total_score" readonly>
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
