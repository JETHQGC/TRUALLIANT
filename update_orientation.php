<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Collect and sanitize POST data
$source_id                 = intval($_POST['source_id'] ?? 0);
$orientation_date         = $_POST['orientation_date']         ?? '';

try {
  // Check if record exists
  $check = $conn->prepare("SELECT 1 FROM orientation WHERE source_id = ?");
  $check->bind_param("i", $source_id);
  $check->execute();
  $check->store_result();
  $exists = $check->num_rows > 0;
  $check->close();

  if ($exists) {
    // UPDATE
    $upd = $conn->prepare("
      UPDATE orientation
         SET orientation_date = ?
       WHERE source_id = ?
    ");
    $upd->bind_param(
      "si",
      $orientation_date,
      $source_id
    );
    $upd->execute();
    $upd->close();
  } else {
    // INSERT
    $ins = $conn->prepare("
      INSERT INTO orientation (
        source_id,
        orientation_date
      ) VALUES (?,?)
    ");
    $ins->bind_param(
      "is",
      $source_id,
      $orientation_date
    );
    $ins->execute();
    $ins->close();
  }

  echo json_encode([
    'status'    => 'success',
    'message'   => 'Orientation data saved successfully.',
    'source_id' => $source_id
  ]);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode([
    'status'  => 'error',
    'message' => 'Database error: ' . $e->getMessage()
  ]);
}
?>
