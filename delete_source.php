<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');
$last_updated = date('Y-m-d H:i:s'); // PH time in 24-hour format

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $source_id = $_POST['id'];

    // Perform a soft delete by setting `deleted = 1` and updating timestamp
    $stmt = $conn->prepare("UPDATE source SET deleted = 1, last_updated = ? WHERE source_id = ?");
    $stmt->bind_param("si", $last_updated, $source_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => "Source ID $source_id marked as deleted."]);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Failed to delete Source ID $source_id: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Source ID.']);
}
exit;
