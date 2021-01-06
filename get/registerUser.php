<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$fname=$_GET['fname'];
$lname=$_GET['lname'];
$dob=$_GET['dob'];
$phone=$_GET['phone'];
$pass=$_GET['pass'];
$email=$_GET['email'];
$email=$email."@xmail.com";
$valid=1;
$str1="select * from Users where email='$email'";
$res=mysqli_query($sql,$str1);
if(mysqli_num_rows($res)>0) {
    $valid=0;
    echo json_encode($valid);
}
else {
    $str2 = "INSERT INTO `users`(`id`, `fname`, `lname`, `dob`, `phone`, `pass`, `email`, `flag`) VALUES (0,'$fname','$lname','$dob','$phone','$pass','$email',1)";
    mysqli_query($sql, $str2);
    echo json_encode($valid);
}