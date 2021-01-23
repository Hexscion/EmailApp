<?php
$sql=mysqli_connect("localhost","root","","EmailApp");
$phone=$_GET['phone'];
$str="SELECT * FROM users WHERE phone='$phone'";
$res=mysqli_query($sql,$str);
if(mysqli_num_rows($res)>0) {
    $data=mysqli_fetch_assoc($res);
    $email=$data['email'];
    $password=$data['pass'];
    /*$phone="91".$phone;
    $phone=(int)$phone;
    $data=mysqli_fetch_assoc($res);
    $email=$data['email'];
    $password=$data['pass'];
    // Account details
    $apiKey = urlencode('VzTOZJAKuY0-l9FtL7tT49dM4WYavAz55sdpIgbxgx');
    // Message details
    $numbers = array($phone);
    $sender = urlencode('XMAIL');
    $message = rawurlencode("Your email is: '$email' and your password is: '$password'");
    $numbers = implode(",", $numbers);
    // Prepare data for POST request
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
    // Send the POST request with cURL
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    // Process your response here
    echo $response;*/
    echo "Your email is: '$email' and your password is: '$password'";
}
else{
    echo "Invalid phone number";
}