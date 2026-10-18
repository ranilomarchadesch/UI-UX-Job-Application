<?php
require_once "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, "application_id", FILTER_VALIDATE_INT);

$first_name = trim($_POST["first_name"] ?? "");
$last_name = trim($_POST["last_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$education = trim($_POST["education"] ?? "");
$design_tools = trim($_POST["design_tools"] ?? "");
$design_skills = trim($_POST["design_skills"] ?? "");
$portfolio_link = trim($_POST["portfolio_link"] ?? "");

if (!$id || $id < 1) {
    exit("Invalid application ID.");
}

if (
    $first_name === "" ||
    $last_name === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $phone === "" ||
    $education === "" ||
    $design_tools === "" ||
    $design_skills === ""
) {
    exit("Please complete all required fields with valid information.");
}

if (
    $portfolio_link !== "" &&
    !filter_var($portfolio_link, FILTER_VALIDATE_URL)
) {
    exit("Please enter a valid portfolio URL.");
}

$sql = "UPDATE job_applications SET
        first_name = :first_name,
        last_name = :last_name,
        email = :email,
        phone = :phone,
        education = :education,
        design_tools = :design_tools,
        design_skills = :design_skills,
        portfolio_link = :portfolio_link
        WHERE application_id = :id";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":first_name" => $first_name,
    ":last_name" => $last_name,
    ":email" => $email,
    ":phone" => $phone,
    ":education" => $education,
    ":design_tools" => $design_tools,
    ":design_skills" => $design_skills,
    ":portfolio_link" => $portfolio_link !== "" ? $portfolio_link : null,
    ":id" => $id
]);

header("Location: index.php?success=updated");
exit;
?>