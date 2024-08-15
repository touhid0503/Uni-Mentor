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
$name = $_SESSION['name'];

$sql1 = "select * from teacher where name='$name'";
$result1 = mysqli_query($data, $sql1);
$info2 = $result1->fetch_assoc();
$t_sem = $info2['sem'];
$sql2 = "select * from user where usertype='student' AND sem='$t_sem'";
$result2 = mysqli_query($data, $sql2);
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
            <h1>Student Data</h1>
            <?php
            if ($_SESSION['message']) {
                echo $_SESSION['message'];
            }
            unset($_SESSION['message']);
            ?>
            <br><br>
            <table border="1px">
                <tr>
                    <th style="padding: 20px; font-size: 20px;">UserName</th>
                    <th style="padding: 20px; font-size: 20px;">Email</th>
                    <th style="padding: 20px; font-size: 20px;">Phone</th>
                    <th style="padding: 20px; font-size: 20px;">Semester</th>
                    <!-- <th style="padding: 20px; font-size: 20px;">Password</th> -->
                    <!-- <th style="padding: 20px; font-size: 20px;">Delete</th> -->
                    <!-- <th style="padding: 20px; font-size: 20px;">Update</th>  -->

                </tr>
                <?php
                while ($info = $result2->fetch_assoc()) {
                ?>
                    <tr>
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "{$info['username']}";
                            ?>
                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "{$info['email']}";
                            ?>
                        </td>
                        <td style="padding: 20px;  background-color: skyblue;">
                            <?php
                            echo "{$info['phone']}";
                            ?>
                        </td>
                        <td style="padding: 20px;  background-color: skyblue;">
                            <?php
                            echo "{$info['sem']}";
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