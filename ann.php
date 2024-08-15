<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['name'])) {
    header("location:faculty_login.php");
} else if ($_SESSION['usertypeA'] == 'admin') {
    header("location:faculty_login.php");
}
$host = "127.0.0.1:3307";

$user = "root";

$password = "";

$db = "schoolproject";



$data = mysqli_connect($host, $user, $password, $db);
// $name = $_SESSION['name'];

// $sql1 = "select * from teacher where name='$name'";
// $result1 = mysqli_query($data, $sql1);
// $info2 = $result1->fetch_assoc();
// $t_sem = $info2['sem'];
// $sql2 = "select * from user where usertype='student' AND sem='$t_sem'";
// $result2 = mysqli_query($data, $sql2);
// $data = mysqli_connect($host, $user, $password, $db);
$name = $_SESSION['name'];

$sql = "select * from teacher where name='$name'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();
if (isset($_POST['add_ann'])) {
    $teachtext = $_POST['textbox'];
    // $Course_Code = $_POST['course_code'];
    // $Teacher_Name = $_POST['course_teacher'];

    //$usertype = "student";
    $sem_tech = $info['sem'];
    $sem_tech_name = $info['name'];

    $sql2 = "INSERT INTO annoucements (sem,textbox,teacher_n) 
        VALUES('$sem_tech','$teachtext','$sem_tech_name')";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        echo "<script type='text/javascript'>
                alert('Announcement Upload Success');
            </script>";
    } else {
        echo "Upload Failed";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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

    <div class="content">
        <center>
            <h1>Announcements</h1>
            <?php
            if ($_SESSION['message']) {
                echo $_SESSION['message'];
            }
            unset($_SESSION['message']);
            ?>
            <br><br>
            <form action="#" method="post" enctype="multipart/form-data">
                <table border="1px">
                    <tr>
                        <th style="padding: 20px; font-size: 20px;">Announcements</th>


                    </tr>
                    <?php
                    //while ($info = $result2->fetch_assoc()) {
                    ?>
                    <tr>
                        <td style="padding: 20px; background-color: skyblue;">
                            <textarea name="textbox"></textarea>

                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                            <div>
                                <input type="submit" class="btn btn-primary" name="add_ann" value="Add">
                            </div>
                        </td>

                    </tr>

                    <?php

                    ?>
                </table>
            </form>

        </center>
    </div>

</body>

</html>