<?php
session_start();
$email=$_SESSION['email'];
$sql=mysqli_connect("localhost","root","","EmailApp");
$mails=json_decode(stripslashes($_GET['mailsTBD']));
foreach ($mails as $mail){
    $str="UPDATE `$email` SET `readflag`=1 WHERE `id`=$mail";
    mysqli_query($sql,$str);
}