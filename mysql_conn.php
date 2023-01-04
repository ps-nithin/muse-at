<?php
$servername="localhost";
$username="musemachine";
$password="musemachine";
$dbname="musemachine_db";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
  die("connection failed: ".$conn->connect_error);
}

?>
