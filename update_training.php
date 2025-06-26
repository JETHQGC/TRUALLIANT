<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Collect and sanitize POST data
$endorsement_id = intval($_POST['endorsement_id'] ?? 0);
$batch = $_POST['batch'] ?? '';
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
    // Fetch current trainee_status and status_date
    $current = $conn->prepare("SELECT trainee_status, status_date FROM training WHERE endorsement_id = ?");
    $current->bind_param("i", $endorsement_id);
    $current->execute();
    $current->bind_result($existing_status, $existing_date);
    $current->fetch();
    $current->close();

    // Only update status_date if transitioning to 'Endorsed to Deployment'
if ($trainee_status === 'Endorsed to Deployment' && $existing_status !== 'Endorsed to Deployment') {
    $status_date = date('Y-m-d');

    // Fetch personal info
    $info = $conn->prepare("
        SELECT pi.name, pi.birthdate, pi.address, pi.phone, pi.email
        FROM personal_info pi
        INNER JOIN endorsement e ON pi.source_id = e.source_id
        WHERE e.endorsement_id = ?
    ");
    $info->bind_param("i", $endorsement_id);
    $info->execute();
    $info->store_result();
    $info->bind_result($name, $birthdate, $address, $phone, $email);

    if ($info->num_rows > 0 && $info->fetch()) {
        // Check if already in employee table
        $checkEmp = $conn->prepare("SELECT 1 FROM employee WHERE employee_name = ? AND date_hired = ?");
        $checkEmp->bind_param("ss", $name, $status_date);
        $checkEmp->execute();
        $checkEmp->store_result();
        $alreadyExists = $checkEmp->num_rows > 0;
        $checkEmp->close();

        if (!$alreadyExists) {
            $emp_id = ''; // Leave blank
            $emp_status = 'New';

            $insert = $conn->prepare("
                INSERT INTO employee (
                    emp_id, employee_name, birthdate, address, mobile_no,
                    email_address, tin, sss, phic, pag_ibig,
                    date_hired, position, emp_status
                ) VALUES (?, ?, ?, ?, ?, ?, '', '', '', '', ?, '', ?)
            ");
            $insert->bind_param(
                "ssssssss", // 8 variables
                $emp_id, $name, $birthdate, $address, $phone,
                $email, $status_date, $emp_status
            );
            $insert->execute();
            $insert->close();
        }
    }

    $info->close();
}


 else {
      // Retain the existing date if status is unchanged or not transitioning
      $status_date = $existing_date;
    }

    // Perform the UPDATE
    $upd = $conn->prepare("
      UPDATE training
          SET batch = ?,
              day1_attendance = ?,
              ta_credential = ?,
              trainee_status = ?,
              status_date = ?,
              status_remarks = ?
       WHERE endorsement_id = ?
    ");
    $upd->bind_param(
      "ssssssi",
      $batch,
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
    // First-time insert — set current date if status is 'Endorsed to Deployment'
    if ($trainee_status === 'Endorsed to Deployment') {
      $status_date = date('Y-m-d');
    }

    // Perform the INSERT
    $ins = $conn->prepare("
      INSERT INTO training (
        endorsement_id,
        batch,
        day1_attendance,
        ta_credential,
        trainee_status,
        status_date,
        status_remarks
      ) VALUES (?,?,?,?,?,?,?)
    ");
    $ins->bind_param(
      "issssss",
      $endorsement_id,
      $batch,
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
