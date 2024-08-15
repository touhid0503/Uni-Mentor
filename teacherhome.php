<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:faculty_login.php");
}
else if ($_SESSION['usertypeA'] == 'admin') {
    header("location:faculty_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <?php
    include 'admin_css.php'
    ?>
</head>

<body>

    <h1>Teacher Dashboard</h1>

    <?php
    include 'teacher_sidebar.php'
    ?>

</body>

</html>