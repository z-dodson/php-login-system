<?php
session_start();
$message = "";
if (!isset($_SESSION['loggedin'])) {
	header('Location: /login/');
	exit;
}
if (isset($_POST['password1'], $_POST['password2']) ) {
   if($_POST['password1']==$_POST['password2']){
        $filename = "../private/users/".$_SESSION['name']."/password";
        $file = fopen($filename, "w") or die("unable to open file : ".$filename);
        $p = $_POST['password1'];
        $p = password_hash($p, PASSWORD_DEFAULT);
        fwrite($file,$p);
        fclose($file);
   }else{$message="Please enter the same password";}
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Settings</title>
</head>
<body>
    <h1>Settings</h1>
    <p>USERNAME: <?php echo($_SESSION['name']); ?></p>
    <form action="./index.php" method="post">
        <h3>Change Password</h3>
        <p><?php echo($message); ?></p>
        <input name="password1" type="password" placeholder="Enter your new password">
        <input name="password2" type="password" placeholder="Confirm your new password">
        <input type="submit" value="Update">
    </form>

    <a href="../advancedSettings/"><button>Advanced Settings</button></a>
        <a href="/"><button>Home</button></a>
        
</body>
</html>
