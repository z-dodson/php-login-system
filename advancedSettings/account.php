<?php
session_start();
$message = "";
$adminData = file_get_contents("../private/users/ADMIN");
$adminUsers = explode(",",$adminData);
if(!in_array($_SESSION['name'], $adminUsers)){
	header('Location: ./permissionDenied.php');
	exit;
}
// this is all the stuff to changwe new users
if($_POST['option']=="add"){
    if(isset($_POST['user'], $_POST['password1'], $_POST['password2'])){
        if($_POST['password1']==$_POST['password2']){
            $path = "../private/users/".$_POST['user']."/";
            $filename = $path."password";
            mkdir($path);
            $file = fopen($path."notifications", "w") or die("unable to open file : ".$filename);
            $file = fopen($path."sentmsgs", "w") or die("unable to open file : ".$filename);
            fwrite($file, password_hash($_POST["password1"], PASSWORD_DEFAULT));
            fclose($file);
        }else{$message="Please enter the same passwords";}
    }else{$message="Please enter a user and password";}
}elseif($_POST['option']=="rm"){
    if(isset($_POST['user'])){
        $path = "../private/users/".$_POST['user']."/";
        $filename = $path."password";
        unlink($filename);
        rmdir($path);
    }else{$message="Please enter a user to remove";}
}elseif($_POST['option']=="chpwd"){
    if(isset($_POST['user'], $_POST['password1'], $_POST['password2'])){
        if($_POST['password1']==$_POST['password2']){
            $path = "../private/users/".$_POST['user']."/";
            $filename = $path."password";
            $file = fopen($filename, "w") or die("unable to open file : ".$filename);
            fwrite($file, password_hash($_POST["password1"], PASSWORD_DEFAULT));
            fclose($file);
        }else{$message="Please enter the same passwords";}
    }else{$message="Please enter a user and new password";}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Account Settings</title>
</head>
<body>
    <h1>Advanced Settings</h1>
    <p>USERNAME: <?php echo($_SESSION['name']); ?></p>
    <form action="./index.php" method="post">
        <h3>User Settings</h3>
        <p style="color:red;"><?php echo($message); ?></p>
        <select name="option">
            <option value="add">Add User</option>
            <option value="rm">Remove User</option>
            <p>NOTE: remove dosn't require password input</p>
            <option value="chpwd">Change Password</option>
        </select>
        <input autocomplete="off" name="user" type="text" placeholder="Username">
        <input autocomplete="off" name="password1" type="password" placeholder="Enter your new password">
        <input autocomplete="off" name="password2" type="password" placeholder="Confirm your new password">
        <input type="submit" value="OK">
    </form>
</body>
</html>
