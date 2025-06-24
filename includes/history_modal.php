<!-- Deployment History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header" style="background-color: #0e1e40;">
        <h5 class="modal-title text-white fw-bold">
          <i class="fa fa-clock-rotate-left me-2"></i> <span id="historyName">Employee</span> - Deployment History
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-4">
        <div class="mb-4 d-flex justify-content-between flex-wrap border-bottom pb-3">
          <div>
            <div><strong>Agent ID:</strong> <span id="historyEmpId">—</span></div>
            <div><strong>Current Status:</strong> <span class="text-success fw-semibold" id="historyStatus">—</span></div>
          </div>
          <div>
            <div><strong>Current Campaign:</strong> <span id="historyCampaign">—</span></div>
            <div><strong>Deployment Date:</strong> <span id="historyDate">—</span></div>
          </div>
        </div>

        <div class="timeline" id="historyTimeline">
          <!-- Dynamic content here -->
        </div>
      </div>
    </div>
  </div>
</div>
