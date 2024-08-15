<?php 

error_reporting(0);
session_start();

	
$host="127.0.0.1:3307";

$user="root";

$password="";

$db="schoolproject";


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
	
}

		
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$name = $_POST['name'];

		$pass = $_POST['password'];


		$sql="select * from teacher where name='".$name."' AND password='".$pass."'  ";

		$result=mysqli_query($data,$sql);

		$row=mysqli_fetch_array($result);



		if($row["usertypeA"]=="admin")
		{
			
			$_SESSION['name']=$name;

			$_SESSION['usertypeA']="admin";

			//header("location:teacherhome.php");
		}

		elseif($row["usertypeA"]=="teacher")
		{	
			
			$_SESSION['name']=$name;

			$_SESSION['usertypeA']="teacher";

			header("location:teacherhome.php");
		}

		else
		{
			
			
			$message= "username or password do not match";

			$_SESSION['loginMessage']=$message;

			header("location:faculty_login.php");
		}


	}

	
?>