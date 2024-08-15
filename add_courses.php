<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'student') {
    header("location:admin_login.php");
}
$host = "127.0.0.1:3307";
// $host="http://127.0.0.1:8080";

$user = "root";

$password = "";

$db = "schoolproject";


$data = mysqli_connect($host, $user, $password, $db);
if (isset($_POST['add_course'])) {
    $Course_Title = $_POST['course_title'];
    $Course_Code = $_POST['course_code'];
    $Teacher_Name = $_POST['course_teacher'];
    $sem=$_POST['sem'];
   
    //$usertype = "student";
    $check = "SELECT * FROM courses WHERE coursecode='$Course_Code'";
    $check_course = mysqli_query($data, $check);
    $row_count = mysqli_num_rows($check_course);
    if ($row_count == 0) {
        $sql = "INSERT INTO courses (coursetitle,coursecode,sem,teachername) 
        VALUES('$Course_Title','$Course_Code','$sem','$Teacher_Name')";
        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "<script type='text/javascript'>
                alert('Course Upload Success');
            </script>";
        } else {
            echo "Upload Failed";
        }
    } else {
        //echo "Username Already Exist. Try Another One";
        echo "<script type='text/javascript'>
                alert('CourseCode Already Exist. Try Another One');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>\Admin Dashboard</title>
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
            <h1>Add Courses</h1>

            <div class="div_deg">

                <form action="#" method="POST">
                    <div>
                        <label>Course Title</label>
                        <input type="text" name="course_title">
                    </div>
                    <div>
                        <label>Course Code</label>
                        <input type="text" name="course_code">
                    </div>
                    <div>
                        <label>Semester</label>
                        <input type="text" name="sem">
                    </div>
                    <div>
                        <label>Teacher Name</label>
                        <input type="text" name="course_teacher">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="add_course" value="Add Course">
                    </div>
                </form>
            </div>

        </center>
    </div>

</body>

</html>