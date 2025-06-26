<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "trualliant";

// Connect to database
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Local path to CSV file on server
$csvFile = __DIR__ . "/employees.csv";

if (($file = fopen($csvFile, "r")) !== FALSE) {
    fgetcsv($file); // Skip header row

    while (($data = fgetcsv($file)) !== FALSE) {
        $emp_id = $conn->real_escape_string($data[0]);
        $employee_name = $conn->real_escape_string($data[1]);
        $birthdate_raw = $conn->real_escape_string($data[2]);
        $address = $conn->real_escape_string($data[3]);
        $mobile_no = $conn->real_escape_string($data[4]);
        $email_address = $conn->real_escape_string($data[5]);
        $tin = $conn->real_escape_string($data[6]);
        $sss = $conn->real_escape_string($data[7]);
        $phic = $conn->real_escape_string($data[8]);
        $pag_ibig = $conn->real_escape_string($data[9]);
        $date_hired_raw = $conn->real_escape_string($data[10]);
        $position = $conn->real_escape_string($data[11]);

        // Convert dates to Y-m-d format
        $birthdate = date("Y-m-d", strtotime($birthdate_raw));
        $date_hired = date("Y-m-d", strtotime($date_hired_raw));

        $sql = "INSERT INTO employee 
                (emp_id, employee_name, birthdate, address, mobile_no, email_address, tin, sss, phic, pag_ibig, date_hired, position)
                VALUES 
                ('$emp_id', '$employee_name', '$birthdate', '$address', '$mobile_no', '$email_address', '$tin', '$sss', '$phic', '$pag_ibig', '$date_hired', '$position')";

        if (!$conn->query($sql)) {
            echo "Error inserting row for $employee_name: " . $conn->error . "<br>";
        }
    }

    fclose($file);
    echo "Employee data imported successfully.";
} else {
    echo "Failed to open file: $csvFile";
}
?>
