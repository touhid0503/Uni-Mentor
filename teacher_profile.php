<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['name'])) {
    header("location:faculty_login.php");
}
else if ($_SESSION['usertypeA'] == 'admin') {
    header("location:faculty_login.php");
}
$host = "127.0.0.1:3307";

$user = "root";

$password = "";

$db = "schoolproject";


$data = mysqli_connect($host, $user, $password, $db);
$name = $_SESSION['name'];

$sql = "select * from teacher where name='$name'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();

/*if ($_GET['teacher_id']) {
    $t_id = $_GET['teacher_id'];
    $sql = "select * from teacher where id='$t_id'";
    $result = mysqli_query($data, $sql);
    $info = $result->fetch_assoc();
}*/
if (isset($_POST['update_teacher_profile'])) {
   // $t_id = $_GET['teacher_id'];
   // $t_name = $_POST['name'];
    $t_des = $_POST['description'];
    $t_pass = $_POST['password'];
    $file = $_FILES['image']['name'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    if ($file) {
        $sql2 = "UPDATE teacher SET description='$t_des', image='$dst_db', password='$t_pass'  WHERE name='$name'";
    } else {
        $sql2 = "UPDATE teacher SET description='$t_des', password='$t_pass' WHERE name='$name'";
    }

    $result2 = mysqli_query($data, $sql2);
    if ($result2) {
        header('location:teacher_profile.php');
    }
    ///

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
    <h1>Teacher Dashboard</h1>
    <?php
    include 'teacher_sidebar.php'
    ?>

    <div class="content">

        <center>
            <h1>Update Profile</h1><br>

            <div class="div_deg">

                <form action="#" method="POST" enctype="multipart/form-data">

                    <div>
                        <label>About Teacher :</label>
                        <textarea name="description">
                                <?php echo "{$info['description']}"; ?>
                            </textarea>
                    </div>
                    <div>
                        <label>Teacher Old Image :</label>
                        <img height="100px" width="100px" src="<?php
                                                                echo "{$info['image']}"; ?>">
                    </div>

                    <div>
                        <label>Teacher New Image: </label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="text" name="password" value="<?php echo "{$info['password']}"; ?>" </div>
                        <input type="submit" class="btn btn-primary" name="update_teacher_profile" value="Update">
                    </div>
                </form>
            </div>

        </center>




    </div>

</body>

</html>