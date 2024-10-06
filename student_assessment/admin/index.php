<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Assessment Repository</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Student Assessment System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_student.php">Register Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewstudent.php">View Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_assessment.php">Add Assessment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_assessments.php">View Submitted Assessments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to the Student Assessment Repository!</h1>
            <p class="lead">Manage and view student assessments easily with our intuitive system.</p>
            <hr class="my-4">
            <p>Choose an action below to get started:</p>
        </div>

        <!-- Cards Section -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-plus-circle"></i> Add Assessment</h5>
                        <p class="card-text">Add new assessments for students.</p>
                        <a href="add_assessment.php" class="btn btn-primary">Add Assessment</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-list-ul"></i> View Assessments</h5>
                        <p class="card-text">View all assessments recorded.</p>
                        <a href="view_assessments.php" class="btn btn-primary">View Assessments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-list-ul"></i> View Assessments</h5>
                        <p class="card-text">View all submitted assessments recorded.</p>
                        <a href="view_assessments.php" class="btn btn-primary">View Submitted Assessments</a>
                    </div>
                </div>
            </div>
            
            <!-- Add more cards or features as needed -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container text-center">
            <span class="text-muted">Student Assessment Repository &copy; <?php echo date("Y"); ?></span>
        </div>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
