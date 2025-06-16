<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Collect and sanitize POST data
$source_id = intval($_POST['source_id'] ?? 0);
$shift = $_POST['shift'] ?? '';
$facilitator = $_POST['facilitator'] ?? '';
$confirmation = $_POST['confirmation'] ?? '';
$second_confirmation = $_POST['second_confirmation'] ?? '';
$emergency_contact_person = $_POST['emergency_contact_person'] ?? '';
$emergency_contact_number = $_POST['emergency_contact_number'] ?? '';
$emergency_contact_address = $_POST['emergency_contact_address'] ?? '';
$signed_contract = $_POST['signed_contract'] ?? '';

try {
  // Check if record exists
  $check = $conn->prepare("SELECT 1 FROM endorsement WHERE source_id = ?");
  $check->bind_param("i", $source_id);
  $check->execute();
  $check->store_result();
  $exists = $check->num_rows > 0;
  $check->close();

  if ($exists) {
    // UPDATE
    $upd = $conn->prepare("
      UPDATE endorsement
         SET shift = ?,
             facilitator = ?,
             confirmation = ?,
             second_confirmation = ?,
             emergency_contact_person = ?,
             emergency_contact_number = ?,
             emergency_contact_address = ?,
              signed_contract = ?
       WHERE source_id = ?
    ");
    $upd->bind_param(
      "ssssssssi",
      $shift,
      $facilitator,
      $confirmation,
      $second_confirmation,
      $emergency_contact_person,
      $emergency_contact_number,
      $emergency_contact_address,
      $signed_contract,
      $source_id
    );
    $upd->execute();
    $upd->close();
  } else {
    // INSERT
    $ins = $conn->prepare("
      INSERT INTO endorsement (
        source_id,
        shift,
        facilitator,
        confirmation,
        second_confirmation,
        emergency_contact_person,
        emergency_contact_number,
        emergency_contact_address,
        signed_contract
      ) VALUES (?,?,?,?,?,?,?,?,?)
    ");
    $ins->bind_param(
      "issssssss",
      $source_id,
      $shift,
      $facilitator,
      $confirmation,
      $second_confirmation,
      $emergency_contact_person,
      $emergency_contact_number,
      $emergency_contact_address,
      $signed_contract
    );
    $ins->execute();
    $ins->close();
  }

  echo json_encode([
    'status'    => 'success',
    'message'   => 'Endorement data saved successfully.',
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
