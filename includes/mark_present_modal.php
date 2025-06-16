<!-- Mark Present Confirmation Modal -->
<div class="modal fade" id="markPresentModal" tabindex="-1" aria-labelledby="markPresentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="markPresentModalLabel">Confirm Mark as Present</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You’re about to mark these applicants as <strong>Present</strong>:</p>
        <ul id="presentList" class="mb-0 ps-3"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="confirmPresentBtn" type="button" class="btn btn-primary">Yes, Mark Present</button>
      </div>
    </div>
  </div>
</div>
