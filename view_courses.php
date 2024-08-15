<?php

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
$sql = "select * from courses";
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
            <h1>View Courses</h1>
            <br><br>
            <table border="1px">
                <tr>
                    <th style="padding: 20px; font-size: 15px;">Course Title</th>
                    <th style="padding: 20px; font-size: 15px;">Course Code</th>
                    <th style="padding: 20px; font-size: 15px;">Semester</th>

                    <th style="padding: 20px; font-size: 15px;">Teacher Name</th>
                    
                    <th style="padding: 20px; font-size: 20px;">Delete</th>
                    <th style="padding: 20px; font-size: 20px;">Update</th>
                </tr>
                <?php
                while ($info = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['coursetitle']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['coursecode']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['sem']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['teachername']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "<a class='btn btn-danger' onclick=\" javascript:return confirm('Are you sure to delete this?'); \" href='delete.php?course_id={$info['id']}'>Delete</a>";
                            ?>
                        </td>
                        <td style="padding: 20px">
                            <?php
                            echo "<a class='btn btn-primary' href='update_courses.php?teacher_name={$info['teachername']}'>Update</a>";
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