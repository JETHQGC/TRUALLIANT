<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Collect and sanitize POST data
$source_id                 = intval($_POST['source_id'] ?? 0);
$bpo_exp                   = $_POST['bpo_exp']                 ?? '';
$expected_salary           = $_POST['expected_salary']         ?? '';
$previous_salary           = $_POST['previous_salary']         ?? '';
$incentives                = $_POST['incentives']              ?? '';
$benefits                  = $_POST['benefits']                ?? '';
$reason_for_leaving        = $_POST['reason_for_leaving']      ?? '';
$medical_condition         = $_POST['medical_condition']       ?? '';
$can_work_shifting_sched   = $_POST['can_work_shifting_sched'] ?? '';
$can_work_weekend_holidays = $_POST['can_work_weekend_holidays'] ?? '';
$can_work_onsite           = $_POST['can_work_onsite']         ?? '';
$fully_vaccinated          = $_POST['fully_vaccinated']        ?? '';
$currently_studying        = $_POST['currently_studying']      ?? '';
$initial_interview         = $_POST['initial_interview']       ?? '';
$second_call_attempt = !empty($_POST['second_call_attempt']) ? $_POST['second_call_attempt'] : null;
$third_call_attempt  = !empty($_POST['third_call_attempt'])  ? $_POST['third_call_attempt']  : null;


try {
  // Check if record exists
  $check = $conn->prepare("SELECT 1 FROM initial_interview WHERE source_id = ?");
  $check->bind_param("i", $source_id);
  $check->execute();
  $check->store_result();
  $exists = $check->num_rows > 0;
  $check->close();

  if ($exists) {
    // UPDATE
    $upd = $conn->prepare("
      UPDATE initial_interview
         SET bpo_exp                  = ?,
             expected_salary          = ?,
             previous_salary          = ?,
             incentives               = ?,
             benefits                 = ?,
             reason_for_leaving       = ?,
             medical_condition        = ?,
             can_work_shifting_sched  = ?,
             can_work_weekend_holidays= ?,
             can_work_onsite          = ?,
             fully_vaccinated         = ?,
             currently_studying       = ?,
             initial_interview        = ?,
             second_call_attempt      = ?,
             third_call_attempt       = ?
       WHERE source_id = ?
    ");
    $upd->bind_param(
      "sssssssssssssssi",
      $bpo_exp,
      $expected_salary,
      $previous_salary,
      $incentives,
      $benefits,
      $reason_for_leaving,
      $medical_condition,
      $can_work_shifting_sched,
      $can_work_weekend_holidays,
      $can_work_onsite,
      $fully_vaccinated,
      $currently_studying,
      $initial_interview,
      $second_call_attempt,
      $third_call_attempt,
      $source_id
    );
    $upd->execute();
    $upd->close();
  } else {
    // INSERT
    $ins = $conn->prepare("
      INSERT INTO initial_interview (
        source_id,
        bpo_exp,
        expected_salary,
        previous_salary,
        incentives,
        benefits,
        reason_for_leaving,
        medical_condition,
        can_work_shifting_sched,
        can_work_weekend_holidays,
        can_work_onsite,
        fully_vaccinated,
        currently_studying,
        initial_interview,
        second_call_attempt,
        third_call_attempt
      ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");
    $ins->bind_param(
      "isssssssssssssss",
      $source_id,
      $bpo_exp,
      $expected_salary,
      $previous_salary,
      $incentives,
      $benefits,
      $reason_for_leaving,
      $medical_condition,
      $can_work_shifting_sched,
      $can_work_weekend_holidays,
      $can_work_onsite,
      $fully_vaccinated,
      $currently_studying,
      $initial_interview,
      $second_call_attempt,
      $third_call_attempt
    );
    $ins->execute();
    $ins->close();
  }

  echo json_encode([
    'status'    => 'success',
    'message'   => 'Interview data saved successfully.',
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
