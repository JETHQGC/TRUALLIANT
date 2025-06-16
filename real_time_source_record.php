<?php
header('Content-Type: application/json');
include 'includes/conn.php';

date_default_timezone_set('Asia/Manila'); // ✅ Set to Philippine time

$last_id = isset($_GET['after']) ? intval($_GET['after']) : 0;

// Match JS polling interval
$interval_seconds = 5;

$sql = "SELECT 
          s.*, 
          p.personal_info_id, p.name, p.phone, p.age, p.birthdate, p.email, p.address,
          p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended
        FROM source s
        LEFT JOIN personal_info p ON s.source_id = p.source_id
        WHERE s.source_id > ?
           OR s.last_updated > NOW() - INTERVAL {$interval_seconds} SECOND
        ORDER BY s.source_id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $last_id);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
  $records[] = $row;
}

echo json_encode($records);
?>
