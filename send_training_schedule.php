<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Autoload Composer packages
require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 1) Collect selected IDs
$ids = $_POST['ids'] ?? [];
if (empty($ids) || !is_array($ids)) {
    http_response_code(400);
    echo json_encode(['message' => 'No applicants selected.']);
    exit;
}

// 2) Fetch their name, email, and orientation_date
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$sql = "
  SELECT s.source_id, p.name, p.email, t.batch, e.endorsement_id
  FROM source s
  JOIN personal_info p ON s.source_id = p.source_id
  JOIN endorsement e   ON s.source_id = e.source_id
  JOIN training t ON e.endorsement_id = t.endorsement_id
  WHERE e.endorsement_id IN ($placeholders)
";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
$stmt->execute();
$result = $stmt->get_result();

$sent = 0;
while ($row = $result->fetch_assoc()) {
    $applicantId    = (int)$row['source_id'];
    $applicantName  = htmlspecialchars($row['name']);
    $applicantEmail = filter_var($row['email'], FILTER_VALIDATE_EMAIL);
    $rawDate        = $row['batch'];

    // skip if missing email or date
    if (!$applicantEmail || !$rawDate) {
        continue;
    }


    

    // Format the schedule nicely
    $scheduleText = date('F j, Y \a\t g:i A', strtotime($rawDate));

    // 3) Send via PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP server config
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jethrodelima.qgc@gmail.com';
        $mail->Password   = 'wksm kpge jvgb ixqj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('no-reply@qgc.com', 'TRUALLIANT Recruitment Team');
        $mail->addAddress($applicantEmail, $applicantName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Training Schedule Invitation';
       $mail->Body = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Training Schedule</title>
  <style>
    body, table { margin:0; padding:0; }
    body { width:100% !important; font-family:Arial,sans-serif; background:#f0f2f5; }
    .wrapper { width:100%; padding:30px 0; }
    .container { max-width:600px; margin:0 auto; background:#fff; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.1); overflow:hidden; }
    .header img { display:block; width:100%; height:auto; }
    .body { padding:30px; color:#333; line-height:1.6; text-align:left; }
    .body h1 { margin-top:0; font-size:24px; color:#0e1e40; }
    .body p { margin-bottom:20px; font-size:15px; }
    .footer { background:#fafafa; text-align:center; padding:20px; font-size:12px; color:#777; }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="container">
      <div class="header">
        <img src="https://i.imgur.com/HJAApfe.png" alt="TRUALLIANT Header">
      </div>
      <div class="body">
        <h1>Training Schedule</h1>
        <p>Hello <strong>{$applicantName}</strong>,</p>
        <p>We’re excited to welcome you! Your Training will start on:</p>
        <p style="font-size:18px; color:#0e1e40; font-weight:600;">{$scheduleText}</p>
        <p><strong>Venue:</strong> Fancom Building, 4th Floor,<br>
           Huervana St., La Paz, Iloilo City</p>
        <p>Please arrive <strong>early</strong>.</p>
      </div>
      <div class="footer">
        <p>TRUALLIANT Training Team</p>
        <p>Questions? Just hit “Reply.”</p>
      </div>
    </div>
  </div>
</body>
</html>
HTML;

        // Plain-text fallback
        $mail->AltBody = "Hello {$applicantName},\n\n"
                       . "Your orientation is on {$scheduleText}.\n"
                       . "Venue: Fancom Building, 4th Floor, Huervana St., La Paz, Iloilo City\n"
                       . "Please arrive 10 minutes early with a photo ID.\n\n"
                       . "TRUALLIANT Recruitment Team";

        $mail->send();

        // 4) UPDATE orientation_status in DB
      $endorsementId = (int)$row['endorsement_id']; // from your SELECT

$upd = $conn->prepare("
  UPDATE training
     SET trainee_status = 'Email Sent'
   WHERE endorsement_id = ?
");
$upd->bind_param("i", $endorsementId);

        $upd->execute();
        $upd->close();

        $sent++;
    } catch (Exception $e) {
        error_log("Mail error to {$applicantEmail}: {$mail->ErrorInfo}");
    }
}

echo json_encode([
    'message' => "Sent Training Reminder to {$sent} applicant(s)."
]);
