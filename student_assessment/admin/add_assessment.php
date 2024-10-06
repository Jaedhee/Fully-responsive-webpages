<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST['course'];
    $assessment_type = $_POST['assessment_type'];
    $assessment_question = $_POST['assessment_question'];
    $semester = $_POST['semester'];
    $level = $_POST['level'];
    $assessment_date = $_POST['assessment_date'];

    $sql = "INSERT INTO assessments (course, assessment_type, assessment_question, semester, level, assessment_date) 
            VALUES ('$course', '$assessment_type', '$assessment_question', '$semester', '$level', '$assessment_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "New assessment added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assessment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h1 class="card-title">Add New Assessment</h1>
                <?php if (isset($message)): ?>
                    <div class="alert alert-info">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="add_assessment.php">
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" class="form-control" id="course" name="course" required>
                    </div>
                    <div class="form-group">
                        <label for="assessment_type">Assessment Type</label>
                        <select class="form-control" id="assessment_type" name="assessment_type" required>
                            <option value="test">Test</option>
                            <option value="term paper">Term Paper</option>
                            <option value="assignment">Assignment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course">assessment_question</label>
                        <input type="text" class="form-control" id="course" name="assessment_question" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester" required>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="ND1">ND1</option>
                            <option value="ND2">ND2</option>
                            <option value="HND1">HND1</option>
                            <option value="HND2">HND2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assessment_date">Assessment Date</label>
                        <input type="date" class="form-control" id="assessment_date" name="assessment_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Assessment</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
