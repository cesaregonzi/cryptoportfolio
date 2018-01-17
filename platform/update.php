<?php

session_start();
include 'connect.php';

$user = $_SESSION['username'];
$values = $_POST['values'];

$value = explode("&", $values);
$leftval = explode("=", $value[0]);
$rightval = explode("=", $value[1]);

$symbol = $_POST['symbol'];

$quantity = $leftval[1];
$price = $rightval[1];

if ($quantity && $price) {
	if (is_numeric($quantity) and is_numeric($price)) {
		mysqli_query($mysqli,"UPDATE portfolio set quantity=$quantity, buyprice=$price WHERE user='$user' AND symbol='$symbol'");
		header('Location: ./myportfolio.php');
	}

}


?>