<?php
require_once "../Includes/function.inc.php";
session_start();
if (!isLoggedIn()) {
    header("location:".BASEURL."/Registration/LogIn.php");
    exit();
} elseif (!isAdmin()) {
    header("location:".BASEURL."/User/CatalogueUser.php");
    exit();
}
?>
<html>
    <head>
        <title>User List</title>
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table>
                <tr><td bgcolor="#603E20"><img src="../src/Banner.jpg" alt="Banner"  width="1290" height="100"></td></tr>
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">User List</font></h1></marquee>
                    </td>
                </tr>
            </table>
        </header>
        <table align="center">

            <!-- Space -->
            <tr><td height="50" colspan=5></td></tr>
            <tr><td>
                    <table align="center" border="1">
                        <!-- Table Header -->
                        <tr height="40">
                            <td align="center" width="250"><b>Name</b></td>
                            <td align="center" width="250"><b>Book</b></td>
                            <td align="center" width="150"><b>Due Date</b></td>
                        </tr>

                            <?php
                            require_once "../Includes/function.inc.php";
                            $conn = dbconn();
                            userTable($conn);
                            ?>

                    </table>
                </td></tr>
        </table>

        <!-- Back Button -->
        <form action="CatalogueAdmin.php">
            <table align="right">
                <tr><td width="400"><br><button type="submit">Back</button></td></tr>
            </table>
        </form>
    </body>
</html>
