<?php
session_start();
    if (!isset($_SESSION['userid'])) {
        header("Location: index.php");
        exit;
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $conn=mysqli_connect("localhost","root","","election_system");
        if(!$conn){
            echo mysqli_connect_error();
            exit;
        }
        $user_id = $_SESSION['userid'];
        $query = "select candidates.c_name,candidates.c_candidate_num from election_system.candidates";
        $result = mysqli_query($conn, $query);
        $yes_cnt=0;
        while($row=mysqli_fetch_assoc($result)){
            if((!isset($_POST[$row['c_name'].'-yes'])&&!isset($_POST[$row['c_name'].'-no']))){
                $query="insert into election_system.election (v_voting_num, e_status) values (".$user_id.",0);";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_connect_error();
                    exit;
                }
                $query="update election_system.voters set v_status=0 where v_voting_num = ".$user_id.";";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_connect_error();
                    exit;
                }
                header("Location:complet.php");
                exit;
            }
            if((isset($_POST[$row['c_name'].'-yes'])&&isset($_POST[$row['c_name'].'-no']))){
                $query="insert into election_system.election (v_voting_num, e_status) values (".$user_id.",0);";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_connect_error();
                    exit;
                }
                $query="update election_system.voters set v_status=0 where v_voting_num = ".$user_id.";";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_connect_error();
                    exit;
                }
                header("Location:complet.php");
                exit;
            }
            if((isset($_POST[$row['c_name'].'-yes']))){
               $yes_cnt++;
               $candidate_num=$row['c_candidate_num'];
            }
            if($yes_cnt!=1){
                $query="insert into election_system.election (v_voting_num, e_status) values (".$user_id.",0);";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_connect_error();
                    exit;
                }
                $query="update election_system.voters set v_status=0 where v_voting_num = ".$user_id.";";
                if(!mysqli_query($conn,$query)){
                    echo mysqli_connect_error();
                    exit;
                }
                header("Location:complet.php");
                exit;
            }
            $query="insert into election_system.election (v_voting_num, c_candidate_num, e_status) values (".$user_id.",".$candidate_num.",1);";
            if(!mysqli_query($conn,$query)){
                echo mysqli_connect_error();
                exit;
            }
            $query="update election_system.voters set v_status=0 where v_voting_num = ".$user_id.";";
            if(!mysqli_query($conn,$query)){
                echo mysqli_connect_error();
                exit;
            }
            header("Location:complet.php");
            exit;
        }
        
    }
    mysqli_free_result($result);
    mysqli_close($conn);
?>
