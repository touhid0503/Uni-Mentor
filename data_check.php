<?php
error_reporting(0);
session_start();

$host = "127.0.0.1:3307";

$user = "root";

$password = "";

$db = "schoolproject";


$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}
if (isset($_POST['apply'])) {
    $data_name = $_POST['name'];
    $data_email = $_POST['email'];
    $data_phone = $_POST['phone'];
    $data_message = $_POST['message'];
    $data_password = $_POST['password'];
    $check = "SELECT * FROM user WHERE username='$data_name'";
    $check_user = mysqli_query($data, $check);
    $row_count = mysqli_num_rows($check_user);
    if ($row_count == 0) {
        $sql = "insert into admission(name,email,phone,message,password) 
         values('$data_name','$data_email','$data_phone','$data_message','$data_password') ";

        $result = mysqli_query($data, $sql);
        if ($result) {
            $_SESSION['message'] = "your application sent successful";
            header("location:index.html");
        } else {
            echo "Apply failed";
        }
    } else {
        $_SESSION['message'] = "your application sent unsuccessful";
        header("location:index.html");
        //echo "Username Already Exist. Try Another One";
        /*  echo "<script type='text/javascript'>
                alert('Username Already Exist. Try Another One');
                
            </script>";*/
    }
    //header("location:index.php");
}
