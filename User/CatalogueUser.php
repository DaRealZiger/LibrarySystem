<?php
session_start();
echo $_SESSION["Role"]."&nbsp";
echo $_SESSION["Username"];
?>
<html>
    <head>
        <title>Catalogue</title>
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table>
                <tr><td bgcolor="#603E20"><img src="../src/Banner.jpg" alt="Banner"  width="1290" height="100"></td></tr>
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">Catalogue</font></h1></marquee>
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
                                <td width="50" align="center"><b>BookID</b></td>
                                <td width="200" align="center"><b>Title</b></td>
                                <td width="150" align="center"><b>Language</b></td>
                                <td width="200" align="center"><b>Author</b></td>
                                <td width="200" align="center"><b>Publisher</b></td>
                                <td width="150" align="center"><b>Status</b></td>
                            </tr>
                            <?php
                            require_once "../Includes/function.inc.php";
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
                    <button type="submit">View Borrowed</button>
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
