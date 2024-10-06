<?php
session_start();
session_unset();
session_destroy();
header("Location: Student_login.php");
exit();
?>
