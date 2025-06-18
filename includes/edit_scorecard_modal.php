<!-- Scorecard Modal -->
<div class="modal fade" id="scorecardModal" tabindex="-1" aria-labelledby="scorecardModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="scorecardForm">
        <div class="modal-header">
          <h5 class="modal-title" id="scorecardModalLabel">Trainee Scorecard</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <!-- Mock Call Section -->
          <h6 class="text-primary">Mock Call (40%)</h6>
          <div class="row g-2 mb-2">
            <div class="col-md-4">
              <label class="form-label">Call Control (40%)</label>
              <input type="number" class="form-control" name="call_control" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Rebuttals (25%)</label>
              <input type="number" class="form-control" name="rebuttals" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Script Adherence (20%)</label>
              <input type="number" class="form-control" name="script_adherence" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Professionalism (10%)</label>
              <input type="number" class="form-control" name="professionalism" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Closing (5%)</label>
              <input type="number" class="form-control" name="closing" max="10" min="0" step="0.1" required>
            </div>
          </div>

          <!-- Other KPIs -->
          <hr>
          <h6 class="text-primary">Other KPIs</h6>
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">Product Knowledge (30%)</label>
              <input type="number" class="form-control" name="product_knowledge" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Dialer How-To (20%)</label>
              <input type="number" class="form-control" name="dialer_howto" max="10" min="0" step="0.1" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Language 101 (10%)</label>
              <input type="number" class="form-control" name="language" max="10" min="0" step="0.1" required>
            </div>
          </div>

          <!-- Score Display -->
          <hr>
          <div id="scoreSummary" class="mt-3 text-center fw-bold"></div>
        </div>
        <div class="modal-footer">
         <button type="submit" id="scorecardActionBtn" class="btn btn-primary">Calculate</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


