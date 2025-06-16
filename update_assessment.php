<?php
session_start();
include 'includes/conn.php';
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

// Autoload Composer packages
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Collect and sanitize POST data
$source_id        = intval($_POST['source_id'] ?? 0);
$comprehension    = intval($_POST['comprehension'] ?? 0);
$pronunciation    = intval($_POST['pronunciation'] ?? 0);
$active_listening = intval($_POST['active_listening'] ?? 0);
$diction          = intval($_POST['diction'] ?? 0);
$intonation       = intval($_POST['intonation'] ?? 0);
$typing_test      = intval($_POST['typing_test'] ?? 0);
$script_reading   = intval($_POST['script_reading'] ?? 0);
$link             = $_POST['link'] ?? '';
$total_score      = floatval($_POST['total_score'] ?? 0);

// Applicant info from POST
$applicant_email  = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$applicant_name   = trim($_POST['name'] ?? 'Applicant');

// Determine assessment status
$assessment_status = ($total_score < 3) ? 'Failed' : 'Passed';
// Pick a color
$statusColor = $assessment_status === 'Passed' 
    ? '#28a745'  // green
    : '#dc3545'; // red
if ($assessment_status === 'Passed') {
    $nextSteps = <<<TXT
Congratulations on passing! 🎉<br>
Please await our upcoming email with your <em>orientation schedule</em><br>
and the <em>official job-offer</em> details.
TXT;
} else {
    $nextSteps = <<<TXT
We’re sorry you didn’t pass this time. 😞<br>
You may review your results and reapply in three months—<br>
keep an eye on our careers page for new openings.
TXT;
}


try {
    // Upsert into assessment table
    $check = $conn->prepare("SELECT 1 FROM assessment WHERE source_id = ?");
    $check->bind_param("i", $source_id);
    $check->execute();
    $check->store_result();
    $exists = $check->num_rows > 0;
    $check->close();

    if ($exists) {
        $stmt = $conn->prepare("
            UPDATE assessment
               SET comprehension     = ?,
                   pronunciation     = ?,
                   active_listening  = ?,
                   diction           = ?,
                   intonation        = ?,
                   typing_test       = ?,
                   script_reading    = ?,
                   link              = ?,
                   total_score       = ?,
                   assessment_status = ?
             WHERE source_id        = ?
        ");
        $stmt->bind_param(
            "iiiiiiisdsi",
            $comprehension,
            $pronunciation,
            $active_listening,
            $diction,
            $intonation,
            $typing_test,
            $script_reading,
            $link,
            $total_score,
            $assessment_status,
            $source_id
        );
    } else {
        $stmt = $conn->prepare("
            INSERT INTO assessment (
              source_id, comprehension, pronunciation,
              active_listening, diction, intonation,
              typing_test, script_reading, link,
              total_score, assessment_status
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?)
        ");
        $stmt->bind_param(
            "iiiiiiiisds",
            $source_id,
            $comprehension,
            $pronunciation,
            $active_listening,
            $diction,
            $intonation,
            $typing_test,
            $script_reading,
            $link,
            $total_score,
            $assessment_status
        );
    }
    $stmt->execute();
    $stmt->close();

    // Send email via PHPMailer
if ($applicant_email) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jethrodelima.qgc@gmail.com';
        $mail->Password   = 'wksm kpge jvgb ixqj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('no-reply@qgc.com', 'TRUALLIANT Recruitment Team');
        $mail->addAddress($applicant_email, $applicant_name);

        $mail->isHTML(true);
        $mail->Subject = 'Your Assessment Breakdown';
       $mail->Body = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Assessment Result</title>
  <style>
    body { margin:0; padding:0; background:#f4f6f8; font-family: 'Helvetica Neue', Arial, sans-serif; }
    .wrapper { width:100%; padding:30px 0; background:#f4f6f8; }
    .container { max-width:600px; margin:0 auto; background:#ffffff; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05); overflow:hidden; }
    .header img { display:block; width:100%; height:auto; }
    .intro { text-align:center; padding:30px 30px 10px 30px; }
    .intro h1 { margin:0 0 10px; color:#0e1e40; font-size:24px; }
    .intro p { color:#555; font-size:16px; margin:0; }
    .body { padding:20px 30px; }
    .body p { margin:0 0 20px; color:#555555; font-size:16px; line-height:1.5; }
    .details { width:100%; border-collapse:collapse; margin-bottom:20px; }
    .details th, .details td { padding:12px 15px; }
    .details th { text-align:left; background:#f0f4f8; color:#333333; font-weight:600; }
    .details td { background:#ffffff; color:#555555; }
    .details tr:nth-child(even) td { background:#fbfcfd; }
    .next-steps { background:#eef5ff; border-left:4px solid #0e1e40; padding:15px 20px; margin-bottom:20px; border-radius:4px; color:#333333; font-size:16px; }
    .footer { background:#fafafa; text-align:center; padding:20px; font-size:14px; color:#999999; }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="container">
      <div class="header">
        <img src="https://i.imgur.com/HJAApfe.png" alt="TRUALLIANT Header">
      </div>
      <div class="intro">
        <h1>Hello, {$applicant_name}!</h1>
        <p>Here’s the detailed breakdown of your assessment scores:</p>
      </div>
      <div class="body">
        <table class="details">
          <tr><th>Pronunciation</th><td>{$pronunciation}</td></tr>
          <tr><th>Active Listening</th><td>{$active_listening}</td></tr>
          <tr><th>Diction</th><td>{$diction}</td></tr>
          <tr><th>Intonation</th><td>{$intonation}</td></tr>
          <tr><th>Typing Test</th><td>{$typing_test}</td></tr>
          <tr><th>Script Reading</th><td>{$script_reading}</td></tr>
          <tr><th>Total Score<br><small>(Average)</small></th><td><strong>{$total_score}</strong></td></tr>
          <tr><th>Status</th><td style="color: {$statusColor};"><strong>{$assessment_status}</strong></td></tr>
        </table>
        <div class="next-steps">
          {$nextSteps}
        </div>
        <p>Thank you for your time and effort in this process!</p>
      </div>
      <div class="footer">
        This message was sent by RECRUITMENT | TRUALLIANT
      </div>
    </div>
  </div>
</body>
</html>
HTML;

        $mail->send();
    } catch (Exception $e) {
        error_log("Mail error: {$mail->ErrorInfo}");
    }
}

echo json_encode([
    'status'=>'success',
    'message'=>'Assessment saved and notification sent.',
    'source_id'=>$source_id
]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
