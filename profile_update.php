<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['save'])) {
    $return = $_GET['return'];
    $curr_password = $_POST['curr_password'];
    $username = $_POST['username'];
      $name = $_POST['name'];
    $email = $_POST['email'];
    $new_password = $_POST['password'];

    // Fetch current user info from database
    $user_id = $_SESSION['user']; // Assuming this stores the logged-in user ID
    $query = "SELECT * FROM user WHERE id = '$user_id'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify current password
        if (password_verify($curr_password, $user['password'])) {
            // Handle password update
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            } else {
                $hashed_password = $user['password']; // Keep old password
            }

            // Update user record
            $sql = "UPDATE user SET username = ?, email = ?, name = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $username, $email, $name, $hashed_password, $user_id);

            if ($stmt->execute()) {
                $_SESSION['success'] = 'Profile updated successfully';
            } else {
                $_SESSION['error'] = 'Update failed: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = 'Incorrect current password';
			 $_SESSION['reopen_modal'] = true;
        }
    } else {
        $_SESSION['error'] = 'User not found';
		 $_SESSION['reopen_modal'] = true;
    }
} else {
    $_SESSION['error'] = 'Please fill out the form completely.';
	 $_SESSION['reopen_modal'] = true;
}

header('Location: ' . $return);
exit;
?>
