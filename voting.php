<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "election_system");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}
$user_id = $_SESSION['userid'];
$query = "select * from election_system.candidates";
$result = mysqli_query($conn, $query);
?>
<html>

<head>
    <title>Voting</title>
    <link rel="stylesheet" href="elecstyle.css">
    <div class="head">
        <a href="index.php" class="headItem" style="right: 0;position: fixed;">Logout</a>
    </div>
</head>

<body>
    <form style="margin: auto; width: 65%; background-color:white;" action="votingProcess_db.php" method="POST">
        <table>
            <thead>
                <tr>
                    <th colspan="5">
                        List of Candidates
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cnt = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                                    <tr>
                                        <th>
                                            ' . $cnt++ . '.
                                        </th>
                                        <th>
                                            ' . $row['c_name'] . '
                                        </th>
                                        <th>
                                           <img src="./symbols/' . $row['c_electoral_symbol'] . '" width=20% height=20%>
                                        </th>
                                        <th>
                                            <input type="checkbox" id="' . $row['c_candidate_num'] . '" name="' . $row['c_candidate_num'] . '" value="Yes">
                                            <label for="' . $row['c_candidate_num'] . '"> Yes </label>
                                        </th>
                                        <th>
                                            <input type="checkbox" id="' . $row['c_candidate_num'] . '" name="' . $row['c_candidate_num'] . '" value="No">
                                            <label for="' . $row['c_candidate_num'] . '"> No </label>
                                        </th>
                                    </tr>
                            ';
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <input type="submit" id="submit" value="Submit">
                    </td>

            </tfoot>
        </table>
    </form>
</body>

</html>
<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>
