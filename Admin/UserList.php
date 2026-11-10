<?php
/* ------------------------- Call all functions  ------------------------- */
require_once "../Includes/function.inc.php";

session_start();

if (!isLoggedIn()) {
    header("location:".BASEURL."/Registration/LogIn.php"); /* If not logged in return to log in page */
    exit();
} elseif (!isAdmin()) {
    header("location:".BASEURL."/User/CatalogueUser.php"); /* If Admin redirect to admin page */
    exit();
}
?>
<html>
    <head>
        <title>User List</title> <!-- Set Tab Name -->
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table width="100%">
                <?php banner() ?> <!-- Set Banner -->
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">User List</font></h1></marquee> <!-- Set Scrolling Title -->
                    </td>
                </tr>
            </table>
        </header>
        <form method="POST">
        <table align="center">

            <!-- Space -->
            <tr><td height="50" colspan=5></td></tr>
            <tr><td>
                    <table align="center" border="1">
                        <!-- Table Header -->
                        <tr height="40">
                            <td></td>
                            <td align="center" width="250"><b>Name</b></td>
                            <td align="center" width="250"><b>Book</b></td>
                            <td align="center" width="150"><b>Due Date</b></td>
                        </tr>

                        <!-- --- Show table for user's who borroed books --- -->
                            <?php
                            $conn = dbconn();
                            userTable($conn);
                            ?>

                    </table>
                </td></tr>
        </table>
        </form>

        <!-- Back Button -->
        <form action="CatalogueAdmin.php">
            <table align="right">
                <tr><td width="400"><br><button type="submit">Back</button></td></tr>
            </table>
        </form>
    </body>
</html>
