<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = "
  SELECT 
    e.*,
    c.campaign,
    c.cluster,
    c.assigned_date,
    c.recommendation,
    c.removal_reason
  FROM employee e
  LEFT JOIN campaign c 
    ON c.employee_id = e.id
    AND c.assigned_date = (
      SELECT MAX(c2.assigned_date)
      FROM campaign c2
      WHERE c2.employee_id = e.id
    )
  WHERE e.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
