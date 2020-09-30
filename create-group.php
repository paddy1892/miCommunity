<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");





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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https:use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="css/styles.css">

    <title>Create Club</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    

    <title>Create Group</title>

</head>

<?php
navBar();
?>


<body>

    <h1 id="clubs-title">Create a Group</h1>

    <div class="container" id="create-club-form">
        <form class="form-horizontal" role="form" method="post" action="process-create-group.php">
            <div class="form-group">
                <label class="col-lg-3 control-label" id="create-club-text">Club name:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" name="club-name" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" id="create-club-text" name="surname">Venue:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" name="venue" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" id="create-club-text" name="hobbies">Date & Time:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" name="date-time" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" id="create-club-text" name="interests">Description:</label>
                <div class="col-lg-8">
                    <textarea class="form-control" type="text" name="description" placeholder="Tell us about your club..."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" id="create-club-text" name="description">Organized By:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" name="organizer" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" id="create-club-text"></label>
                <div class="col-lg-8">
                    <input type="submit" class="btn btn-primary" name="save-changes" value="Save Changes">
                    <span></span>
                </div>
            </div>
        </form>
    </div>
</body>


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

</html>