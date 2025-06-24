<!-- Profile Modal -->
<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #0e1e40;">
          <h5 class="modal-title text-white" id="profileModalLabel"><b>Profile</b></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body bg-white">
          <div class="mb-3">
            <label for="username" class="form-label"><strong>Username</strong></label>
            <input type="text" class="form-control" id="username" name="username"
              value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label"><strong>Email</strong></label>
            <input type="email" class="form-control" id="email" name="email"
              value="<?php echo htmlspecialchars($user['email']); ?>">
          </div>

          <div class="mb-3">
            <label for="name" class="form-label"><strong>Name</strong></label>
            <input type="text" class="form-control" id="name" name="name"
              value="<?php echo htmlspecialchars($user['name']); ?>">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label"><strong>New Password</strong></label>
            <input type="password" class="form-control" id="password" name="password"
              placeholder="Leave blank to keep current password">
          </div>

          <hr>

          <div class="mb-3">
            <label for="curr_password" class="form-label"><strong>Current Password</strong> <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="curr_password" name="curr_password"
              placeholder="Enter current password to confirm changes" required>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn custom-btn-gray" data-bs-dismiss="modal">
            <i class="fa fa-close"></i> Close
          </button>
          <button type="submit" class="btn custom-btn-orange" name="save">
            <i class="fa fa-check-square-o"></i> <strong>Save</strong>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Custom Styles -->
<style>
  .custom-btn-orange {
    background-color: #f36523;
    color: white;
    border: none;
  }

  .custom-btn-orange:hover {
    background-color: #0e1e40;
    color: white;
  }

  .custom-btn-gray {
    background-color: #6c757d;
    color: white;
    border: none;
  }

  .custom-btn-gray:hover {
    background-color: #5a6268;
    color: white;
  }
</style>
