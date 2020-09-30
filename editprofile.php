<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");




$email = $_SESSION["email"];


// Select and show here database data for user

if (isset($_SESSION["email"])) {

    $sessionQuery = "SELECT * FROM usersCITproject WHERE email = '$email'";
    $sessionResult = mysqli_query($conn, $sessionQuery) or die(mysqli_error($conn));

    if (mysqli_num_rows($sessionResult) > 0) {
        while ($row = mysqli_fetch_assoc($sessionResult)) {
            $userID = $row["id"];
            $emaildata = $row["email"];
            $firstname = $row["firstname"];
            $surname = $row["surname"];
        }
    }
    //echo "$firstname ";
    //echo "$email";
} else {
    //echo "no session";
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    <title>Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> 
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <link rel="stylesheet" href="css/styles.css">

    <title>Edit Profile</title>

</head>

<body>

    <!-- Nav bar -->
    <?php
    navBar();
    ?>
    <!-- Nav Bar -->


    <div class="container" id="edit-profile-page">
        <h1>Edit Profile</h1>
        <hr>
        <div class="row">
       
            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <h3>Personal info</h3>
                <hr>
                <form class="form-horizontal" role="form" method="post" action="process-edit-profile.php">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" id="edit-profile-text">First name:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="firstname" placeholder="<?php echo "$firstname" ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" id="edit-profile-text" name="surname">Surname:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="surname" placeholder="<?PHP echo "$surname" ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" id="edit-profile-text" name="hobbies">Hobbies:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="hobbies" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" id="edit-profile-text" name="interests">Interests:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="interests" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" id="edit-profile-text" name="description">Description/Bio:</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" type="text" name="description" placeholder="Tell us about you..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" id="edit-profile-text"></label>
                        <div class="col-lg-8">
                            <input type="submit" class="btn btn-primary" name="save-changes" value="Save Changes">
                            <span></span>

                        </div>
                </form>
                <!-- /#page-content-wrapper -->


                <!-- Bootstrap core JavaScript -->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>