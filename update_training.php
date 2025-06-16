<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Collect and sanitize POST data
$endorsement_id = intval($_POST['endorsement_id'] ?? 0);
$batch = $_POST['batch'] ?? '';
$trainer = $_POST['trainer'] ?? '';
$day1_attendance = $_POST['attendance'] ?? '';
$ta_credential = $_POST['credential'] ?? '';
$trainee_status = $_POST['trainee_status'] ?? '';
$status_date = $_POST['status_date'] ?? '';
$status_remarks = $_POST['remarks'] ?? '';


try {
  // Check if record exists
  $check = $conn->prepare("SELECT 1 FROM training WHERE endorsement_id = ?");
  $check->bind_param("i", $endorsement_id);
  $check->execute();
  $check->store_result();
  $exists = $check->num_rows > 0;
  $check->close();

  if ($exists) {
    // UPDATE
    $upd = $conn->prepare("
      UPDATE training
          SET batch = ?,
              trainer = ?,
              day1_attendance = ?,
              ta_credential = ?,
              trainee_status = ?,
              status_date = ?,
              status_remarks = ?
       WHERE endorsement_id = ?
    ");
    $upd->bind_param(
      "sssssssi",
      $batch,
      $trainer,
      $day1_attendance,
      $ta_credential,
      $trainee_status,
      $status_date,
      $status_remarks,
      $endorsement_id
    );
    $upd->execute();
    $upd->close();
  } else {
    // INSERT
    $ins = $conn->prepare("
      INSERT INTO training (
        endorsement_id,
        batch,
        trainer,
        day1_attendance,
        ta_credential,
        trainee_status,
        status_date,
        status_remarks
      ) VALUES (?,?,?,?,?,?,?,?)
    ");
    $ins->bind_param(
      "isssssss",
      $endorsement_id,
      $batch,
      $trainer,
      $day1_attendance,
      $ta_credential,
      $trainee_status,
      $status_date,
      $status_remarks
    );
    $ins->execute();
    $ins->close();
  }

  echo json_encode([
    'status'    => 'success',
    'message'   => 'Training data saved successfully.',
    'endorsement_id' => $endorsement_id
  ]);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode([
    'status'  => 'error',
    'message' => 'Database error: ' . $e->getMessage()
  ]);
}
?>
