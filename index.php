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
    <title>Election - Login</title>
    <link rel="stylesheet" href="elecstyle.css">
</header>
<body>
<form  class="center" method="POST" action="loginprocess_db.php">
        <table>
            <tbody>
                <tr>
                    <th><label name="nationalID" id="nationalID">National ID</label></th>
                    <th><input type="text" name="nationalID" id="nationalID"></th>
                    <?php
                    if (in_array("nationalID", $error_arr)) {
                        echo '<th style="color:red;">*Invalid national ID</th>';
                    }
                    ?>
                </tr>
                <tr>
                    <th><label name="votingNum" id="votingNum">Voting number</label></th>
                    <th><input type="votingNum" name="votingNum" id="votingNum"></th>
                    <?php
                   if (in_array("votingNum", $error_arr)) {
                        echo '<th style="color:red;">*Invalid voting number</th>';
                    }
                    ?>
                </tr>
    
                    <?php
                    if(in_array("votingStatus",$error_arr)){
                        echo '<th></th><th style="color:red;">*You have voted before.</th>';
                    }
                    ?>
                </tr>
               
            </tbody>
            <tfoot>
                <tr>
                <td colspan="3"><input type="submit" name="submit" id="submit" value="Login"></td>
                </tr>
                <tr>
                <td colspan="3">
                    <input type="button" onclick="location.href='register.php'" id="register" value="Register" >
                </td>
                </tr>
            </tfoot>
        </table>
    </form>



</body>



</html>