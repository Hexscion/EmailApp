<?php
session_start();
$sql=mysqli_connect("localhost","root","","EmailApp");
$email=$_SESSION['email'];
$id=$_GET['id'];
$str="SELECT * FROM `$email` WHERE `id`='$id'";
$res=mysqli_query($sql,$str);
$data=mysqli_fetch_assoc($res);
echo json_encode($data);