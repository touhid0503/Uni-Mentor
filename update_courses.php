<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'student') {
    header("location:admin_login.php");
}
$host = "127.0.0.1:3307";

$user = "root";

$password = "";

$db = "schoolproject";


$data = mysqli_connect($host, $user, $password, $db);
$t_name = $_GET['teacher_name'];

$sql = "select * from courses where teachername='$t_name'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();
if (isset($_POST['update_cou'])) {
    $title = $_POST['course_title'];
    $sem = $_POST['sem'];
    $code = $_POST['course_code'];
    // $tea_name = $_POST['course_teacher'];
    // $password = $_POST['password'];
    $query = "UPDATE courses SET coursetitle='$title', coursecode='$code', sem='$sem' WHERE teachername='$t_name'";
    $result2 = mysqli_query($data, $query);
    if ($result2) {
        header("location:view_courses.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
    <?php
    include 'admin_css.php'
    ?>
</head>

<body>

    <?php
    include 'admin_sidebar.php'
    ?>

    <div class="content">

        <center>
            <h1>Update Courses</h1><br>

            <div class="div_deg">

                <form action="#" method="POST">
                    <div>
                        <label>Course Title</label>
                        <input type="text" name="course_title" value="<?php echo "{$info['coursetitle']}"; ?>" </div>
                        <div>
                            <label>Course Code</label>
                            <input type="text" name="course_code" value="<?php echo "{$info['coursecode']}"; ?>" </div>
                            <div>
                                <label>Semester</label>
                                <input type="text" name="sem" value="<?php echo "{$info['sem']}"; ?>" </div>
                                <div>
                                    <label>Teacher Name</label>
                                    <?php echo "{$info['teachername']}"; ?>
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-success" name="update_cou" value="Update">
                                </div>
                </form>
            </div>

        </center>




    </div>

</body>

</html>