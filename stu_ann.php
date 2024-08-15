<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} else if ($_SESSION['usertype'] == 'admin') {
    header("location:login.php");
}
$host = "127.0.0.1:3307";

$user = "root";

$password = "";

$db = "schoolproject";


$data = mysqli_connect($host, $user, $password, $db);
$name = $_SESSION['username'];

$sql = "select * from user where username='$name'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();
$stu_sem = $info['sem'];
$sql2 = "select * from  annoucements Where sem='$stu_sem'";
$result2 = mysqli_query($data, $sql2);
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>

    <?php
    include 'admin_css.php';
    ?>


</head>

<body>
    <h1>Student Dashboard</h1>

    <?php
    include 'student_sidebar.php'
    ?>

    <div class="content">
        <center>
            <h1>View Announcements</h1>
            <?php
            if ($_SESSION['message']) {
                echo $_SESSION['message'];
            }
            unset($_SESSION['message']);
            ?>
            <br><br>
            <table border="1px">
                <tr>
                <th style="padding: 20px; font-size: 20px;">Semester</th>
                <th style="padding: 20px; font-size: 20px;">Teacher Name</th>
                <th style="padding: 20px; font-size: 20px;">Announcements</th>


                </tr>
                <?php
                while ($info2 = $result2->fetch_assoc()) {
                ?>
                    <tr>
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "{$info2['sem']}";
                            ?>
                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "{$info2['teacher_n']}";
                            ?>
                        </td>

                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "{$info2['textbox']}";
                            ?>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </table>

        </center>
    </div>

</body>

</html>