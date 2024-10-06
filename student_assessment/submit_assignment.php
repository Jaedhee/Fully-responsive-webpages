<?php
// session_start();
// if (!isset($_SESSION['student'])) {
//     header("Location: student_login.php");
//     exit();
// }
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['assignment'])) {
    $student_id = $_POST['student'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["assignment"]["name"]);
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["assignment"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC & DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO submissions (assessment_id, student_id, file_path) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $assessment_id, $student_id, $target_file);

            if ($stmt->execute()) {
                echo "The file ". basename($_FILES["assignment"]["name"]). " has been uploaded.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Assignment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Submit Assignment</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                
            </div>
            <div class="form-group">
                <label for="assignment">Upload Assignment</label>
                <input type="file" class="form-control-file" id="assignment" name="assignment" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Assignment</button>
        </form>
    </div>
</body>
</html>

