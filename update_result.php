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
$stdname = $_GET['student_name'];

$sql = "select * from user where username='$stdname'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();
if (isset($_POST['update_r'])) {
    $std_resu = $_POST['result'];
    
    $query = "UPDATE user SET result='$std_resu' WHERE username='$stdname'";
    $result2 = mysqli_query($data, $query);
    if ($result2) {
        header("location:result.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Teacher Dashboard</title>
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
    include 'teacher_sidebar.php'
    ?>

    <div class="content">

        <center>
            <h1>Update Result</h1><br>

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
                    <!-- <div> -->

                        <div>
                            <label>Result: </label>
                            <input type="text" name="result" value="<?php echo "{$info['result']}"; ?>" </div>
                            <div>
                                <input type="submit" class="btn btn-success" name="update_r" value="Update" href='my_res.php?student_name={$info['username']}'>
                            </div>
                </form>
            </div>

        </center>




    </div>

</body>

</html>