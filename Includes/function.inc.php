<?php 
$BOOKTABLE = 'Books';
$USERTABLE = 'Users';

function dbconn(){
    $serverName = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'Lab';

    $conn = new mysqli(
        $serverName, 
        $username,
        $password,
        $dbName );

    if ($conn -> connect_error) {
        die("Conneciton failed: " . $conn -> connect_error);
    }

    return $conn;
}
