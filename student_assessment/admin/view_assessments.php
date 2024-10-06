<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submission_id = $_POST['submission_id'];
    $score = $_POST['score'];

    $sql = "UPDATE submission SET score = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $score, $submission_id);

    if ($stmt->execute()) {
        $message = "Score updated successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Query to fetch submissions and associated assessments
$sql = "SELECT s.id as submission_id, s.matriculation_number, s.file_path, s.score, a.course, a.assessment_type, a.semester, a.level, a.assessment_date 
        FROM submission s 
        JOIN assessments a ON s.assessment_id = a.id";

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
    <title>View Assessments</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h1 class="card-title">View Assessments</h1>
                <?php if (isset($message)): ?>
                    <div class="alert alert-info">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <table class="table table-bordered table-striped mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Submission ID</th>
                            <th>Matriculation Number</th>
                            <th>Course</th>
                            <th>Assessment Type</th>
                            <th>Semester</th>
                            
                            <th>Assessment Date</th>
                            <th>Submission</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['submission_id']}</td>
                                    <td>{$row['matriculation_number']}</td>
                                    <td>{$row['course']}</td>
                                    <td>{$row['assessment_type']}</td>
                                    <td>{$row['semester']}</td>
                                 
                                    <td>{$row['assessment_date']}</td>
                                    <td>{$row['file_path']}</td>
                                    <td>{$row['score']}</td>
                                    <td>
                                        <form method='POST' action='view_assessments.php'>
                                            <input type='hidden' name='submission_id' value='{$row['submission_id']}'>
                                            <input type='number' name='score' value='{$row['score']}' required>
                                            <button type='submit' class='btn btn-primary'>Assign Score</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No submissions found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
