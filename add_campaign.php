<?php
header('Content-Type: application/json');
include 'includes/conn.php';
include 'includes/session.php'; // For $user info

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Extract posted data
  $employee_id = $_POST['employee_id'];
  $assigned_date = $_POST['assigned_date'];
  $recommendation = $_POST['recommendation'];
  $campaign = $_POST['campaign'];
  $cluster = $_POST['cluster'];
  $removal_reason = $_POST['removal_reason'] ?? null;



  // Prepare and execute insert
  $stmt = $conn->prepare("
    INSERT INTO campaign (
      employee_id, assigned_date, recommendation, campaign, cluster,
      removal_reason
    ) VALUES (?, ?, ?, ?, ?, ?)
  ");

  $stmt->bind_param(
    "isssss",
    $employee_id,
    $assigned_date,
    $recommendation,
    $campaign,
    $cluster,
    $removal_reason
  );

  if ($stmt->execute()) {
    $response = [
      'status' => 'success',
      'message' => 'Campaign added successfully.',
      'employee_id' => $employee_id // ✅ included here
    ];
  } else {
    $response = [
      'status' => 'error',
      'message' => 'Failed to add campaign: ' . $stmt->error
    ];
  }

  $stmt->close();
  $conn->close();
  echo json_encode($response);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
