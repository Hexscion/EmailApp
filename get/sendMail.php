<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$from=$_SESSION['email'];
$to=$_POST['to'];
$cc=$_POST['cc'];
$subject=$_POST['subject'];
$body=$_POST['body'];
$str="SELECT * FROM users WHERE email='$to'";
$res=mysqli_query($sql,$str);
if(mysqli_num_rows($res)>0) {
    $filename = time();
    $extension = $_FILES['file']['type'];
    $extension = substr($extension,6);
    $filename = $filename.".$extension";
    $location = 'C:\xampp\htdocs\EmailApp\upload';
    move_uploaded_file($_FILES['file']['tmp_name'],$location.$filename);
    $filelocation = $location.$filename;
    $filelocation = addslashes($filelocation);
    $cc=$to.",".$cc;
    $date = date('Y-m-d');
    $str="INSERT INTO `$to`(`id`, `from`, `to`, `subject`, `body`, `files`, `date`, `readflag`, `trash`) VALUES (0,'$from','$cc','$subject','$body','$filelocation','$date',0,0)";
    mysqli_query($sql,$str);
    echo "Email Sent";
}
else{
    echo "Recipient email does not exist";
}
