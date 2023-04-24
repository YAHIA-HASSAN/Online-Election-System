<?php
session_start();
$error_fields = array();
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    if (!(isset($_POST['nationalID'])) || empty($_POST['nationalID'])) {
        $error_fields[] = "nationalID";
    }
    if (!(isset($_POST['votingNum'])) || empty($_POST['votingNum'])) {
        $error_fields[] = "votingNum";
    }
   if ($error_fields) {
        header("Location: index.php?error_fields=".implode(",",$error_fields));
        exit;
    }
      $conn = mysqli_connect("localhost", "root", "", "election_system");
      if (!$conn) {
          echo mysqli_connect_error();
          exit;
      }
      $nationalID = mysqli_escape_string($conn, $_POST['nationalID']);
      $votingNum = mysqli_escape_string($conn,$_POST['votingNum']);

      $query = "select voters.v_voting_num,voters.v_status from election_system.voters where voters.v_national_id = '" .$nationalID."'";
      $result=mysqli_query($conn, $query);
      if ($result) {
        $userdata=(mysqli_fetch_assoc($result));
        if($userdata['v_voting_num']==$votingNum){
          if($userdata['v_status']==1){
            $_SESSION['userid']=$votingNum;
              header("Location: voting.php");
           }else{
              mysqli_close($conn);
              $error_fields[] = "votingStatus";
              header("Location: index.php?error_fields=".implode(",",$error_fields));
              exit;
           }
        }
         else{
            mysqli_close($conn);
            $error_fields[] = "votingNum";
            header("Location: index.php?error_fields=".implode(",",$error_fields));
            exit;
         }
         
      } else {
        mysqli_close($conn);
        $error_fields[] = "nationalID";
        $error_fields[] = "votingNum";
        header("Location: index.php?error_fields=".implode(",",$error_fields));
        exit;
      }
      mysqli_close($conn);
}

    mysqli_free_result($result);
    mysqli_close($conn);
?>
