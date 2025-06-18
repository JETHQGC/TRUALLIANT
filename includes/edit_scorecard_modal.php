<style>
  /* Apply custom color to modal title */
  #scorecardModalLabel {
    color: #ffffff;
    font-weight: bold;
  }

  /* Make section headers bold and colored */
  .modal-body h6 {
    color: #0e1e40;
    font-weight: bold;
  }

  /* Style form labels */
  .form-label {
    font-weight: bold;
  }

  /* Primary button with custom color */
  .btn-custom-primary {
    background-color: #0e1e40;
    color: #ffffff;
    border: none;
  }

  .btn-custom-primary:hover {
    background-color: #152a66;
  }

  /* Secondary button styling */
  .btn-custom-secondary {
    background-color: #f0f0f0;
    color: #0e1e40;
    border: 1px solid #0e1e40;
  }

  .btn-custom-secondary:hover {
    background-color: #e2e6ea;
  }
</style>

<!-- Scorecard Modal -->
<div class="modal fade" id="scorecardModal" tabindex="-1" aria-labelledby="scorecardModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="scorecardForm">
        <div class="modal-header" style="background-color: #0e1e40;">
          <h5 class="modal-title" id="scorecardModalLabel">Trainee Scorecard</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

        <div class="modal-body">
          <!-- Mock Call Section -->
          <h6>Mock Call </h6>
          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <label class="form-label"><strong>Call Control </strong></label>
              <input type="number" class="form-control" name="call_control" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label"><strong>Rebuttals </strong></label>
              <input type="number" class="form-control" name="rebuttals" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label"><strong>Script Adherence </strong></label>
              <input type="number" class="form-control" name="script_adherence" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label"><strong>Professionalism </strong></label>
              <input type="number" class="form-control" name="professionalism" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label"><strong>Closing </strong></label>
              <input type="number" class="form-control" name="closing" max="10" min="0" step="0.1" required>
            </div>
          </div>

          <!-- Other KPIs -->
          <hr>
          <h6>Other KPIs</h6>
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label"><strong>Product Knowledge </strong></label>
              <input type="number" class="form-control" name="product_knowledge" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label"><strong>Dialer How-To</strong></label>
              <input type="number" class="form-control" name="dialer_howto" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label"><strong>Language 101 </strong></label>
              <input type="number" class="form-control" name="language" max="10" min="0" step="0.1" required>
            </div>
          </div>

          <!-- Score Display -->
          <hr>
          <div id="scoreSummary" class="mt-3 text-center fw-bold"></div>
        </div>

        <div class="modal-footer">
          <button 
          type="submit" 
          id="scorecardActionBtn" 
          class="btn btn-custom-primary" 
          style="background-color: #0e1e40; color: #ffffff; border: none;"
          onmouseover="this.style.backgroundColor='#f36523'" 
          onmouseout="this.style.backgroundColor='#0e1e40'">
          Calculate
        </button>

        <button 
          type="button" 
          class="btn btn-custom-secondary" 
          data-bs-dismiss="modal"
          style="background-color: #f0f0f0; color: #0e1e40; border: 1px solid #0e1e40;"
          onmouseover="this.style.backgroundColor='#f36523'; this.style.color='#ffffff';" 
          onmouseout="this.style.backgroundColor='#f0f0f0'; this.style.color='#0e1e40';">
          Close
        </button>

      </form>
    </div>
  </div>
</div>
