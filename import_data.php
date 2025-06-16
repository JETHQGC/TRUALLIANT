<?php
$mysqli = new mysqli("localhost", "root", "", "trualliant");

if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}

// List of names
$names = ['Cristiel', 'Francis', 'Jonelyn', 'Joeneliza', 'Angel'];

$counter = 1; // start from source1

foreach ($names as $name) {
    $username = "trainer" . $counter;
    $plainPassword = '1111';
    $email = $username . '@company.com';
    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

    $stmt = $mysqli->prepare("INSERT INTO user (username, name, password, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $name, $hashedPassword, $email);
    $stmt->execute();
    $stmt->close();

    $counter++;
}

echo "Source accounts created successfully.";
?>
