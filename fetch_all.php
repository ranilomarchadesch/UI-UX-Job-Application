<?php
require_once "dbconfig.php";

$stmt = $conn->query(
    "SELECT * FROM job_applications ORDER BY application_id DESC"
);

$applications = $stmt->fetchAll();
?>