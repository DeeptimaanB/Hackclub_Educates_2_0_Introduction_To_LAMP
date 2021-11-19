<?php
session_start();
require_once "pdo.php";
$msg="";
if (isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['rpsw']))
{
    if($_POST['psw']==$_POST['rpsw'] && strlen($_POST['psw'])>=7)
	{
        $psw=hash('md5',$_POST['psw']);
        $sql= "INSERT Into users(fn,ln,email,pass) values(:f,:l,:e,:p)";
        $stmt= $pdo->prepare($sql);
		$stmt->execute(array(
			':f'=> $_POST['fn'],
			':l'=> $_POST['ln'],
			':e'=> $_POST['email'],
			':p'=> $psw,
		));
        header("Location: index.php");
	}
	else
	{
		$msg="Passwords dont match";
	}
	if(strlen($_POST['psw'])<7)
	{
		$msg="Password too short";
	}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2> Sign Up </h2>
    <form action="signup.php" method="POST">
        <input name="fn" type="text" placeholder="FIRST NAME"><br>
        <input name="ln" type="text" placeholder="LAST NAME"><br>
        <input name="email" type="text" placeholder="EMAIL"><br>
        <input name="psw" type="password" placeholder="PASSWORD"><br>
        <input name="rpsw" type="password" placeholder="RE-TYPE PASSWORD"><br><br>
        <button type="submit"> Submit </button><br>
    </form>
    <a href="index.php"><button>Back</button></a>
    <br>
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