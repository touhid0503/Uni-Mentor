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



if ($_GET['teacher_id']) {
    $t_id = $_GET['teacher_id'];
    $sql = "select * from teacher where id='$t_id'";
    $result = mysqli_query($data, $sql);
    $info = $result->fetch_assoc();
}

if (isset($_POST['update_teacher'])) {
   
    $t_id = $_GET['teacher_id'];
    $t_name = $_POST['name'];
    $t_des = $_POST['description'];
    $t_sem= $_POST['sem'];
    $t_pass = $_POST['password'];
    $file = $_FILES['image']['name'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    if ($file) {
        $sql2 = "UPDATE teacher SET name='$t_name', description='$t_des', sem='$t_sem' , image='$dst_db', password='$t_pass'  WHERE id='$t_id'";
    } else {
        $sql2 = "UPDATE teacher SET name='$t_name', description='$t_des', sem='$t_sem' , password='$t_pass' WHERE id='$t_id'";
    }

    $result2 = mysqli_query($data, $sql2);
    if ($result2) {
        header('location:view_teacher.php');
    }
    ///

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
            width: 150px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .form_deg {
            background-color: skyblue;
            width: 600px;
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
            <h1>Update Teacher Data</h1><br>

            <div class="div_deg">

                <form class="form_deg" action="#" method="POST" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?php echo "{$info['id']}" ?>" hidden>

                    <div>
                        <label>Teacher Name :</label>
                        <input type="text" name="name" value="<?php echo "{$info['name']}"; ?>" </div>
                        <div>
                            <label>About Teacher :</label>
                            <textarea name="description">
                                <?php echo "{$info['description']}"; ?>
                            </textarea>
                        </div>
                        <div>
                        <label>Semester :</label>
                        <input type="text" name="sem" value="<?php echo "{$info['sem']}"; ?>" </div>
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
                            <div>
                                <input type="submit" class="btn btn-success" name="update_teacher">
                            </div>
                </form>
            </div>

        </center>




    </div>

</body>

</html>