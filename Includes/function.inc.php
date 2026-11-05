<?php 
const BOOKTABLE = 'Books';
const USERTABLE = 'Users';
const BORROWTABLE = 'BorrowedBook';
const BASEURL = 'http://localhost:8080/Library%20System';

function dbconn(){
    $serverName = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'MiniProject';

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
    $sql = "SELECT 
            b.BookID,
            b.BookName,
            b.Language,
            b.Author,
            b.Publisher,
            COALESCE(DATE_FORMAT(br.DueDate, '%d-%m-%Y'), b.Status) AS DisplayStatus
        FROM ".BOOKTABLE." b
        LEFT JOIN ".BORROWTABLE." br
            ON b.BookID = br.BookID
            AND br.Username = '".$_SESSION['Username']."'
        WHERE NOT EXISTS (
            SELECT 1
            FROM BorrowedBook other
            WHERE other.BookID = b.BookID
            AND other.Username != '".$_SESSION['Username']."'
        )";

    $result = $conn ->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()){
            echo "<tr height = '58'>";
            echo "<td>&emsp;".$row["BookID"]."</td>";
            echo "<td>&emsp;".$row["BookName"]."</td>";
            echo "<td>&emsp;".$row["Language"]."</td>";
            echo "<td>&emsp;".$row["Author"]."</td>";
            echo "<td>&emsp;".$row["Publisher"]."</td>";
            if ($row["DisplayStatus"] !== 'Available') {
            echo "<td>&emsp;<font color='Red'>".$row["DisplayStatus"]."</font></td>";
            echo "<td><button type='submit' formaction='../Includes/return.inc.php' name='BookID' value='".$row["BookID"]."'>Return</button></td>";
            } else{
            echo "<td>&emsp;".$row["DisplayStatus"]."</td>";
            echo "<td><button type='submit' formaction='../Includes/borrow.inc.php' name='BookID' value='".$row["BookID"]."'>Borrow</button></td>";
            }
            echo "</tr>";
        } 
    }else {
            echo "<tr height = '58'>";
            for ($i=0; $i < 6; $i++) { 
                echo "<td align='center'>-</td>";
            }
            echo "</tr>";
    }
}

function isLoggedIn(): bool {
    return isset($_SESSION['Username'])
        && $_SESSION['Username'] !== '';
}

function isAdmin(): bool {
    return isLoggedIn() && $_SESSION['Role'] === 'admin';
}

function checkPassword($psw, $confPsw) {
    if (strcmp($psw, $confPsw) !== 0) {
        header("location:".BASEURL."/Registration/SignUp.php?error=PswDontMatch");
        exit();
    }
}

function usrExists($conn, $username) {
    $sql = "SELECT * FROM ".USERTABLE.
        " WHERE Username = ?";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row= mysqli_fetch_assoc($resultData)) {
            mysqli_stmt_close($stmt);
            return $row;
        }else {
            mysqli_stmt_close($stmt);
            $result = false;
            return $result;
        }
        
    }else {
        mysqli_stmt_close($stmt);
        stmtFailed();
    }
}

function stmtFailed() {
    $previousPage = $_SERVER['HTTP_REFERER'];
    
    $urlPart = explode('?', $previousPage);
    $baseURL = $urlPart[0];
    
    header("Location: " . $baseURL . "?error=stmtFailed");
    exit();
}

