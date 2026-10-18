<?php
require_once "dbconfig.php";

$stmt = $conn->query(
    "SELECT * FROM job_applications ORDER BY application_id DESC"
);

$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI/UX Designer Job Application</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            color: #222;
            margin: 0;
            padding: 30px 15px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            background: #29264b;
            color: white;
            padding: 28px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 10px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .full {
            grid-column: 1 / -1;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d5d8e2;
            border-radius: 7px;
            font: inherit;
        }

        textarea {
            resize: vertical;
        }

        button, .action {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 7px;
            background: #6254c7;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .delete {
            background: #d64545;
        }

        .edit {
            background: #218568;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #e7e8ef;
        }

        th {
            background: #f0effa;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .message {
            background: #e3f6e9;
            color: #17653a;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>UI/UX Designer Application</h1>
        <p>Manage job applications and design portfolios.</p>
    </div>

    <?php if (isset($_GET["success"])): ?>
        <div class="message">
            <?php
            $messages = [
                "inserted" => "Application added successfully!",
                "updated" => "Application updated successfully!",
                "deleted" => "Application deleted successfully!"
            ];

            echo htmlspecialchars(
                $messages[$_GET["success"]] ?? "Operation completed."
            );
            ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Applicant Information</h2>
        <p>Fill in the form to submit a new application.</p>

        <form action="insert.php" method="POST">
            <div class="form-grid">

                <div class="field">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>

                <div class="field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>

                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="field">
                    <label for="phone">Contact Number</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="field">
                    <label for="education">Educational Background</label>
                    <input type="text" id="education" name="education" required>
                </div>

                <div class="field">
                    <label for="design_tools">Design Tools</label>
                    <input
                        type="text"
                        id="design_tools"
                        name="design_tools"
                        placeholder="Figma, Canva, Adobe XD"
                        required
                    >
                </div>

                <div class="field full">
                    <label for="design_skills">Design Skills</label>
                    <textarea
                        id="design_skills"
                        name="design_skills"
                        rows="3"
                        placeholder="UI design, UX research, wireframing, prototyping"
                        required
                    ></textarea>
                </div>

                <div class="field full">
                    <label for="portfolio_link">Portfolio Link (optional)</label>
                    <input
                        type="url"
                        id="portfolio_link"
                        name="portfolio_link"
                        placeholder="https://example.com"
                    >
                </div>

                <div class="field full">
                    <button type="submit">Submit Application</button>
                </div>

            </div>
        </form>
    </div>

    <div class="card">
        <h2>Submitted Applications</h2>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Education</th>
                    <th>Design Tools</th>
                    <th>Design Skills</th>
                    <th>Portfolio</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php if (count($applications) > 0): ?>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td><?= htmlspecialchars($app["application_id"]) ?></td>

                            <td>
                                <?= htmlspecialchars(
                                    $app["first_name"] . " " . $app["last_name"]
                                ) ?>
                            </td>

                            <td><?= htmlspecialchars($app["email"]) ?></td>
                            <td><?= htmlspecialchars($app["education"]) ?></td>
                            <td><?= htmlspecialchars($app["design_tools"]) ?></td>
                            <td><?= htmlspecialchars($app["design_skills"]) ?></td>

                            <td>
                                <?php if (!empty($app["portfolio_link"])): ?>
                                    <a
                                        href="<?= htmlspecialchars($app["portfolio_link"]) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >View</a>
                                <?php else: ?>
                                    None
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($app["date_added"]) ?></td>

                            <td>
                                <div class="actions">
                                    <a
                                        class="action edit"
                                        href="fetch.php?id=<?= (int)$app["application_id"] ?>"
                                    >Edit</a>

                                    <form
                                        action="delete.php"
                                        method="POST"
                                        onsubmit="return confirm('Delete this application?');"
                                    >
                                        <input
                                            type="hidden"
                                            name="application_id"
                                            value="<?= (int)$app["application_id"] ?>"
                                        >

                                        <button class="delete" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="9">No applications have been submitted yet.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>