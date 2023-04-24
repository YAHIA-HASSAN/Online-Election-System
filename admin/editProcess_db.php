<?php
session_start();
if (!isset($_SESSION['cndID'])) {
    header("Location:admin-cnd.php");
    exit;
}
$error_fields = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    if (!(isset($_POST['cnd_national_id'])) || empty($_POST['cnd_national_id'])) {
        $error_fields[] = "cnd_national_id";
    }
    if (!(isset($_POST['cnd_name'])) || empty($_POST['cnd_name'])) {
        $error_fields[] = "cnd_name";
    }
    if (!(isset($_POST['cnd_symbol'])) || empty($_POST['cnd_symbol'])) {
        $error_fields[] = "cnd_symbol";
    }

    if ($error_fields) {
        header("Location: edit.php?error_fields=".implode(",",$error_fields));
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "bug_tracker");
    if (!$conn) {
        echo mysqli_connect_error();
        exit;
    }
    $cnd_id =$_SESSION['cndID'];
    $cnd_national_id = mysqli_escape_string($conn, $_POST['cnd_national_id']);
    $cnd_name = mysqli_escape_string($conn,$_POST['cnd_name']);
    $cnd_symbol = mysqli_escape_string($conn, $_POST['cnd_symbol']);


    $query = "update election_system.candidates set c_name ='" . $cnd_name . "',c_national_id = '" . $cnd_national_id . "',c_electoral_symbol ='" . $cnd_symbol . "' where c_candidate_num=".$cnd_id;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo mysqli_connect_error();
        exit;
    }
    mysqli_close($conn);
    header("Location:admin-cnd.php");
    exit;
}