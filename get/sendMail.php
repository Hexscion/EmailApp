<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';

date_default_timezone_set('Asia/Kolkata');

$sql=mysqli_connect("localhost","root","","EmailApp");
$from=$_SESSION['email'];
$to=$_POST['to'];
$cc=$_POST['cc'];
$subject=$_POST['subject'];
$body=$_POST['body'];
if(strpos("@xmail.com",$to)!=false){
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
}
else{
        function mail_attachment ($from , $to, $cc, $subject, $body, $attachment)
        {
            $mail = new PHPMailer();

            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'xmailnew2020@gmail.com';           // SMTP username
            $mail->Password = 'xmail@24';                         // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('xmailnew2020@gmail.com',$from);
            $mail->addAddress($to);

            if($cc!="undefined") {
                $ccarr=explode(", ",$cc);
                foreach ($ccarr as $ccto) {
                    $mail->addCC($ccto);
                }

            }

            //Attachments
            $mail->addAttachment($attachment);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            if(!$mail->Send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else
            {
                echo "Successfully sent!";
            }
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], '../temp/'.basename($_FILES['file']['name']));

        mail_attachment("$from", "$to", "$cc", "$subject", "$body", ("../temp/".$_FILES["file"]["name"]));
}
