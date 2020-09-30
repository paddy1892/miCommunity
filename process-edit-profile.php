<?php

include("conn/connect.php");
include("conn/password.php");

session_start();

$email = $_SESSION["email"];

if (isset($_SESSION["email"])) {

    $sessionQuery = "SELECT * FROM usersCITproject WHERE email = '$email'";
    $sessionResult = mysqli_query($conn, $sessionQuery) or die(mysqli_error($conn));

	if (mysqli_num_rows($sessionResult) > 0) {
		while ($row = mysqli_fetch_assoc($sessionResult)) {
            $userID = $row["id"];
		}
    }  

  }
$id = $row["id"];
$firstnamedata = $_POST['firstname'];
$surnamedata = $_POST['surname'];

// profiles table

$hobbies = $_POST["hobbies"];
$interests = $_POST["interests"];
$description = $_POST["description"];

$newDescription = str_replace("'", "''", "$description"); 


$updatequery = "UPDATE usersCITproject SET firstname ='$firstnamedata', surname ='$surnamedata' WHERE email = '$email' ";
$updatequery02 = "UPDATE profilesCITproject SET hobbies ='$hobbies', interests ='$interests', description = '$newDescription' WHERE user_id = '$userID' ";


$result = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
$result02 = mysqli_query($conn, $updatequery02) or die(mysqli_error($conn));


 header("Location: profile.php");

mysqli_close($conn);
