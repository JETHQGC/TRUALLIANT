<?php
include 'includes/conn.php';
  $recruiters = [];
  $res = $conn->query("SELECT username, name FROM user WHERE username LIKE 'recruiter%' ORDER BY name");
  while ($r = $res->fetch_assoc()) {
      $recruiters[] = $r;
  }
?>