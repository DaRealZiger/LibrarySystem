<?php 
const BOOKTABLE = 'Books';
const USERTABLE = 'Users';
const BASEURL = 'http://localhost:8080/Library%20System';

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

function userBookTable($conn){
    $no = 1;
    $sql = "SELECT BookName, Language, Author, Publisher, Status FROM " . BOOKTABLE;
    $result = $conn ->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()){
            echo "<tr height = '58'>";
            echo "<td>&emsp;".$no++."</td>";
            echo "<td>&emsp;".$row["BookName"]."</td>";
            echo "<td>&emsp;".$row["Language"]."</td>";
            echo "<td>&emsp;".$row["Author"]."</td>";
            echo "<td>&emsp;".$row["Publisher"]."</td>";
            echo "<td>&emsp;".$row["Status"]."</td>";
            echo "</tr>";
        } 
    }else {
            echo "<tr height = '58'>";
            echo "<td align='center'>-</td>";
            echo "<td align='center'>-</td>";
            echo "<td align='center'>-</td>";
            echo "<td align='center'>-</td>";
            echo "<td align='center'>-</td>";
            echo "<td align='center'>-</td>";
            echo "</tr>";
    }
}

function isLoggedIn(): bool {
    return isset($_SESSION['username'])
        && $_SESSION['username'] !== '';
}

function isAdmin(): bool {
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

function checkPassword($psw, $confPsw){
    if ($psw != $confPsw) {
        header("location:".BASEURL."/Registration/Signup.html?error=PswDontMatch");
        exit();
    }
}

