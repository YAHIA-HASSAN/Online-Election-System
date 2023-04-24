<?php
session_start();
$error_fields = array();
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    if (!(isset($_POST['username'])) || empty($_POST['username'])) {
        $error_fields[] = "username";
    }
    if (!(isset($_POST['password'])) || empty($_POST['password'])) {
        $error_fields[] = "password";
    }
  
    if($_POST['username']!='admin'||$_POST['password']!='admin'){
        $error_fields[] = "username";
        $error_fields[] = "password";
    }
    if ($error_fields) {
        header("Location: index.php?error_fields=".implode(",",$error_fields));
        exit;
    }
    header("Location:admin-ctrl.php");
    $_SESSION['adminid']=1;
    exit;
}

