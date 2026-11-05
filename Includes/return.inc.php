<?php
/* ----------------------------- Start Session  ----------------------------- */
session_start();

/* ------------------------- Call all functions  ------------------------- */
require_once "function.inc.php";

/* --------------------------- Defining Variables --------------------------- */
$conn = dbconn();
$BookID = $_POST["BookID"];
$previousPage = $_SERVER['HTTP_REFERER'];

/* ------------------------ Preparing sql statement  ------------------------ */
$sql = "DELETE FROM ".BORROWTABLE." WHERE BookID = '".$BookID."'";

/* ------------------------ Executing sql statement  ------------------------ */
if ($conn -> query($sql)) {
    header("location:".$previousPage);
    exit();
} else {
    stmtFailed();
}
?>
