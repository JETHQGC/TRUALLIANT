<?php
header('Content-Type: application/json');
include 'includes/conn.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo json_encode(['error' => 'Invalid or missing employee ID.']);
  exit;
}

$employee_id = intval($_GET['id']);

// Fetch employee general info with latest campaign
$sql = "
  SELECT 
    e.employee_name, 
    e.emp_id, 
    e.emp_status, 
    c.campaign, 
    c.assigned_date
  FROM employee e
  LEFT JOIN campaign c 
    ON e.id = c.employee_id 
    AND c.assigned_date = (
      SELECT MAX(c2.assigned_date) 
      FROM campaign c2 
      WHERE c2.employee_id = e.id
    )
  WHERE e.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $employee_id);
$stmt->execute();
$empResult = $stmt->get_result();
$employee = $empResult->fetch_assoc();
$stmt->close();

if (!$employee) {
  echo json_encode(['error' => 'Employee not found.']);
  exit;
}

// Fetch full campaign history for timeline
$historySql = "
  SELECT 
    campaign, 
    assigned_date, 
    recommendation, 
    removal_reason, 
    cluster
  FROM campaign
  WHERE employee_id = ?
  ORDER BY assigned_date DESC
";

$stmt = $conn->prepare($historySql);
$stmt->bind_param('i', $employee_id);
$stmt->execute();
$historyResult = $stmt->get_result();

$timeline = [];
while ($row = $historyResult->fetch_assoc()) {
  $assignedDate = date('F j, Y', strtotime($row['assigned_date']));
  $assignedTime = date('g:i A', strtotime($row['assigned_date']));

  // Description logic: prioritize removal reason
  $description = !empty($row['removal_reason']) 
    ? 'Removed due to ' . $row['removal_reason']
    : 'Assigned to the ' . $row['campaign'] . ' campaign.';

  // Meta field
  $metaParts = [];
  if (!empty($row['recommendation'])) {
    $metaParts[] = 'Recommendation: ' . $row['recommendation'];
  }
  if (!empty($row['cluster'])) {
    $metaParts[] = 'Department: ' . $row['cluster'];
  }

  $timeline[] = [
    'title' => 'Assigned to ' . $row['campaign'],
    'date' => $assignedDate,
    'time' => $assignedTime,
    'description' => $description,
    'meta' => implode(' | ', $metaParts)
  ];
}
$stmt->close();
$conn->close();

$response = [
  'employee_name' => $employee['employee_name'],
  'emp_id' => $employee['emp_id'],
  'emp_status' => $employee['emp_status'],
  'campaign' => $employee['campaign'],
  'assigned_date' => date('F j, Y', strtotime($employee['assigned_date'] ?? '')),
  'history' => $timeline
];

echo json_encode($response);
