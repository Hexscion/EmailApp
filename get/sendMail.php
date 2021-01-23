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
    $tempfile=$_FILES['file']['name'];
    $tempfilename=explode(".",$tempfile);
    $filename = $tempfilename[0].time();
    $type = $_FILES['file']['type'];
    $extension = explode("/",$type);
    $filename = $filename.".$extension[1]";
    $location = 'C:\xampp\htdocs\EmailApp\upload\\';
    move_uploaded_file($_FILES['file']['tmp_name'],$location.$filename);
    $date = date('Y-m-d');
    $time = time();
    if($cc!="undefined"){
        $cc=$to.", ".$cc;
        $ccarr = explode(", ",$cc);
        foreach ($ccarr as $ccto){
            $str="INSERT INTO `$ccto`(`id`, `from`, `cc`, `subject`, `body`, `files`, `date`, `time`, `readflag`, `trash`) VALUES (0,'$from','$cc','$subject','$body','$filename','$date','$time',0,0)";
            mysqli_query($sql,$str);
        }
        echo "Email Sent";
    }
    else{
        $cc="None";
        $str="INSERT INTO `$to`(`id`, `from`, `cc`, `subject`, `body`, `files`, `date`, `time`, `readflag`, `trash`) VALUES (0,'$from','$cc','$subject','$body','$filename','$date','$time',0,0)";
        mysqli_query($sql,$str);
        echo "Email Sent";
    }
}
else{
    echo "Recipient email does not exist";
}
