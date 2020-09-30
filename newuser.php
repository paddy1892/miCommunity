<?php
session_start();
//include DB connection file 

if (isset($_POST['register-submit'])) {

    include("conn/connect.php");
    include("conn/password.php");



    // Store form data from POST to PHP variables 

    $firstnamedata = mysqli_real_escape_string($conn, $_POST['firstname']);
    $surnamedata = mysqli_real_escape_string($conn, $_POST['surname']);
    $emaildata = mysqli_real_escape_string($conn, $_POST['email']);
   
    $passworddata = mysqli_real_escape_string($conn, $_POST['pwd']);
    $passwordrepeatdata = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);

    $interests = mysqli_real_escape_string($conn, $_POST['interests']);
    $hobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);
    $description = mysqli_real_escape_string($conn, $_POST['deescription']);
    


    if (isset($firstnamedata)) {
        $getUsers = "SELECT * FROM usersCITproject WHERE email = '$emaildata'";
        $userResult = mysqli_query($conn, $getUsers) or die(mysqli_error($conn));
        $rowNumber = mysqli_num_rows($userResult);
        if ($rowNumber >= 1) {
            header('Location: register.php?type=user&status=failed');
            echo "This email already exists. Please choose another one";
        } else if ($passworddata !== $passwordrepeatdata) {
            header("Location: register.php?error=password&email=" . $emaildata);
            exit();
        }
        // insert data into database
        $insertquery = "INSERT INTO usersCITproject (id, firstname, surname, email, password) 
        VALUES (NULL, '$firstnamedata', '$surnamedata', '$emaildata', '$passworddata')";

        // $insert2 = "INSERT INTO profilesCITproject (id, description, hobbies, interests, user_id) VALUES (NULL, '$address1', '$address2', '$city', '$postcode')";


        //$result2 = mysqli_query($conn, $insertAddress) or die(mysqli_error($conn));
        $result = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));


        header('Location: profile.php'); // direct user to profile page


        mysqli_close($conn); //close connection
    }
}
