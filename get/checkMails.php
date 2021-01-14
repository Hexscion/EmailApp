<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$email=$_SESSION['email'];
$type=$_SESSION['type'];
if($type=="inbox") {
    $str="SELECT * FROM `$email` WHERE `trash`=0";
    $res=mysqli_query($sql,$str);
    $mails=array();
    while ($arr=mysqli_fetch_assoc($res))
    {
        $mails[]=$arr;
    }
    echo json_encode($mails);
}
else {
    $str="SELECT * FROM `$email` WHERE `trash`=1";
    $res=mysqli_query($sql,$str);
    $mails=array();
    while ($arr=mysqli_fetch_assoc($res))
    {
        $mails[]=$arr;
    }
    echo json_encode($mails);
}
