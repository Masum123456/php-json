<?php 
    $password=$username="";
    $passwordError=$usernameError=$errorMsg="";
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty($_POST['username'])) {
        $usernameError = "Please fill up the username";
    }
    else {
        $username = $_POST['username'];
    }

    if(empty($_POST['password'])) {
        $passwordError = "Please fill up the password";
    }
    else {
        $password=$_POST['password'];
    }
    if($passwordError == "" && $usernameError == ""){
        $file2 = fopen("info.txt", "r");
		$read = fread($file2, filesize("info.txt"));
		fclose($file2);

		$json_decoded_text = json_decode($read, true);

           $_SESSION["userid"] = $json_decoded_text['userId'];
           $_SESSION["pass"] = $json_decoded_text['password'];
           $_SESSION["fname"] = $json_decoded_text['fname'];
           $_SESSION["lname"] = $json_decoded_text['lname'];
           if($username==$json_decoded_text['userId'] && $password==$json_decoded_text['password']){
            $errorMsg= "Successfully login";
           }
           else{
            $errorMsg="Unable login";
           }
    }
    

   else{
    $errorMsg="Unable login";
   }
}
	?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <label for="username">User Name</label>
        <input type="text" id="username" name="username" value="<?php echo $username ?>">
        <p><?php echo $usernameError; ?></p>
        <br>
        <label for="passworde">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $password ?>">
        <p><?php echo $passwordError; ?></p>
        <br>
        <br>
        <p><?php echo $errorMsg; ?></p>
        <input type="submit" value="Submit">
    </form>

</body>

</html>