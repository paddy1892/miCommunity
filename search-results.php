<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

$email = $_SESSION['email'];


// Select and show here database data for user

if (isset($_SESSION["email"])) {

    $sessionQuery = "SELECT * FROM usersCITproject WHERE email = '$email'";
    $sessionResult = mysqli_query($conn, $sessionQuery) or die(mysqli_error($conn));

    if (mysqli_num_rows($sessionResult) > 0) {
        while ($row = mysqli_fetch_assoc($sessionResult)) {
            $userID = $row["id"];
            $emailData = $row["email"];
            $firstname = $row["firstname"];
            $surname = $row["surname"];
            $address = $row["address"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="http:code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <title>Search</title>

</head>

<body>

    <?php
    navBar();
    ?>

    <div class="change-font">
        <p>Change text size</p>
        <button type="button" id="increase" onclick="text_size();" class="btn btn-success fas fa-plus"></button>
        <button type="button" id="decrease" onclick="decrease_text();" class="btn btn-success fas fa-minus"></button>
    </div>


    <div class="d-flex" id="wrapper">
        <div>
            <h1 id="search-title">Search Results</h1>
            <div class="paragraph">
                <div class="results-container">
                    <?php

                    if (isset($_POST['submit-search'])) {
                        $search = mysqli_real_escape_string($conn, $_POST['search']);

                        //inculde hobbies and interests in this query 
                        $sql = "SELECT profilesCITproject.profile_img, usersCITproject.firstname, usersCITproject.surname, usersCITproject.email, profilesCITproject.hobbies, profilesCITproject.interests FROM usersCITproject INNER JOIN profilesCITproject ON profilesCITproject.user_id = usersCITproject.id WHERE firstname LIKE '%$search%' OR surname LIKE '%$search%' OR hobbies LIKE '%$search%' OR interests LIKE '%$search%' ";
                        $result = mysqli_query($conn, $sql);
                        $queryResult = mysqli_num_rows($result);
                        if ($queryResult > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<a href='user-profile.php?email=" . $row['email'] . "'>
                    <ul class='list-unstyled'>
                <li class='media'>

                   <div class='media-body'>
                    <h5 class='mt-0 mb-1'> " . $row['firstname'] . " " . $row['surname'] . "</h5></a><hr>
                    <p class='paragraph'>Hobbies: " . $row['hobbies'] . " <br> Interests: " . $row['interests'] . "</p>    
                    </li> </ul>";
                            }
                        } else {
                            echo "No results matching search.";
                        }
                    }

                    ?>

                </div>
            </div>
        </div>

        <!-- Text re-size -->
        <script>
            function text_size() {
                var p_font = document.getElementsByClassName("paragraph");
                for (var i = 0; i < p_font.length; i++) {
                    var element = p_font[i];
                    element.style.fontSize = "150%";
                }

            }

            function decrease_text() {
                font = document.getElementsByClassName("paragraph");
                for (var i = 0; i < font.length; i++) {
                    var element = font[i];
                    element.style.fontSize = "100%";
                }
            }
        </script>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>