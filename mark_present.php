<?php
// mark_present.php

session_start();
include 'includes/conn.php';   // your DB connection
header('Content-Type: application/json');

// 1) Grab the array of IDs
$ids = $_POST['ids'] ?? [];
if (empty($ids) || !is_array($ids)) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'No applicants selected.']);
    exit;
}

// 2) Build a “?, ?, ?, …” placeholder string
$placeholders = implode(',', array_fill(0, count($ids), '?'));

// 3) Prepare the UPDATE
$sql = "UPDATE orientation
        SET orientation_status = 'Present'
        WHERE source_id IN ($placeholders)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Prepare failed: '.$conn->error]);
    exit;
}

// 4) Bind all IDs as integers
$types = str_repeat('i', count($ids));
$stmt->bind_param($types, ...$ids);

// 5) Execute!
if ($stmt->execute()) {
    echo json_encode([
      'status'  => 'success',
      'message' => "Marked ".count($ids)." applicant(s) as Present."
    ]);
} else {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Database error: '.$stmt->error]);
}

$stmt->close();
