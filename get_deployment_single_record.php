<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = " SELECT employee.*, campaign.assigned_date, campaign.removal_reason, campaign.recommendation, campaign.campaign, campaign.cluster
    FROM employee
    LEFT JOIN campaign ON employee.id = campaign.employee_id
        WHERE employee.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
