<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$email=$_SESSION['email'];
$str="SELECT * FROM `$email` WHERE 1=1";
$res=mysqli_query($sql,$str);
$mails=array();
while ($arr=mysqli_fetch_assoc($res))
{
    $mails[]=$arr;
}
echo json_encode($mails);