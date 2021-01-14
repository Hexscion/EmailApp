<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$email=$_GET['email'];
$pass=$_GET['pass'];
$valid=0;
$str="SELECT * FROM users WHERE email='$email' AND pass='$pass' and flag=1";
$res=mysqli_query($sql,$str);
if(mysqli_num_rows($res)>0) {
    $valid=1;
    $_SESSION['isLogged']=true;
    $_SESSION['email']=$email;
    $_SESSION['type']="inbox";
}
echo json_encode($valid);