<?php
    session_start();
    if(!isset($_SESSION['cndID'])){
        header("Location:admin-cnd.php");
        exit;
    }
    $cnd_id=$_SESSION['cndID'];
    $conn=mysqli_connect("localhost","root","","election_system");
    $query="delete from election_system.candidates where c_candidate_num=".$cnd_id;
    $result=mysqli_query($conn,$query);
    if(!$result){
        echo mysqli_connect_error();
        exit;
    }
    header("Location: admin-cnd.php");

    mysqli_close($conn);
exit;
?>