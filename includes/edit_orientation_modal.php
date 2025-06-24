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
                Orientation
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
  <div class="row gx-3">

    <!-- Source Info Panel -->
    <div class="col-md-6 mb-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header py-2 px-3" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white" style="font-size: 14px; font-weight: 600; letter-spacing: 0.3px;">
            Source Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body p-3 pt-2">
          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">ID</label>
            <input readonly type="text" class="form-control form-control-sm fw-bold" id="edit_source_id" name="source_id">
          </div>
          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Source Date</label>
            <input readonly type="text" class="form-control form-control-sm fw-bold" id="edit_source_date" name="source_date">
          </div>
        </div>
      </div>
    </div>

    <!-- Personal Info Panel -->
    <div class="col-md-6 mb-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header py-2 px-3" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white" style="font-size: 14px; font-weight: 600; letter-spacing: 0.3px;">
            Personal Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body p-3 pt-2">

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Name</label>
            <input readonly type="text" class="form-control form-control-sm fw-bold" id="edit_name" name="name">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Phone</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_phone" name="phone">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Age</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_age" name="age">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Birthdate</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_birthdate" name="birthdate">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Email</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_email" name="email">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Address</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_address" name="address">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">City / Municipality</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_city_municipality" name="city_municipality">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Education</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_educational_attainment" name="educational_attainment">
          </div>

          <div class="mb-2">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">School</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_name_of_school" name="name_of_school">
          </div>

          <div class="mb-1">
            <label class="form-label text-muted mb-1" style="font-size: 13px;">Year Last Attended</label>
            <input readonly type="text" class="form-control form-control-sm" id="edit_year_last_attended" name="year_last_attended">
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
  <h6 class="small text-secondary mb-3">Orientation</h6>
  <div class="row gx-3">


<div class="col-md-6 mb-3">
  <label class="form-label">Orientation Date</label>
  <input type="datetime-local"
         class="form-control"
         id="edit_orientation_date"
         name="orientation_date">
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
