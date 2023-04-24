<?php
session_start();
if (!isset($_SESSION['cndID'])) {
    header("Location:admin-cnd.php");
    exit;
}
$error_arr=array();
if(isset($_GET['error_fields'])){
    $error_arr=explode(",",$_GET['error_fields']);
}
$cnd_id = $_SESSION['cndID'];
$conn = mysqli_connect("localhost", "root", "", "election_system");
$query = "select * from election_system.candidates where c_candidate_num=" . $cnd_id;
$result = mysqli_query($conn, $query);
if (!$result) {
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
    <form method="POST" class="center" action="editProcess_db.php">
        <table>
            <thead>
                <tr>
                    <th>Attribute</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = mysqli_fetch_assoc($result);
                echo '
                            <tr>
                            <th> Candidate Number </th>
                            <th>' . $row['c_candidate_num'] . '</th>
                            </tr>
                            <tr>
                            <th> Name </th>
                            <th> <input type="text" name="cnd_name" id="cnd_name" value= "' . $row['c_name'] . '"></th>
                           ';
                           if (in_array("cnd_name", $error_arr)) {
                            echo '<th style="color:red;">*Invalid name</th>';
                            }
                echo       '
                            </tr>
                            <tr>
                            <th> National ID </th>
                            <th> <input type="text" name="cnd_national_id" id="cnd_national_id" value= "' . $row['c_national_id'] . '"></th>
                            ';
                            if (in_array("cnd_national_id", $error_arr)) {
                             echo '<th style="color:red;">*Invalid national ID</th>';
                             }
                 echo       '
                            </tr>
                            <tr>
                            <th> Candidate Symbol </th>
                            <th> <input type="text" name="cnd_symbol" id="cnd_symbol" value= "' . $row['c_electoral_symbol'] . '"></th>
                            ';
                            if (in_array("cnd_symbol", $error_arr)) {
                             echo '<th style="color:red;">*Invalid path</th>';
                             }
                 echo       '
                            </tr>
                    ';

                ?>
            </tbody>
            <tfoot>
                <tr>
                <td colspan="2"><input type="submit" name="submit" id="submit" value="submit"></td>
                </tr>
            </tfoot>
        </table>
    </form>
</body>

</html>
<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>