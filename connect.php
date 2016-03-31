<?php
$mysqli = new mysqli("localhost", "USER", "PASSWORD", "DATABASENAME");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

/* PROCEDURAL version
$mysqli = mysqli_connect("localhost", "USER", "PASSWORD", "DATABASENAME");
if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

*/

?>
