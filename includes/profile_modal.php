<!-- Profile Modal -->
<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="profileModalLabel"><b>Profile</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
         <div class="mb-3">
  <label for="username" class="form-label">Username</label>
  <input type="text" class="form-control" id="username" name="username" 
         value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
</div>


          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
          </div>

          <hr>

          <div class="mb-3">
            <label for="curr_password" class="form-label">Current Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="Enter current password to confirm changes" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa fa-close"></i> Close
          </button>
          <button type="submit" class="btn btn-success" name="save">
            <i class="fa fa-check-square-o"></i> Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
