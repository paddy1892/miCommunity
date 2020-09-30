<?php

include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

session_start();

$email = $_GET['email'];


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
    echo "$emailData";
} else {
    echo 'no session';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

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

<div class="container">
    <div class="input-group input-group-lg" id="search-box">
        <div class="input-group-prepend">
            <form action="search-results.php" method="post" class="search-box-container">
                <input type="text" class="form-control" name="search" placeholder="Search..." />
                <button type="submit" class="btn btn-success" name="submit-search">Search</button>
            </form>

            <!-- <div class="results-container">
                 results go here 
                <?php

                $search = "SELECT profilesCITproject.hobbies, profilesCITproject.interests, profilesCITproject.profile_img, usersCITproject.firstname, usersCITproject.surname, usersCITproject.email FROM usersCITproject INNER JOIN profilesCITproject ON profilesCITproject.user_id = usersCITproject.id WHERE firstname LIKE '%$search%' OR surname LIKE '%$search%' OR hobbies LIKE '%$search%' OR interests LIKE '%$search%' ";
                $searchresult = mysqli_query($conn, $search);
                $queryresult = mysqli_num_rows($searchresult);

                if ($queryresult > 0) {
                    while ($row = mysqli_fetch_assoc($queryresult)) {
                        echo "<div>
                        <h3>" . $row['firstname'] . "</h3>
                        <h3>" . $row['surname'] . "</h3>
                        <h4>" . $row['hobbies'] . "</h4>
                        <h4>" . $row['interests'] . "</h4>
                        </div>";
                    }
                }


                ?> -->


            </div>
            <p class="paragraph" id="search-terms">Enter a Name, Hobbie or Interest to find users!</p>
    </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        
        
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



</body>

</html>