<?php
session_start();
include 'includes/conn.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Force case-sensitive match
  $sql = "SELECT * FROM user WHERE BINARY username = '$username'";
  $query = $conn->query($sql);

  if ($query->num_rows < 1) {
    $_SESSION['error'] = 'Cannot find account with that username';
    header('Location: index.php');
    exit;
  }

  $row = $query->fetch_assoc();

  if (password_verify($password, $row['password'])) {
    $_SESSION['user'] = $row['id'];

    // Role-based redirection using actual DB username
    $actualUsername = $row['username'];
    if (strpos($actualUsername, 'source') === 0) {
      header('Location: dashboard_source.php');
    } elseif (strpos($actualUsername, 'recruiter') === 0) {
      header('Location: dashboard_recruiter.php');
    } elseif (strpos($actualUsername, 'trainer') === 0) {
      header('Location: dashboard_trainer.php');
    } elseif (strpos($actualUsername, 'admin') === 0) {
      header('Location: dashboard_admin.php');
    } elseif (strpos($actualUsername, 'workforce') === 0) {
      header('Location: dashboard_workforce.php');
    }
    else {
      header('Location: index.php');
    }
    exit;

  } else {
    $_SESSION['error'] = 'Incorrect password';
    header('Location: index.php');
    exit;
  }

} else {
  $_SESSION['error'] = 'Please input credentials';
  header('Location: index.php');
  exit;
}
