<?php
    $error_arr=array();
    if(isset($_GET['error_fields'])){
        $error_arr=explode(",",$_GET['error_fields']);
    }
    $flage=0;
  
?>
<html>
<header>
    <title>Bug Tracker - Registeration</title>
    <link rel="stylesheet" href="elecstyle.css">
</header>

<body>
    <form class="center" method="post" action="regProcess_db.php">
        <table>
            <tbody>
                <tr>
                    <th><label name="name" id="name">Full Name</label></th>
                    <th><input type="text" name="name" id="name">
                    <?php
                    if (in_array("name", $error_arr)) {
                        echo '<th style="color:red;">* Please enter vatild name</th>';
                        $flage=1;
                    }
                    ?>
                    </th>
                </tr>
                <tr>
                    <th><label name="nationalID" id="nationalID">National ID</label></th>
                    <th><input type="text" name="nationalID" id="nationalID">
                    <?php
                    if (in_array("nationalID", $error_arr)) {
                        echo '<th style="color:red;">* Please enter vatild national ID</th>';
                        $flage=1;
                    }
                    ?>
                    </th>
                </tr>
                <tr>
                    <th><label name="phone" id="phone">Phone Number</label></th>
                    <th><input type="text" name="phone" id="phone">
                    <?php
                    if (in_array("phone", $error_arr)) {
                        echo '<th style="color:red;">* Please enter vatild phone</th>';
                    }
                    ?>
                    </th>
                </tr>
                <tr>
                    <?php
                        if(in_array("oldUser",$error_arr)){
                            echo '<th></th><th style="color:red;"> *user has registered before.</th>';
                        }
                    ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><input type="submit" name="submit" id="submit" value="submit"></td>
                </tr>
            </tfoot>
        </table>
    </form>

</body>

</html>