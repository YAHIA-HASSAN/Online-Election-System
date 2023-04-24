<?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        header("Location: index.php");
        exit;
    }
    $_SESSION = array();
    session_destroy();
?>
<html>
<head>
    <title>Complete</title>
<link rel="stylesheet" href="elecstyle.css">
</head>
<body>
    <div class="center">
        <p style="margin: auto; width: 23%;padding:10px;">
        Thanks for voting.
        </p>
        <div id="completdone">
        <a href="logout.php" style="color: white;">Done</a>
        </div>
        <br>
    </div>
</body>

</html>