<?php

if(isset($_POST['login']))
{
	//start of try block

	$aVar = mysqli_connect('localhost','root','','attmgsystem');

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password is required!");
			
		}
		//establishing connection with db and things
		// include ('connect.php');

		
		//checking login info into database
		$row=0;
		$result=mysqli_query($aVar, "select * from admininfo where username='$_POST[username]' and password='$_POST[password]' and type='$_POST[type]'");

		$row=mysqli_num_rows($result);

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>Attendance Management System</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" > -->
	 
	<!-- Optional theme -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" > -->
	 
	<link rel="stylesheet" href="styles.css" >
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<center>

<header>

  <h1>Attendance Management System</h1>

</header>

<h3>Login Panel</h3>

<?php
//printing error message
if(isset($error_msg))
{
		echo $error_msg;
	}
	?>

	<!-- Old Version -->
<!-- 
<form action="" method="post">
	
	<table>
		<tr>
			<td>Username </td>
			<td><input type="text" name="username"></input></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></input></td>
		</tr>
		<tr>
			<td>Role</td>
			<td>
			<select name="type">
				<option name="teacher" value="teacher">Teacher</option>
				<option name="student" value="student">Student</option>
				<option name="admin" value="admin">Admin</option>
			</select>
			</td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><button><input type="submit" name="login" value="Login"></input></button></td>
			<td><button><input type="reset" name="reset" value="Reset"></button></td>
		</tr>
	</table>
</form>
-->

<div class="content">
	<div class="row">

		<form method="post"">
			<div>
			    <label for="input1">Username</label>
			    <div>
			      <input type="text" name="username" id="input1" placeholder="Your Username" />
			    </div>
			</div>

			<div>
			    <label for="input1">Password</label>
			    <div>
			      <input type="password" name="password" id="input1" placeholder="Your Password" />
			    </div>
			</div>


			<div>
			<label for="input1">Login As:</label>
			<div>
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
			  </label>
			  	  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
			  </label>
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
			  </label>
			</div>
			</div>


			<input type="submit" value="Login" name="login" />
		</form>
	</div>
</div>

<p><strong><a href="reset.php">Reset Password</a></strong></p>
<p><strong><a href="signup.php">Create New Account</a></strong></p>

</center>
</body>
</html>