<?php
session_start();
$type=$_GET['type'];
$_SESSION['type']=$type;