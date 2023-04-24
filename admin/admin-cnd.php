<?php
    session_start();
    if(!isset($_SESSION['adminid'])){
        header("Location:index.php");
        exit;
    }
    $conn=mysqli_connect("localhost","root","","election_system");
    $query="select * from election_system.candidates";
    $result=(mysqli_query($conn,$query));
    if(!$result){
        echo mysqli_connect_error();
        exit;
    }
?>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../elecstyle.css">

        <div class="head">
            <a href="admin-ctrl.php" class="headItem">Election</a>
            <a href="admin-cnd.php" class="headItem">Candidates</a>
            <a href="logout.php" class="headItem" style="right: 0;position: fixed;">Logout</a>
        </div>
    </head>
    <body>
    <div>
        <a href="add.php" class="headItem" style="right: 0;position: fixed;">Add</a>
    </div>
        <table>
            <thead>
                <tr>
                    <th>
                        Number
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Votes
                    </th>
                    <th>
                        National ID
                    </th>
                    <th>
                        Symbol
                    </th>
                </tr>
                <br>
                <br>
            </thead>
            <tbody>
              <?php
                    while($row=mysqli_fetch_assoc($result)){
                        $_SESSION['cndID']=$row['c_candidate_num'];
                        echo '
                                <tr>
                                    <th> '.$row['c_candidate_num'].' </th>
                                    <th> '.$row['c_name'].' </th>
                                    ';
                        $query2="select count(e_status) from election_system.election where election.e_status=1 and c_candidate_num=".$row['c_candidate_num'];
                        $row2=mysqli_fetch_assoc(mysqli_query($conn,$query2));
                        echo '      
                                    <th> '.$row2['count(e_status)'].' </th>
                                    <th> '.$row['c_national_id'].' </th>
                                    <th> <img src="../symbols/'.$row['c_electoral_symbol'].'" width=10% height=10%></th>
                                    <th> <a href="edit.php"> Edit</th>
                                    <th> <a href="deleteProcess_db.php"> Delete</th>
                                </tr>
                        ';
                    }

                ?>
            </tbody>

        </table>
    </body>
</html>
<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>
