<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

// Collect POST data
$id = $_POST['id'];
$emp_id = $_POST['emp_id'];
$tin = $_POST['tin'];
$sss = $_POST['sss'];
$pagibig = $_POST['pagibig'];
$philhealth = $_POST['phic'];
$position = $_POST['position'];
$status = $_POST['status'];





$updateDeployment = $conn->prepare("
  UPDATE employee SET
    emp_id = ?, tin = ?, sss = ?, pag_ibig = ?, phic = ?, position = ?, emp_status = ?
  WHERE id = ?
");
$updateDeployment->bind_param("sssssssi",$emp_id, $tin, $sss, $pagibig, $philhealth, $position, $status, $id);

$updateDeployment->execute();
$updateDeployment->close();
// Check for errors








echo json_encode([
  'status' => 'success',
  'message' => 'Record successfully updated.',
  'id' => $id // return for dynamic row update if needed
]);
exit;
?>
