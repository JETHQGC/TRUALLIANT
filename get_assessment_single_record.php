<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = "SELECT 
    s.source_id,
    s.source_date,
    s.source_by,
    s.recruiter,
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    a.comprehension, a.pronunciation, a.active_listening, a.diction, a.intonation, a.typing_test, a.script_reading, a.link, a.total_score, a.assessment_status
  FROM source s
  LEFT JOIN personal_info p     ON s.source_id = p.source_id
  LEFT JOIN initial_interview i ON s.source_id = i.source_id
  LEFT JOIN assessment a ON s.source_id = a.source_id
        WHERE s.source_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
