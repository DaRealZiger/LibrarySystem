<?php
/* ------------------------- Call all functions  ------------------------- */
require_once "../Includes/function.inc.php";

session_start();

if (isAdmin()) {
    header("location:".BASEURL."/Admin/CatalogueAdmin.php"); /* If Admin redirect to admin page */
    exit();
} elseif (!isLoggedIn()) {
    header("location:".BASEURL."/Registration/LogIn.php"); /* If not logged in return to log in page */
    exit();
}
?>

<html>
    <head>
        <title>Catalogue</title> <!-- Set Tab Name -->
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table width="100%">
                <?php banner() ?> <!-- Set Banner -->
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">Catalogue</font></h1></marquee> <!-- Set Scrolling Title -->
                    </td>
                </tr>
            </table>
        </header>
        <?php whoami() ?> <!-- Display Username -->

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


                            <!-- --------- Show User's Book table  --------- -->
                            <?php
                            $conn = dbconn();
                            userBookTable($conn);
                            ?>

                        </table>
                    </td></tr>
            </table>

        <!-- Buttons -->
        <table align="center">
            <tr>
                <!-- View Borrowed Button -->
                <td width="950">
                    <button type="submit" formaction="BorrowedBooks.php">View Borrowed</button>
                </td>

                    <!-- Log Out Button -->
                    <td align="right">
                        <button type="submit" formaction="../Includes/logout.inc.php">Log out</button>
                    </td>
            </tr>
        </table>
        </form>
    </body>
</html>
