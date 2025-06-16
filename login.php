<?php
session_start();
include 'includes/conn.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {

  $username = strtolower(trim($_POST['username']));
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE username = '$username'";
  $query = $conn->query($sql);

  if ($query->num_rows < 1) {
    $_SESSION['error'] = 'Cannot find account with that username';
  } else {
    $row = $query->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user'] = $row['id'];

      // Redirect user based on role in username
      if (strpos($username, 'source') === 0) {
        header('Location: dashboard_source.php');
      } elseif (strpos($username, 'recruiter') === 0) {
        header('Location: dashboard_recruiter.php');
      } elseif (strpos($username, 'trainer') === 0) {
        header('Location: dashboard_trainer.php');
      } else {
        header('Location: index.php'); // default fallback
      }
      exit;

    } else {
      $_SESSION['error'] = 'Incorrect password';
    }
  }

} else {
  $_SESSION['error'] = 'Please input credentials';
}

// Redirect back to login on failure
header('Location: index.php');
exit;
?>
