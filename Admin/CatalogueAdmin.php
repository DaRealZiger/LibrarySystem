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
        <title>Catalogue Admin</title>
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table>
                <tr><td bgcolor="#603E20"><img src="../src/Banner.jpg" alt="Banner"  width="1290" height="100"></td></tr>
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">Catalogue Admin</font></h1></marquee>
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
                                <td width="50"></td>
                                <td width="50" align="center"><b>BookID</b></td>
                                <td width="200" align="center"><b>Title</b></td>
                                <td width="150" align="center"><b>Language</b></td>
                                <td width="200" align="center"><b>Author</b></td>
                                <td width="200" align="center"><b>Publisher</b></td>
                                <td width="150" align="center"><b>Status</b></td>
                                <td width="200" align="center"><b>User</b></td>
                            </tr>

                            <?php
                            require_once "../Includes/function.inc.php";
                            $conn = dbconn();
                            adminBookTable($conn);
                            ?>

                        </table>
                    </td></tr>
            </table>
            <!-- Spacing Between Buttons And Table  -->
            <br>

            <!-- Buttons -->
            <table align="center">
                <tr>
                    <!-- View Users Button -->
                    <td width="100">
                        <button type="submit" formaction="UserList.php">View Users</button>
                    </td>

                    <!-- Add Book Button -->
                    <td width="900">
                        <button type="submit" formaction="AddBook.php">Add Book</button>
                    </td>

                    <!-- Log Out Button -->
                    <td>
                        <button type="submit" formaction="../Includes/logout.inc.php">Log Out</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
