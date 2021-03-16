<?php
$Fname=$Lname=$email=$gender=$password=$userName=$msg="";
$firstNameErr=$lastNameErr=$emailErr=$genderErr=$passrr=$userNameErr="";
if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(empty($_POST['fname'])) {
        $firstNameErr = "Please fill up the firstname";
    }
    else {
        $Fname = $_POST['fname'];
    }

    if(empty($_POST['lname'])) {
        $lastNameErr = "Please fill up the lastname";
    }
    else {

        $Lname = trim($_POST['lname']);
        $Lname = htmlspecialchars($_POST['lname']);
    }

    if(empty($_POST['email'])) {
        $emailErr = "Please fill up the email";
    }

    else {
        $email = $_POST['email'];
        $myfile = fopen("email.txt", "w") ;
        $txt = $email;
        fwrite($myfile, $txt);
        $_SESSION["email"]=$email;
        fclose($myfile);
    }

    if(empty($_POST['userName'])) {
        $userNameErr = "Please fill up the gender";
    }
    else {
        $userName= $_POST['userName'];
    }

if(empty($_POST['password'])) {
    $passrr = "Please fill up the password";
}
else {
    $password= $_POST['password'];
}

    if($firstNameErr == "" && $lastNameErr == "" && $emailErr == "" && $passrr == "" && $userNameErr == "") {
        $arr1 = array('userId' => $userName, 'password' => $password, 'fname' => $Fname,'lname' =>  $Lname ,'email' => $email,'gender'=> $gender );
        $json_encoded_text =  json_encode($arr1); 

          $file1 = fopen("info.txt", "w");
          fwrite($file1, $json_encoded_text);
          fclose($file1);
          echo "<br>";
          $msg=  $Fname . " " . $Lname . " Successful  registered" ;
          header("Location:login.php");
          exit;
    }

    else{
        echo "<br>";
        $msg=   "Invalid  registered. Please try again!!" ;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <h1>Registration Form Self</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <label for="Fname">First Name</label>
        <input type="text" id="Fname" name="fname" value="<?php echo $Fname ?>">
        <p><?php echo $firstNameErr; ?></p>

        <br>

        <label for="Lname">Last Name</label>
        <input type="text" id="Lname" name="lname" value="<?php echo $Lname ?>">
        <p><?php echo $lastNameErr; ?></p>

        <br>
        <br>

        <label for="gender">Gender</label>
        <input type="radio" name="gender" id="male" value="male">
        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="female">
        <label for="female">Female</label>
        <p><?php echo $genderErr; ?></p>
        <br>
        <br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email ?>">
        <p><?php echo $emailErr; ?></p>

        <br>


        <label for="userName">User Name</label>
        <input type="text" id="userName" name="userName" value="<?php echo $userName ?>">
        <p><?php echo $userNameErr; ?></p>

        <br>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?php echo $password ?>">
        <p><?php echo $passrr; ?></p>
        <br>
        <p><?php echo $msg; ?></p>
        <input type="submit" value="Submit">
    </form>
</body>

</html>