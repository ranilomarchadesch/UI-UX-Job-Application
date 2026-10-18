<?php
require_once "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, "application_id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit("Invalid application ID.");
}

$stmt = $conn->prepare(
    "DELETE FROM job_applications WHERE application_id = :id"
);

$stmt->execute([":id" => $id]);

header("Location: index.php?success=deleted");
exit;
?>