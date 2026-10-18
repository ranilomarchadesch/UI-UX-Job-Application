<?php
require_once "fetch_all.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Job Applications</title>
</head>
<body>

<h1>UI/UX Designer Job Applications</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Education</th>
        <th>Design Tools</th>
        <th>Design Skills</th>
        <th>Portfolio</th>
        <th>Date Added</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($applications as $app): ?>
        <tr>
            <?php foreach ($app as $value): ?>
                <td><?= htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8") ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>

    <?php if (count($applications) === 0): ?>
        <tr>
            <td colspan="10">No applications found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<p><a href="index.php">Back to Application Form</a></p>

</body>
</html>