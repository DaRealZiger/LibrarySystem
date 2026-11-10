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

$bookName = $_POST["bookName"] ?? "";
?>
<html>
    <head>
        <title>Catalogue Admin</title> <!-- Set Tab Name -->
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table width="100%">
                <?php banner() ?> <!-- Set Banner -->
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">Catalogue Admin</font></h1></marquee> <!-- Set Scrolling Title -->
                    </td>
                </tr>
            </table>
        </header>

        <form method="POST">
            <table align="center">

                <!-- Space -->
                <tr><td height="50" colspan=5>
                    <input type="text" name="bookName">
                    &nbsp&nbsp
                    <button>Search</button>
                </td></tr>
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

                            <!-- --------- Show Admin's Book Table --------- -->
                            <?php
                            $conn = dbconn();
                            adminBookTable($conn, $bookName);
                            ?>

                        </table>
                    </td></tr>
            </table>
            <!-- Spacing Between Buttons And Table  -->
            <br>

            <!-- Buttons -->
            <?php
            if ($bookName !== "") {
                echo '<table align="center">';
                    echo '<tr>';
                        /* View Users Button */
                        echo '<td width="100">';
                            echo '<button type="submit" formaction="UserList.php">View Users</button>';
                        echo '</td>';

                        /* Add Book Button */
                        echo '<td width="820">';
                            echo '<button type="submit" formaction="AddBook.php">Add Book</button>';
                        echo '</td>';

                        /* Back Button */
                        echo '<td width="70">';
                        echo '<button type="submit" formaction="CatalogueAdmin.php">Back</button>';
                        echo '</td>';

                        /* Log Out Button */
                        echo '<td>';
                        echo '<button type="submit" formaction="../Includes/logout.inc.php">Log Out</button>';
                        echo '</td>';
                echo '</tr>';
                echo '</table>';
            }else {
                echo '<table align="center">';
                    echo '<tr>';
                        /* View Users Button */
                        echo '<td width="100">';
                            echo '<button type="submit" formaction="UserList.php">View Users</button>';
                        echo '</td>';

                        /* Add Book Button */
                        echo '<td width="900">';
                            echo '<button type="submit" formaction="AddBook.php">Add Book</button>';
                        echo '</td>';

                        /* Log Out Button */
                        echo '<td>';
                        echo '<button type="submit" formaction="../Includes/logout.inc.php">Log Out</button>';
                        echo '</td>';
                echo '</tr>';
                echo '</table>';
            }
            ?>
        </form>
    </body>
</html>
