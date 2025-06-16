<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = " SELECT 
    s.source_id,
    s.source_date,
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    o.orientation_date, o.orientation_status
  FROM source s
  LEFT JOIN personal_info p     ON s.source_id = p.source_id
  LEFT JOIN assessment a ON s.source_id = a.source_id
  LEFT JOIN orientation o ON s.source_id = o.source_id
        WHERE s.source_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
