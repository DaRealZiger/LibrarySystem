<?php
require_once "../Includes/function.inc.php";
session_start();
if (isAdmin()) {
    header("location:".BASEURL."/Admin/CatalogueAdmin.php");
    exit();
} elseif (!isLoggedIn()) {
    header("location:".BASEURL."/Registration/LogIn.php");
    exit();
}
?>
<html>
    <head>
        <title>Borrowed Books</title>
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table>
                <?php banner() ?>
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">Borrowed Books</font></h1></marquee>
                    </td>
                </tr>
            </table>
        </header>
        <?php whoami() ?>

        <form method="POST">
            <table align="center">
                <!-- Space -->
                <tr><td height="50" colspan=5></td></tr>
                <tr><td>
                        <table align="center" border="1">
                            <!-- Table Header -->
                            <tr height="40">
                                <td width="50" align="center"><b>BookID</b></td>
                                <td width="200" align="center"><b>Title</b></td>
                                <td width="150" align="center"><b>Language</b></td>
                                <td width="200" align="center"><b>Author</b></td>
                                <td width="200" align="center"><b>Publisher</b></td>
                                <td width="150" align="center"><b>Status</b></td>
                            </tr>

                            <?php
                            $conn = dbconn();
                            borrowedBookTable($conn);
                            ?>

                        </table>
                    </td></tr>
            </table>

            <table align="center" >
                <tr>
                    <!-- Formatter -->
                <td width="950"></td>

                <!-- Back Button  -->
                <td align="right"><br>
                    <button type="submit" formaction="CatalogueUser.php">Back</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>
