<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'student') {
    header("location:admin_login.php");
}
$host = "127.0.0.1:3307";
// $host="http://127.0.0.1:8080";
$user = "root";

$password = "";

$db = "schoolproject";


$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['add_teacher'])) {
    $t_name = $_POST['name'];
    $t_sem=$_POST['sem'];
    $t_password = $_POST['password'];
    $usertypeA = "teacher";
    $t_description = $_POST['description'];
    $file = $_FILES['image']['name'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    $check = "SELECT * FROM teacher WHERE name='$t_name'";
    $check_teacher = mysqli_query($data, $check);
    $row_count = mysqli_num_rows($check_teacher);
    if ($row_count == 0) {
        $sql = "Insert into teacher (name,description,sem,image,password,usertypeA) 
        Values ('$t_name','$t_description','$t_sem','$dst_db','$t_password','$usertypeA')";

        $result = mysqli_query($data, $sql);
        if ($result) {
            echo "<script type='text/javascript'>
                alert('Data Upload Success');
            </script>";
        } else {
            echo "Upload Failed";
        }
    } else {
        //echo "Username Already Exist. Try Another One";
        echo "<script type='text/javascript'>
                alert('Teachername Already Exist. Try Another One');
            </script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>\Admin Dashboard</title>
    <style type="text/css">
        /*label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }*/

        .div_deg {
            background-color: skyblue;
            width: 500px;
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
            <h1>Add Teacher</h1><br><br>

            <div class="div_deg">

                <form action="#" method="POST" enctype="multipart/form-data">
                    <div>
                        <label>Teacher Name :</label>
                        <input type="text" name="name">
                    </div>
                    <br>
                    <div>
                        <label>Description :</label>
                        <textarea name="description"></textarea>
                    </div>
                    <br>
                    <div>
                        <label>Image :</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label>Semester :</label>
                        <input type="text" name="sem">
                    </div>
                    <br>
                    <div>
                        <label>Password</label>
                        <input type="text" name="password">
                    </div>
                    <br>
                    <div>
                        <input type="submit" class="btn btn-primary" name="add_teacher" value="Add Teacher">
                    </div>
                </form>
            </div>

        </center>
    </div>

</body>

</html>