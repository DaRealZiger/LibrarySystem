<?php
/* ------------------------- Call all functions  ------------------------- */
require_once "function.inc.php";

/* --------------------------- Defining Variables --------------------------- */
$conn = dbconn();
$username = $_POST["username"];

/* ------------------------ Preparing sql statement  ------------------------ */
$sql = "DELETE FROM ".USERTABLE." WHERE Username = '".$username."'";

/* ------------------------ Executing sql statement  ------------------------ */
if ($conn -> query($sql)) {
    header("location:".BASEURL."/Admin/UserList.php");
    exit();
} else {
    stmtFailed();
}
?>
