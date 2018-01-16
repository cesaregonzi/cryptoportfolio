<?php
session_start();
$user = $_SESSION['username'];
$elements = $_POST['delete'];
print_r($elements);
include 'connect.php';

foreach ($elements as $key) {
	$cryptoDaCancellare = $key['value'];
	mysqli_query($mysqli, "DELETE FROM portfolio WHERE user='$user' AND symbol='$cryptoDaCancellare'");
}

?>