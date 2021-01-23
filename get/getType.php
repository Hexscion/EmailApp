<?php
session_start();
$type=$_SESSION['type'];
if($type=="inbox"){
    echo 1;
}
else{
    echo 0;
}