function borrowedBookTable($conn){
    $sql = "SELECT 
            b.BookID,
            b.BookName,
            b.Language,
            b.Author,
            b.Publisher,
            DATE_FORMAT(br.DueDate, '%d-%m-%Y') AS DueDate
        FROM ".BOOKTABLE." b
        INNER JOIN ".BORROWTABLE." br
            ON b.BookID = br.BookID
            AND br.Username = '".$_SESSION['Username']."'
        WHERE NOT EXISTS (
            SELECT 1
            FROM BorrowedBook other
            WHERE other.BookID = b.BookID
            AND other.Username != '".$_SESSION['Username']."'
        )";

    $result = $conn ->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()){
            echo "<tr height = '58'>";
            echo "<td>&emsp;".$row["BookID"]."</td>";
            echo "<td>&emsp;".$row["BookName"]."</td>";
            echo "<td>&emsp;".$row["Language"]."</td>";
            echo "<td>&emsp;".$row["Author"]."</td>";
            echo "<td>&emsp;".$row["Publisher"]."</td>";
            echo "<td>&emsp;<font color='Red'>".$row["DueDate"]."</font></td>";
            echo "<td><button type='submit' formaction='../Includes/return.inc.php' name='BookID' value='".$row["BookID"]."'>Return</button></td>";
            }
            echo "</tr>";
        } else {
            echo "<tr height = '58'>";
            for ($i=0; $i < 6; $i++) { 
                echo "<td align='center'>-</td>";
            }
            echo "</tr>";
    }
}

function adminBookTable($conn){
    $sql = "SELECT 
            b.BookID,
            b.BookName,
            b.Language,
            b.Author,
            b.Publisher,
            br.Username,
            COALESCE(DATE_FORMAT(br.DueDate, '%d-%m-%Y'), b.Status) AS DisplayStatus
        FROM ".BOOKTABLE." b
        LEFT JOIN ".BORROWTABLE." br
            ON b.BookID = br.BookID
        ";

    $result = $conn ->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()){
            if ($row["DisplayStatus"] !== 'Available' && $row["DisplayStatus"] !== 'Unavailable') {
            echo "<tr height = '58'>";
            echo "<td></td>";
            echo "<td>&emsp;".$row["BookID"]."</td>";
            echo "<td>&emsp;".$row["BookName"]."</td>";
            echo "<td>&emsp;".$row["Language"]."</td>";
            echo "<td>&emsp;".$row["Author"]."</td>";
            echo "<td>&emsp;".$row["Publisher"]."</td>";
            echo "<td>&emsp;<font color='Red'>".$row["DisplayStatus"]."</font></td>";
            } else{
            echo "<tr height = '58'>";
            echo "<td><button type='submit' formaction='EditBook.php' name='BookID' value='".$row["BookID"]."'>Edit</button></td>";
            echo "<td>&emsp;".$row["BookID"]."</td>";
            echo "<td>&emsp;".$row["BookName"]."</td>";
            echo "<td>&emsp;".$row["Language"]."</td>";
            echo "<td>&emsp;".$row["Author"]."</td>";
            echo "<td>&emsp;".$row["Publisher"]."</td>";
            echo "<td>&emsp;".$row["DisplayStatus"]."</td>";
            }
            echo "<td>&emsp;".$row["Username"]."</td>";
            echo "</tr>";
        } 
    }else {
            echo "<tr height = '58'>";
            for ($i=0; $i < 6; $i++) { 
                echo "<td align='center'>-</td>";
            }
            echo "</tr>";
    }
}

function userTable($conn){
    $sql = "SELECT 
            br.Username,
            b.BookName,
            DATE_FORMAT(br.DueDate, '%d-%m-%Y') AS DueDate
        FROM ".BOOKTABLE." b
        INNER JOIN ".BORROWTABLE." br
            ON b.BookID = br.BookID
        ";

    $result = $conn ->query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()){
            echo "<tr height = '58'>";
            echo "<td>&emsp;".$row["Username"]."</td>";
            echo "<td>&emsp;".$row["BookName"]."</td>";
            echo "<td>&emsp;<font color='Red'>".$row["DueDate"]."</font></td>";
            }
            echo "</tr>";
        } else {
            echo "<tr height = '58'>";
            for ($i=0; $i < 3; $i++) { 
                echo "<td align='center'>-</td>";
            }
            echo "</tr>";
    }
}

function banner() {
    echo '<tr><td bgcolor="#603E20"><img src="../src/Banner.jpg" alt="Banner"  width="1290" height="100"></td></tr>';
}

function whoami() {
    echo "Username:".$_SESSION['Username'];
}
