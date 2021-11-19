<?php
    session_start();
    require_once "pdo.php";
    $msg="";   
    if(isset($_POST['email']) && isset($_POST['psw']))
    {
        $psw= hash('md5',$_POST['psw']);
        $sql="SELECT * FROM users where email = :e AND BINARY pass = :p";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
            ':e' => $_POST['email'],
            ':p' => $psw,
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row!==FALSE)
        {
            $_SESSION['id']=$row['user_id'];
            header("Location: mainapp.php");
        }
        else
        {
            $msg="No user exists with this email and password.";
        }
        
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <h2> Log In </h2>
    <form action="login.php" method = "POST">
        <input name="email" type="text" placeholder="EMAIL"><br>
        <input name="psw" type="password" placeholder="PASSWORD"><br><br>
        <button type="submit"> Submit </button><br>
    </form>
    <a href="index.php"><button>Back</button></a>
    <p>
    <?php
    if ($msg!="")
    {
        echo($msg);
        $msg="";
    }
    ?>
    </p>
</body>
</html>