<?php
include("mysql_conn.php");

//create table
$sql="create table users (id int(6) unsigned auto_increment primary key,
	username varchar(30) not null,
	password varchar(512) not null,
	email varchar(30) not null,
	fullname varchar(30) not null,
	delete_flag int(6) not null,
	deactivate_flag int(6) not null);";
if ($conn->query($sql)===true){
  echo "table 'users' created sucessfully.";
} else {
  echo "error creating table: ".$conn->error;
}
$conn->close();
?>
