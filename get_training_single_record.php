<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = " SELECT 
    s.source_id,
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    i.bpo_exp,
    e.date_endorsed, e.endorsement_id,
    t.batch, t.trainer, t.day1_attendance, t.ta_credential, t.trainee_status, t.status_date, t.status_remarks
  FROM source s
  LEFT JOIN personal_info p ON s.source_id = p.source_id
  LEFT JOIN endorsement e ON s.source_id = e.source_id
  LEFT JOIN initial_interview i ON s.source_id = i.source_id
  LEFT JOIN training t ON e.endorsement_id = t.endorsement_id
        WHERE t.endorsement_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
