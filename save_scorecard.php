<?php
include 'includes/conn.php';

$data = $_POST;
$endorsement_id = $data['endorsement_id'];

// Step 1: Get training_id from endorsement_id
$training_stmt = $conn->prepare("SELECT training_id FROM training WHERE endorsement_id = ?");
$training_stmt->bind_param("i", $endorsement_id);
$training_stmt->execute();
$training_result = $training_stmt->get_result();

if ($training_result->num_rows === 0) {
  echo json_encode(['status' => 'error', 'message' => 'Training ID not found']);
  exit;
}

$training_row = $training_result->fetch_assoc();
$training_id = $training_row['training_id'];

// Step 2: Compute the total score
function score_weight($score, $weight) {
  return ($score / 10) * $weight;
}

$partialMockCall =
  score_weight($data['call_control'], 0.40) +
  score_weight($data['rebuttals'], 0.25) +
  score_weight($data['script_adherence'], 0.20) +
  score_weight($data['professionalism'], 0.10) +
  score_weight($data['closing'], 0.05);

$finalMockCall = $partialMockCall * 0.40;
$productKnowledge = score_weight($data['product_knowledge'], 0.30);
$dialerHowTo      = score_weight($data['dialer_how_to'], 0.20);
$language         = score_weight($data['language'], 0.10);

$totalScore = $finalMockCall + $productKnowledge + $dialerHowTo + $language;

// Step 3: Check if scorecard already exists
$check_stmt = $conn->prepare("SELECT scorecard_id FROM scorecard WHERE training_id = ?");
$check_stmt->bind_param("i", $training_id);
$check_stmt->execute();
$existing = $check_stmt->get_result()->fetch_assoc();

if ($existing) {
  // Scorecard exists — perform update
  $sql = "UPDATE scorecard SET 
    call_control = ?, rebuttals = ?, script_adherence = ?, professionalism = ?, closing = ?,
    product_knowledge = ?, dialer_how_to = ?, language_101 = ?
    WHERE training_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param(
    'ddddddddi',
    $data['call_control'],
    $data['rebuttals'],
    $data['script_adherence'],
    $data['professionalism'],
    $data['closing'],
    $data['product_knowledge'],
    $data['dialer_how_to'],
    $data['language'],
    $training_id
  );
} else {
  // Scorecard does not exist — perform insert
  $sql = "INSERT INTO scorecard (
    training_id, call_control, rebuttals, script_adherence, professionalism, closing,
    product_knowledge, dialer_how_to, language_101
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param(
    'idddddddd',
    $training_id,
    $data['call_control'],
    $data['rebuttals'],
    $data['script_adherence'],
    $data['professionalism'],
    $data['closing'],
    $data['product_knowledge'],
    $data['dialer_how_to'],
    $data['language']
  );
}

// Step 4: Execute insert/update
if ($stmt->execute()) {
  // Step 5: Update status if total score < 85
  if ($totalScore * 100 < 85) {
    $update = $conn->prepare("UPDATE training SET trainee_status = ? WHERE training_id = ?");
    $status = "Terminated - Trainee Poor Performance";
    $update->bind_param("si", $status, $training_id);
    $update->execute();
  }

  echo json_encode(['status' => 'success', 'message' => $existing ? 'Score updated' : 'Score saved']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Save failed']);
}
