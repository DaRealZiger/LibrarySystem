<?php
require_once "../Includes/function.inc.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("location:".BASEURL."/Admin/CatalogueAdmin.php");
    exit();
}
session_start();
$bookID = $_POST["BookID"];
$conn = dbconn();

$sql = "SELECT BookID, BookName, Language, Author, Publisher FROM ".BOOKTABLE." WHERE BookID =".$bookID.";";
$result = $conn -> query($sql);
$row = $result ->fetch_assoc();
?>
<html>
    <head>
        <title>Edit Book</title>
    </head>
    <body bgcolor="#ECD8C6">
        <header>
            <table>
                <?php banner() ?>
                <tr>
                    <td bgcolor="#603E20">
                        <marquee scrollamount="20"><h1><font color="white">Edit Book</font></h1></marquee>
                    </td>
                </tr>
            </table>
        </header>

        <form method="POST">
        <input type="hidden" name="BookID" value="<?=htmlspecialchars($row['BookID'])?>">
            <table align="center">
                <!-- Space -->
                <tr><td height="50" colspan=5></td></tr>

                <tr>
                    <td colspan="2">
                        <table>
                            <!-- Title -->
                            <tr>
                                <td width="10"></td>
                                <td>Title</td>
                            </tr>

                            <!-- Title Field -->
                            <tr>
                                <td></td>
                                <td>
                                <input  required type="text" name="title" value="<?=htmlspecialchars($row['BookName'])?>" size="90">
                                </td>
                            </tr>

                            <!-- Space -->
                            <tr><td height="30" colspan=5></td></tr>

                            <!-- Language -->
                            <tr>
                                <td></td>
                                <td>Language</td>
                            </tr>

                            <!-- Language Choice -->
                            <tr>
                                <td></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td width="100">
                                                <input type="radio" name="language" value="Malay"
                                                 <?= $row["Language"] === "Malay" ? "checked" : ""?>>Malay
                                            </td>
                                            <td width="100">
                                                <input type="radio" name="language" value="English"
                                                 <?= $row["Language"] === "English" ? "checked" : ""?>>English
                                            </td>
                                            <td width="100">
                                                <input type="radio" name="language" value="Chinese"
                                                 <?= $row["Language"] === "Chinese" ? "checked" : ""?>>Chinese
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!-- Space -->
                            <tr><td height="30" colspan=5></td></tr>

                            <!-- Author -->
                            <tr>
                                <td width="10"></td>
                                <td>Author</td>
                            </tr>

                            <!-- Author Field -->
                            <tr>
                                <td></td>
                                <td>
                                    <input  required type="text" name="author" value="<?=htmlspecialchars($row['Author'])?>" size="90">
                                </td>
                            </tr>

                            <!-- Space -->
                            <tr><td height="50" colspan=5></td></tr>

                            <!-- Publisher -->
                            <tr>
                                <td width="10"></td>
                                <td>Publisher</td>
                            </tr>

                            <!-- Publisher Field -->
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="publisher" value="<?=htmlspecialchars($row['Publisher'])?>" size="90">
                                </td>
                            </tr>
                            <!-- Space -->
                            <tr><td height="25" colspan=5></td></tr>

                            <!-- Buttons -->
                            <tr>
                                <td colspan=2>
                                    <table>
                                        <tr>
                                            <!-- To push buttons to the right  -->
                                            <td align ="right" width="200"></td>

                                            <!-- Edit Book Button -->
                                            <td><button type="submit" formaction="../Includes/editbook.inc.php">Edit Book</button></td>

                                            <!-- Button seperator  -->
                                            <td width="10"></td>

                                            <!-- Delete Book Button -->
                                            <td><button type="submit" formaction="../Includes/delete.inc.php">Delete Book</button></td>

                                            <!-- Button seperator  -->
                                            <td width="10"></td>

                                            <!-- Reset Button -->
                                            <td align="left"><button type="reset">Reset</button></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="605">
                    </td>
                    <td>
                        <!-- Back Button -->
                        <button formaction="CatalogueAdmin.php">Back</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
