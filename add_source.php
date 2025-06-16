<?php
header('Content-Type: application/json');
include 'includes/conn.php';
include 'includes/session.php';  // ← so $user is available

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Source Info
  $mode = $_POST['mode'];
  $raw_date = $_POST['source_date'];
  $date_obj = DateTime::createFromFormat('Y-m-d', $raw_date);
  $source_date = $date_obj ? $date_obj->format('F Y') : null;

  if (!$source_date) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Source Date format.']);
    exit;
  }

  $source = $_POST['source'];
  $referrer = $_POST['referrer'];
$source_by = $user['name'];
  $recruiter = $_POST['recruiter'];
  $scheduled_interview = $_POST['scheduled_interview'];
  $status = $_POST['status'];
  date_default_timezone_set('Asia/Manila'); // ✅ Set PH timezone
$last_updated = date('Y-m-d H:i:s');      // ✅ Format: 24-hour PH time


  // Personal Info
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $age = $_POST['age'];
  $birthdate = $_POST['birthdate'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city_municipality'];
  $education = $_POST['educational_attainment'];
  $school = $_POST['name_of_school'];
  $year = $_POST['year_last_attended'];


  // Insert into `source`
  $stmt = $conn->prepare("INSERT INTO source (mode, source_date, source, referrer, source_by, recruiter, scheduled_interview, status, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $mode, $source_date, $source, $referrer, $source_by, $recruiter, $scheduled_interview, $status, $last_updated);


  if ($stmt->execute()) {
    $source_id = $conn->insert_id;

    // Insert into `personal_info`
    $stmt2 = $conn->prepare("INSERT INTO personal_info (source_id, name, phone, age, birthdate, email, address, city_municipality, educational_attainment, name_of_school, year_last_attended)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("ississsssss", $source_id, $name, $phone, $age, $birthdate, $email, $address, $city, $education, $school, $year);

    if ($stmt2->execute()) {
      $response = [
        'status' => 'success',
        'message' => 'New source and personal info added successfully.',
        'source_id' => $source_id // ✅ Return it here
      ];
    } else {
      $response = ['status' => 'error', 'message' => 'Failed to add personal info: ' . $stmt2->error];
    }

    $stmt2->close();
  } else {
    $response = ['status' => 'error', 'message' => 'Failed to add source info: ' . $stmt->error];
  }

  $stmt->close();
  $conn->close();

  echo json_encode($response);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
