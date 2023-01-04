<?php
require("mysql_conn.php");
$username=$_GET['uname'];
$museid=$_GET['id'];
$page=$_GET['page'];

$n=1;
$n_start=$page*20+1;
$n_end=($page+1)*20;
$html="";
$mesg_array=array();
$rows=$conn->query("select inbox,timeinbox,outbox,timeoutbox from $username where sender='".$museid."' or receiver='".$museid."' order by id desc;"); 
while($row=$rows->fetch_assoc() and $n<=$n_end){
  $n++;
  if($n>$n_start){
    if(strlen($row['outbox'])==0){
      $out="";
      $in="<div class='mesg_row'><div class='mesg_content incoming_mesg'>".$row['inbox']."<br><div class='time_row'>".$row['timeinbox']."</div></div></div>";
    }else if(strlen($row['inbox'])==0){
      $in="";
      $out="<div class='mesg_row align_right'><div class='mesg_content outgoing_mesg'>".$row['outbox']."<br><div class='time_row align_right'>".$row['timeoutbox']."</div></div></div>";
    }
    array_push($mesg_array,$in.$out);
  }
  $conn->query("update $username set viewed='1' where sender='".$museid."';");
}

$mesg_array_r=array_reverse($mesg_array);
echo join("",$mesg_array_r);
?>
