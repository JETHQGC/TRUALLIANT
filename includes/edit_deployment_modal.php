

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
                Deployment
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

    <!-- Personal Information -->
    <div class="col-md-12 mb-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header py-2 px-3" style="background-color: #0e1e40; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
          <h6 class="mb-0 text-white fw-semibold" style="font-size: 14px;">
            Personal Information <span style="color: #f36523;">●</span>
          </h6>
        </div>
        <div class="card-body p-3 pt-2">
          <div class="row">

            <!-- Hidden ID Field -->
            <div class="col-md-6 mb-2" style="display: none;">
              <label class="form-label mb-1 text-muted" style="font-size: 13px;">ID</label>
              <input readonly type="text" class="form-control form-control-sm" id="edit_id" name="id">
            </div>

            <!-- Name -->
            <div class="col-md-6 mb-2">
              <label class="form-label mb-1 text-muted" style="font-size: 13px;">Name</label>
              <input readonly type="text" class="form-control form-control-sm fw-bold" id="edit_name" name="name">
            </div>

            <!-- Phone -->
            <div class="col-md-6 mb-2">
              <label class="form-label mb-1 text-muted" style="font-size: 13px;">Phone</label>
              <input readonly type="text" class="form-control form-control-sm" id="edit_phone" name="phone">
            </div>

            <!-- Birthdate -->
            <div class="col-md-6 mb-2">
              <label class="form-label mb-1 text-muted" style="font-size: 13px;">Birthdate</label>
              <input readonly type="text" class="form-control form-control-sm" id="edit_birthdate" name="birthdate">
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-2">
              <label class="form-label mb-1 text-muted" style="font-size: 13px;">Email</label>
              <input readonly type="text" class="form-control form-control-sm" id="edit_email" name="email">
            </div>

            <!-- Address -->
            <div class="col-md-6 mb-1">
              <label class="form-label mb-1 text-muted" style="font-size: 13px;">Address</label>
              <input readonly type="text" class="form-control form-control-sm" id="edit_address" name="address">
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
  <h6 class="small text-secondary mb-3">Deployment</h6>
  <div class="row gx-3">


   <div class="col-md-6 mb-3">
      <label class="form-label">Employee ID</label>
      <input type="text" class="form-control" id="edit_emp_id" name="emp_id">
</div>

    <div class="col-md-6 mb-3">
      <label class="form-label">TIN</label>
      <input type="text" class="form-control" id="edit_tin" name="tin">
</div>

  <div class="col-md-6 mb-3">
      <label class="form-label">SSS</label>
      <input type="text" class="form-control" id="edit_sss" name="sss">
</div>

  <div class="col-md-6 mb-3">
      <label class="form-label">PHIC</label>
      <input type="text" class="form-control" id="edit_phic" name="phic">
</div>

  <div class="col-md-6 mb-3">
      <label class="form-label">Pag-ibig</label>
      <input type="text" class="form-control" id="edit_pagibig" name="pagibig">
</div>

  <div class="col-md-6 mb-3">
      <label class="form-label">Position</label>
      <input type="text" class="form-control" id="edit_position" name="position">
</div>



 <div class="col-md-6 mb-3">
      <label class="form-label">Employee Status</label>
      <select class="form-select" id="edit_status" name="status">
        <option value="">Select...</option>
        <option value="New">New</option>
        <option value="Active">Active</option>
        <option value="Terminated">Terminated</option>
        <option value="Resigned">Resigned</option>
        <option value="RTWO">RTWO</option>
        <option value="AWOL">AWOL</option>
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









