<?php
    session_start();
    if(!isset($_SESSION['adminid'])){
        header("Location:index.php");
        exit;
    }
    $conn=mysqli_connect("localhost","root","","election_system");
    $query="select count(e_status) from election_system.election";
    $all_votes=mysqli_fetch_assoc(mysqli_query($conn,$query))['count(e_status)'];
    if(!$all_votes){
        echo mysqli_connect_error();
        exit;
    }
    $query="select count(e_status) from election_system.election where election.e_status=1";
    $acc_votes=mysqli_fetch_assoc(mysqli_query($conn,$query))['count(e_status)'];
    if(!$acc_votes){
        echo mysqli_connect_error();
        exit;
    }
    $rej_votes= $all_votes - $acc_votes;
?>
<html>
    <head>
        <title>Admin - ctrl</title>
        <link rel="stylesheet" href="../elecstyle.css">

        <div class="head">
            <a href="admin-ctrl.php" class="headItem">Election</a>
            <a href="admin-cnd.php" class="headItem">Candidates</a>
            <a href="logout.php" class="headItem" style="right: 0;position: fixed;">Logout</a>
        </div>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>
                        Item
                    </th>
                    <th>
                        Number
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        All Votes
                    </th>
                    <th>
                        <?php echo $all_votes;?>
                    </th>
                </tr>
                <tr>
                    <th>
                        Valid Votes
                    </th>
                    <th>
                        <?php echo $acc_votes;?>
                    </th>
                </tr>
                <tr>
                    <th>
                        Rejected Votes
                    </th>
                    <th>
                        <?php echo $rej_votes;?>
                    </th>
                </tr>
            </tbody>

        </table>
    </body>
</html>
<?php
    mysqli_close($conn);
?>
