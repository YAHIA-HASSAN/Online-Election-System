<?php
    session_start();
    $_SESSION=array();
    session_destroy();
    $error_arr=array();
    if(isset($_GET['error_fields'])){
        $error_arr=explode(",",$_GET['error_fields']);
    }
?>
<html>
<header>
    <title>Admin - Login</title>
    <link rel="stylesheet" href="../elecstyle.css">
</header>
<body>
<form  class="center" method="POST" action="adminLoginprocess.php">
        <table>
            <tbody>
                <tr>
                    <th><label name="username" id="username">username</label></th>
                    <th><input type="text" name="username" id="username"></th>
                    <?php
                    if (in_array("username", $error_arr)) {
                        echo '<th style="color:red;">*Invalid username</th>';
                    }
                    ?>
                </tr>
                <tr>
                    <th><label name="password" id="password">password</label></th>
                    <th><input type="password" name="password" id="password"></th>
                    <?php
                   if (in_array("password", $error_arr)) {
                        echo '<th style="color:red;">*Invalid password</th>';
                    }
                    ?>
               
            </tbody>
            <tfoot>
                <tr>
                <td colspan="3"><input type="submit" name="submit" id="submit" value="Login"></td>
                </tr>
            </tfoot>
        </table>
    </form>



</body>



</html>