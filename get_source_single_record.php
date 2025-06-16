<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = "SELECT 
          s.source_id, s.mode, s.source_date, s.source, s.referrer, s.source_by,
          s.recruiter, s.scheduled_interview, s.status,
          p.name, p.phone, p.age, p.birthdate, p.email, p.address, p.city_municipality,
          p.educational_attainment, p.name_of_school, p.year_last_attended
        FROM source s
        LEFT JOIN personal_info p ON s.source_id = p.source_id
        WHERE s.source_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
