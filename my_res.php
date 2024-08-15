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
$stdname = $_SESSION['username'];

$sql = "select * from user where username='$stdname'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();
// if (isset($_POST['update'])) {
//     $name = $_POST['name'];
//     $sem = $_POST['sem'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
    // $std_res = $_POST['result'];
    // $query = "UPDATE user SET username='$name', email='$email', phone='$phone', sem='$sem' ,password='$password' WHERE id='$id'";
    // $result2 = mysqli_query($data, $query);
    // if ($result2) {
    //     header("location:view_student.php");
    // }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
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
<h1>Student Dashboard</h1>

    <?php
    include 'student_sidebar.php'
    ?>

    <div class="content">

        <center>
            <h1>My Result</h1><br>

            <div class="div_deg">

                <form action="#" method="POST">
                    <div>
                        <label>Username: </label>
                        <?php echo "{$info['username']}"; ?>
                    </div>

                    <div>
                        <label>Semester: </label>
                        <?php echo "{$info['sem']}"; ?>
                    </div>
                    <div>
                        <label>Result: </label>
                        <?php echo "{$info['result']}"; ?>
                    </div>

                </form>
            </div>

        </center>




    </div>

</body>

</html>