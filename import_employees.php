<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=trualliant", "root", "");

// Load CSV file
$csvFile = fopen('all_active.csv', 'r');
fgetcsv($csvFile); // Skip header row

while (($row = fgetcsv($csvFile)) !== FALSE) {
    $empID = trim($row[0]);         // emp_id
    $position = trim($row[1]);      // position
    $status = trim($row[2]);        // emp_status

    if (!empty($empID)) {
        $stmt = $pdo->prepare("
            UPDATE employee 
            SET position = :position, emp_status = :status 
            WHERE emp_id = :empID
        ");
        $stmt->execute([
            ':position' => $position,
            ':status' => $status,
            ':empID' => $empID
        ]);
    }
}

fclose($csvFile);
echo "Employee table updated successfully.";
?>
