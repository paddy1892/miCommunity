<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

//if(isset($_SESSION['email'])) {
//echo "session set";

//}

$groups = "SELECT * FROM groupsCITproject";
//echo "groups = '$groups' <br>";

// initilize query
$groupResult = mysqli_query($conn, $groups) or die(mysqli_error($conn));
//echo "'$groupResult'";
$row = mysqli_fetch_assoc($groupResult); // get results of query
//echo "'$row'";
//echo " " . $row["group_name"] . " ";


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
  
  <title>Groups</title>

</head>

<body>

  <!-- Nav bar -->
  <?php
  navBar();
  ?>

<div class="change-font">
        <p>Change text size</p>
        <button type="button" id="increase" onclick="text_size();" class="btn btn-success fas fa-plus"></button>
        <button type="button" id="decrease" onclick="decrease_text();" class="btn btn-success fas fa-minus"></button>
    </div>

  <div class="main-section">
    <h1 id="clubs-title">View Groups</h1>
    <div>
      <a href="create-group.php" class="btn btn-success btn-md" id="create-group" role="button" aria-pressed="true">Create a Group</a>

    </div>

    <div class="paragraph">
    <?php

    // get groups query
    $groups = "SELECT * FROM groupsCITproject";

    // initilize query
    $groupResult = mysqli_query($conn, $groups) or die(mysqli_error($conn));


    while ($row = mysqli_fetch_assoc($groupResult)) {
      echo    "<div class='card' id='group-card'>
                <div class='card-body'>
                    <h4 class='card-title'> " . $row["group_name"] . " </h4>
                    <h6 class='card-subtitle mb-2 text-muted'> " . $row["venue"] . " </h6><h6 class='card-subtitle mb-2 text-muted'> " . $row["date_time"] . "</h6>
                    <h6 class='card-subtitle mb-2 text-muted'> Organized By: " . $row["organizer"] . "</h6>
                    <p class='paragraph' id='paragraph'> " . $row["description"] . " </p>
                    <a href='group-discussion.php?id=" . $row["id"] . "' class='btn btn-info'>Discussion page</a>
                </div>
            </div>";
    }
    ?>
  </div> 

  </div>
  <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

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

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>

</html>