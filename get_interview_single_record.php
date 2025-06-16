<?php
include 'includes/conn.php';
$id = $_GET['id'];

$sql = "SELECT 
    s.source_id,
    s.mode,
    s.source_date,
    s.source_by,
    s.recruiter,
    s.scheduled_interview,
    s.status,
    p.name, p.phone, p.age, p.birthdate, p.email, p.address,
    p.city_municipality, p.educational_attainment, p.name_of_school, p.year_last_attended,
    i.bpo_exp, i.expected_salary, i.previous_salary, i.incentives, i.benefits,
    i.reason_for_leaving, i.medical_condition, i.can_work_shifting_sched,
    i.can_work_weekend_holidays, i.can_work_onsite, i.fully_vaccinated,
    i.currently_studying, i.initial_interview, i.second_call_attempt, i.third_call_attempt
  FROM source s
  LEFT JOIN personal_info p     ON s.source_id = p.source_id
  LEFT JOIN initial_interview i ON s.source_id = i.source_id
        WHERE s.source_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
