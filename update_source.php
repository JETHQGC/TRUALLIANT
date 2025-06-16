<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

// Collect POST data
$source_id = $_POST['source_id'];
$mode = $_POST['mode'];
$source_date = $_POST['source_date'];
$source = $_POST['source'];
$referrer = $_POST['referrer'];
$source_by = $_POST['source_by'];
$recruiter = $_POST['recruiter'];
$scheduled_interview = $_POST['scheduled_interview'];
$status = $_POST['status'];

$name = $_POST['name'];
$phone = $_POST['phone'];
$age = $_POST['age'];
$birthdate = $_POST['birthdate'];
$email = $_POST['email'];
$address = $_POST['address'];
$city_municipality = $_POST['city_municipality'];
$educational_attainment = $_POST['educational_attainment'];
$name_of_school = $_POST['name_of_school'];
$year_last_attended = $_POST['year_last_attended'];



// Update source
$last_updated = date('Y-m-d H:i:s'); // PH time in 24-hour format

$updateSource = $conn->prepare("
  UPDATE source SET
    mode = ?, source_date = ?, source = ?, referrer = ?, source_by = ?,
    recruiter = ?, scheduled_interview = ?, status = ?,
    last_updated = ?
  WHERE source_id = ?
");
$updateSource->bind_param("sssssssssi", $mode, $source_date, $source, $referrer, $source_by, $recruiter, $scheduled_interview, $status, $last_updated, $source_id);

$updateSource->execute();
$updateSource->close();

// Personal info

  $updatePersonal = $conn->prepare("
    UPDATE personal_info SET
      name = ?, phone = ?, age = ?, birthdate = ?, email = ?, address = ?,
      city_municipality = ?, educational_attainment = ?, name_of_school = ?,
      year_last_attended = ?
    WHERE source_id = ?
  ");
  $updatePersonal->bind_param("ssisssssssi", $name, $phone, $age, $birthdate, $email, $address, $city_municipality, $educational_attainment, $name_of_school, $year_last_attended, $source_id);
  $updatePersonal->execute();
  $updatePersonal->close();















echo json_encode([
  'status' => 'success',
  'message' => 'Record successfully updated.',
  'source_id' => $source_id // return for dynamic row update if needed
]);
exit;
?>
