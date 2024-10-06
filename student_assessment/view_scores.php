<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Uncomment this if you want to ensure the student is logged in
// if (!isset($_SESSION['student'])) {
//     header("Location: student_login.php");
//     exit();
// }

include 'db.php';

$sql = "SELECT file_path AS submission, assessment_id, submission_date, score
        FROM submission";

$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Scores</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>View Scores</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Assessment ID</th>
                    <th>Submission</th>
                    <th>Submission Date</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['assessment_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['submission']); ?></td>
                            <td><?php echo htmlspecialchars($row['submission_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['score']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No submissions found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
