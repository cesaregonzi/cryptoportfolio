<?php
session_start();
include 'connect.php';

$user=$_POST['username']; // Fetching Values from URL.
$password=$_POST['password']; // Fetching Values from URL.

//check if username exists
if ($user) {
	@$result = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM users WHERE user='$user'"));
	if (!$result) {
		echo "Username not existing";
	}
	else {
		@$resultpsw = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM users WHERE password='$password' AND user='$user'"));
		if($resultpsw==1){
			echo $user . $password;
			$_SESSION['username'] = $user;
		}
		else{
			echo "Password is wrong";
		}
	}
}

else {
	echo "Missing";
}

?>