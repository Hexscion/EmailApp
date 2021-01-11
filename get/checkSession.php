<?php
session_start();
$valid=0;
if(isset($_SESSION['isLogged'])) {
    $valid = 1;
    $email = $_SESSION['email'];
    $arr = array($valid, $email);
}
else {
    $valid = 0;
    $arr = array($valid);
}
echo json_encode($arr);