<?php
/* ------------------------- Call all functions  ------------------------- */
require_once "function.inc.php";

/* --------------------------- Defining Variables --------------------------- */
$conn = dbconn();
$BookID = $_POST["BookID"];

/* ------------------------ Preparing sql statement  ------------------------ */
$sql = "DELETE FROM ".BOOKTABLE." WHERE BookID = '".$BookID."'";

/* ------------------------ Executing sql statement  ------------------------ */
if ($conn -> query($sql)) {
    header("location:".BASEURL."/Admin/CatalogueAdmin.php");
    exit();
} else {
    stmtFailed();
}
?>
