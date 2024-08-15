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
$id = $_GET['student_id'];

$sql = "select * from user where id='$id'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $sem = $_POST['sem'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $query = "UPDATE user SET username='$name', email='$email', phone='$phone', sem='$sem' ,password='$password' WHERE id='$id'";
    $result2 = mysqli_query($data, $query);
    if ($result2) {
        header("location:view_student.php");
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
            <h1>Update Student</h1><br>

            <div class="div_deg">

                <form action="#" method="POST">
                    <div>
                        <label>Username</label>
                        <input type="text" name="name" value="<?php echo "{$info['username']}"; ?>" </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo "{$info['email']}"; ?>" </div>
                            <div>
                                <label>Phone</label>
                                <input type="number" name="phone" value="<?php echo "{$info['phone']}"; ?>" </div>
                                <div>
                                    <label>Semester</label>
                                    <input type="text" name="sem" value="<?php echo "{$info['sem']}"; ?>" </div>
                                    <div>
                                        <label>Password</label>
                                        <input type="text" name="password" value="<?php echo "{$info['password']}"; ?>" </div>
                                        <div>
                                            <input type="submit" class="btn btn-success" name="update" value="Update">
                                        </div>
                </form>
            </div>

        </center>




    </div>

</body>

</html>