<?php
include 'includes/conn.php';

$id = $_GET['id'] ?? 0;

// 1. Get training_id from endorsement_id
$stmt = $conn->prepare("SELECT training_id FROM training WHERE endorsement_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo json_encode([]);
  exit;
}

$training_id = $result->fetch_assoc()['training_id'];

// 2. Get scorecard by training_id
$scoreStmt = $conn->prepare("SELECT * FROM scorecard WHERE training_id = ?");
$scoreStmt->bind_param("i", $training_id);
$scoreStmt->execute();
$scoreResult = $scoreStmt->get_result();

echo json_encode($scoreResult->fetch_assoc() ?: []);
