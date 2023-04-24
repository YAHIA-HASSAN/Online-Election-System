<?php

$error_fields = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
    if (!(isset($_POST['name'])) || empty($_POST['name'])) {
        $error_fields[] = "name";
    }
    if (!(isset($_POST['nationalID'])) || empty($_POST['nationalID'])) {
        $error_fields[] = "nationalID";
    }
    if (!(isset($_POST['phone'])) || empty($_POST['phone'])) {
        $error_fields[] = "phone";
    }
   if ($error_fields) {
        header("Location: register.php?error_fields=".implode(",",$error_fields));
        exit;
    }
    $conn = mysqli_connect("localhost", "root", "", "election_system");
    if (!$conn) {
        echo mysqli_connect_error();
        exit;
      }
    $name = mysqli_escape_string($conn, $_POST['name']);
    $nationalID = mysqli_escape_string($conn, $_POST['nationalID']);
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $query="select voters.v_voting_num from voters where v_national_id='$nationalID';";
    $result=mysqli_fetch_assoc(mysqli_query($conn,$query));
    if($result){
        echo print_r($result);
        $error_fields[] = "oldUser";
        header("Location: register.php?error_fields=".implode(",",$error_fields));
        exit;
    }
    $query2 = "insert into election_system.voters (v_name, v_national_id, v_phone) values('" . $name . "', '" . $nationalID . "', '" . $phone . "');";
    if (mysqli_query($conn, $query2)) {
        mysqli_close($conn);
        header("Location: index.php");
        exit;
    } else {
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
}

    mysqli_free_result($result);
    mysqli_close($conn);
?>
