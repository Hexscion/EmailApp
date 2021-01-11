<?php
session_start();
$email=$_SESSION['email'];
$sql=mysqli_connect("localhost","root","","EmailApp");
$mails=$_GET['mailsTBD'];
foreach ($mails as $mail){
    $str="UPDATE `$email` SET `trash`=1 WHERE `id`=`$mail`";
    mysqli_query($sql,$str);
}