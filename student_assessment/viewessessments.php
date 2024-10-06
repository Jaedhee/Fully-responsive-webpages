<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Uncomment this if you need to restrict access to logged-in students only
// if (!isset($_SESSION['student'])) {
//     header("Location: student_login.php");
//     exit();
// }

include 'db.php';

$sql = "SELECT id, course, assessment_type, assessment_question, semester, level, assessment_date FROM assessments";
$result = $conn->query($sql);
if (!$result){
    die("Query failed: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matriculation_number = $_POST['matriculation_number'];
    $assessment_response = $_POST['assessment_response'];
    $assessment_id = $_POST['assessment_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO submission (matriculation_number, file_path, assessment_id) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $bind = $stmt->bind_param("ssi", $matriculation_number, $assessment_response, $assessment_id);
    if ($bind === false) {
        die("Bind failed: " . $stmt->error);
    }

    // Execute the statement
    $exec = $stmt->execute();
    if ($exec) {
        $success_message = "Assessment submitted successfully.";
    } else {
        $error_message = "Error submitting assessment: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assessment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Available Assessments</h2>
        <?php if (isset($success_message)) echo "<div class='alert alert-success'>$success_message</div>"; ?>
        <?php if (isset($error_message)) echo "<div class='alert alert-danger'>$error_message</div>"; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Assessment Type</th>
                    <th>Assessment Question</th>
                    <th>Semester</th>
                    <th>Level</th>
                    <th>Assessment Date</th>
                    <!-- <th>Submit</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['assessment_type']; ?></td>
                            <td><?php echo $row['assessment_question']; ?></td>
                            <td><?php echo $row['semester']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td><?php echo $row['assessment_date']; ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="assessment_id" value="<?php echo $row['id']; ?>">
                                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No Available Assessments.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Submit Your Assessment</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="assessment_id">Assessment ID</label>
                <input type="text" class="form-control" id="assessment_id" name="assessment_id" required>
            </div>
            <div class="form-group">
                <label for="matriculation_number">Matriculation Number</label>
                <input type="text" class="form-control" id="matriculation_number" name="matriculation_number" required>
            </div>
            <div class="form-group">
                <label for="assessment_response">Assessment Response</label>
                <textarea class="form-control" id="assessment_response" name="assessment_response" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
