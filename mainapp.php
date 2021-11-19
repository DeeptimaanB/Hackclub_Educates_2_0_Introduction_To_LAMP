<?php
session_Start();
require_once "pdo.php";
if(!isset($_SESSION['id'])){
    die("No user logged in.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        <?php
        $sql="SELECT * FROM users WHERE user_id=".$_SESSION['id'];
        $stmt=$pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($row);
        ?>
    </p>
    <a href="signout.php"><button>Sign Out</button></a>
</body>
</html>