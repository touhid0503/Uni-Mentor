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
if($_GET['admission_id']){
    $user_id=$_GET['admission_id'];
    $sql = "delete from admission where id='$user_id'";
    $result = mysqli_query($data, $sql);
    if($result){
        $_SESSION['message']='Delete Student is successful';
        header("location: admission.php");
    }
}
if($_GET['student_id']){
    $user_id=$_GET['student_id'];
    $sql = "delete from user where id='$user_id'";
    $result = mysqli_query($data, $sql);
    if($result){
        $_SESSION['message']='Delete Student is successful';
        header("location: view_student.php");
    }
}
if($_GET['teacher_id']){
    $t_id=$_GET['teacher_id'];
    $sql2 = "delete from teacher where id='$t_id'";
    $result2 = mysqli_query($data, $sql2);
    if($result2){
        $_SESSION['message']='Delete Teacher is successful';
        header("location: view_teacher.php");
    }
}
if($_GET['course_id']){
    $user_id=$_GET['course_id'];
    $sql = "delete from courses where id='$user_id'";
    $result = mysqli_query($data, $sql);
    if($result){
        $_SESSION['message']='Delete Course is successful';
        header("location: view_courses.php");
    }
}

?>