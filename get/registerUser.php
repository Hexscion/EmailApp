<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$fname=$_GET['fname'];
$lname=$_GET['lname'];
$dob=$_GET['dob'];
$dob=substr($dob,0,10);
$phone=$_GET['phone'];
$pass=$_GET['pass'];
$email=$_GET['email'];
$email=$email."@xmail.com";
$valid=1;
$str1="SELECT * FROM users WHERE email='$email'";
$res=mysqli_query($sql,$str1);
if(mysqli_num_rows($res)>0) {
    $valid=0;
    echo json_encode($valid);
}
else {
    $str2 = "INSERT INTO `users`(`id`, `fname`, `lname`, `dob`, `phone`, `pass`, `email`, `flag`) VALUES (0,'$fname','$lname','$dob','$phone','$pass','$email',1)";
    mysqli_query($sql, $str2);
    $str3 = "CREATE TABLE `emailapp`.`$email` ( `id` INT NOT NULL AUTO_INCREMENT , `from` VARCHAR(200) NOT NULL , `cc` VARCHAR(1000) NOT NULL , `subject` VARCHAR(1000) NOT NULL , `body` TEXT NOT NULL , `files` TEXT NOT NULL , `date` VARCHAR(30) NOT NULL , `time` VARCHAR(200) NOT NULL , `readflag` BOOLEAN NOT NULL , `trash` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    mysqli_query($sql, $str3);
    echo json_encode($valid);
}