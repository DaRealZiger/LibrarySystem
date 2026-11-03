<?php
session_start();
require_once "function.inc.php";
$conn = dbconn();
$BookID = $_POST["BookID"];
$previousPage = $_SERVER['HTTP_REFERER'];

$sql = "DELETE FROM ".BORROWTABLE." WHERE BookID = '".$BookID."'";

if ($conn -> query($sql)) {
    header("location:".$previousPage);
    exit();
} else {
    stmtFailed();
}
?>
