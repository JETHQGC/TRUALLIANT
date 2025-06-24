<?php
include 'includes/conn.php';

$sql = "
  SELECT 
  e.id, 
  e.emp_id, 
  e.employee_name, 
  e.position, 
  e.emp_status,
  c.campaign AS latest_campaign,
  c.assigned_date AS latest_assigned_date
FROM employee e
LEFT JOIN campaign c 
  ON c.employee_id = e.id 
  AND c.assigned_date = (
    SELECT MAX(c2.assigned_date) 
    FROM campaign c2 
    WHERE c2.employee_id = e.id
  )
WHERE e.emp_status IN ('Active', 'RTWO', 'New')
ORDER BY e.employee_name ASC

";

$result = $conn->query($sql);
$employees = [];

while ($row = $result->fetch_assoc()) {
  $employees[] = $row;
}

echo json_encode($employees);
