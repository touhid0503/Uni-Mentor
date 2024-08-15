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

$sql = "select * from user where usertype='student'";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

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
                    <th style="padding: 20px; font-size: 20px;">Password</th>
                    <th style="padding: 20px; font-size: 20px;">Delete</th>
                    <th style="padding: 20px; font-size: 20px;">Update</th>

                </tr>
                <?php
                while ($info = $result->fetch_assoc()) {
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
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "{$info['password']}";
                            ?>
                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "<a class='btn btn-danger' onclick=\" javascript:return confirm('Are you sure to delete this?'); \" href='delete.php?student_id={$info['id']}'>Delete</a>";
                            ?>
                        </td>
                        <td style="padding: 20px; background-color: skyblue;">
                            <?php
                            echo "<a class='btn btn-primary' href='update_student.php?student_id={$info['id']}'>Update</a>";
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