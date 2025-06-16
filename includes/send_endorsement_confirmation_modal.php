<!-- Send Orientation Confirmation Modal -->
<div class="modal fade" id="sendEndorsementModal" tabindex="-1" aria-labelledby="sendEndorsementLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="sendScheduleLabel">Confirm Send</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>The following applicants will be endorsed to Training:</p>
        <ul id="sendList" class="mb-0"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="confirmSendBtn" type="button" class="btn btn-success">Send to HR</button>
      </div>
    </div>
  </div>
</div>
