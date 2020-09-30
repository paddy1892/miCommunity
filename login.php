<?php
session_start();
include("conn/connect.php");
include("conn/password.php");

if (isset($_POST['login-submit'])) {

    
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);

    $getuser = "SELECT * FROM usersCITproject WHERE email='$email' AND password='$pwd'";

    $loginprocess = mysqli_query($conn, $getuser) or die(mysqli_error($conn));

    if (mysqli_num_rows($loginprocess) > 0) {
        
        $_SESSION['email'] = $email;

        header("Location: profile.php");
    } else {
        header("Location: signin.php?login=failed");
        
    } 

}

mysqli_close($conn);

/* Working as of 11/02/20, login fails when using account with hashed password */