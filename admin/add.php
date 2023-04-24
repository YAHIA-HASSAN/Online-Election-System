<?php
session_start();
if (!isset($_SESSION['adminid'])) {
    header("Location:admin-cnd.php");
    exit;
}
$error_arr = array();
if (isset($_GET['error_fields'])) {
    $error_arr = explode(",", $_GET['error_fields']);
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
    <form method="POST" class="center" action="addProcess_db.php">
        <table>
            <thead>
                <tr>
                    <th>Attribute</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <th><label name="cnd_name" id="cnd_name"> Name </label> </th>
                    <th> <input type="text" name="cnd_name" id="cnd_name"></th>
                    <?php
                    if (in_array("cnd_name", $error_arr)) {
                        echo '<th style="color:red;">*Invalid name</th>';
                    }
                    ?>

                </tr>
                <tr>
                    <th><label name="cnd_national_id" id="cnd_national_id"> National ID </label> </th>
                    <th> <input type="text" name="cnd_national_id" id="cnd_national_id"></th>
                    <?php
                    if (in_array("cnd_national_id", $error_arr)) {
                        echo '<th style="color:red;">*Invalid national ID</th>';
                    }
                    ?>
                </tr>
                <tr>
                    <th><label name="cnd_symbol" id="cnd_symbol"> Candidate Symbol </label> </th>
                    <th> <input type="text" name="cnd_symbol" id="cnd_symbol"></th>
                    <?php
                    if (in_array("cnd_symbol", $error_arr)) {
                        echo '<th style="color:red;">*Invalid path</th>';
                    }
                    ?>
                </tr>


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