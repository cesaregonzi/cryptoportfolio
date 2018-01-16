<?php

$dbname = 'crypto';
$dbuser = 'root';
$dbpass = '';
$dbhost = 'localhost';
//$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to connect to '$dbhost'");
//mysqli_select_db($dbname) or die("Could not open the database '$dbname'");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* change db to world db */
$mysqli->select_db("crypto");

/* return name of current default database */
if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    //printf("Default database is %s.\n", $row[0]);
    $result->close();
}



?>