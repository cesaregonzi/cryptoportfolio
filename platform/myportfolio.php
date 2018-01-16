<?php
@session_start();

include 'connect.php';

$user = $_SESSION['username'];


if ($user) {
	include 'header.html';
	include 'portfolio.html';

}

else{
	header('Location: ../index.html');
}
?>