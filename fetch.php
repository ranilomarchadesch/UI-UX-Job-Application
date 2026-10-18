<?php
require_once "dbconfig.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit("Invalid application ID.");
}

$stmt = $conn->prepare(
    "SELECT * FROM job_applications WHERE application_id = :id"
);

$stmt->execute([":id" => $id]);
$app = $stmt->fetch();

if (!$app) {
    exit("Application not found.");
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            padding: 25px;
        }

        .card {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            box-sizing: border-box;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            background: #6254c7;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        a {
            background: #666;
        }
    </style>
</head>

<body>
<div class="card">
    <h1>Edit Application</h1>

    <form action="update.php" method="POST">
        <input
            type="hidden"
            name="application_id"
            value="<?= (int)$app["application_id"] ?>"
        >

        <label for="first_name">First Name</label>
        <input
            id="first_name"
            name="first_name"
            value="<?= e($app["first_name"]) ?>"
            required
        >

        <label for="last_name">Last Name</label>
        <input
            id="last_name"
            name="last_name"
            value="<?= e($app["last_name"]) ?>"
            required
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= e($app["email"]) ?>"
            required
        >

        <label for="phone">Contact Number</label>
        <input
            id="phone"
            name="phone"
            value="<?= e($app["phone"]) ?>"
            required
        >

        <label for="education">Educational Background</label>
        <input
            id="education"
            name="education"
            value="<?= e($app["education"]) ?>"
            required
        >

        <label for="design_tools">Design Tools</label>
        <input
            id="design_tools"
            name="design_tools"
            value="<?= e($app["design_tools"]) ?>"
            required
        >

        <label for="design_skills">Design Skills</label>
        <textarea
            id="design_skills"
            name="design_skills"
            rows="4"
            required
        ><?= e($app["design_skills"]) ?></textarea>

        <label for="portfolio_link">Portfolio Link</label>
        <input
            type="url"
            id="portfolio_link"
            name="portfolio_link"
            value="<?= e($app["portfolio_link"]) ?>"
        >

        <button type="submit">Save Changes</button>
        <a href="index.php">Cancel</a>
    </form>
</div>
</body>
</html>