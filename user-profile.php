<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");



$email = $_GET["email"];


// Select and show here database data for user

if (isset($_SESSION["email"])) {

    $sessionQuery = "SELECT * FROM usersCITproject WHERE email = '$email'";
    $sessionResult = mysqli_query($conn, $sessionQuery) or die(mysqli_error($conn));

    $row = mysqli_fetch_assoc($sessionResults);
    $myId = $row['id'];

    if (mysqli_num_rows($sessionResult) > 0) {
        while ($row = mysqli_fetch_assoc($sessionResult)) {

            $emailData = $row["email"];
            $firstname = $row["firstname"];
            $surname = $row["surname"];
            $address = $row["address"];
        }
    }
    //echo "$email";
} else {
    //echo 'no session';
}

$joinQuery = "SELECT profilesCITproject.description, profilesCITproject.hobbies, profilesCITproject.interests, profilesCITproject.profile_img, usersCITproject.email, usersCITproject.firstname FROM profilesCITproject
INNER JOIN usersCITproject ON usersCITproject.id = profilesCITproject.user_id WHERE usersCITproject.email = '$email'";

$joinResult = mysqli_query($conn, $joinQuery) or die(mysqli_error($conn));

//echo "$joinResult";

if (mysqli_num_rows($joinResult) > 0) {
    while ($row = mysqli_fetch_assoc($joinResult)) {
        $description = $row["description"];
        $hobbies = $row["hobbies"];
        $interests = $row["interests"];
        $pic = $row["profile_img"];
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

    <title><?php echo "$firstname"?>'s Profile</title>

</head>

<body>

    <!-- Nav bar -->
    <?php
    navBar();
    ?>
    <!-- Nav Bar -->

    <div class="change-font">
        <p>Change text size</p>
        <button type="button" id="increase" onclick="text_size();" class="btn btn-success fas fa-plus"></button>
        <button type="button" id="decrease" onclick="decrease_text();" class="btn btn-success fas fa-minus"></button>
    </div>


    <div class="row py-5 px-4">
        <div class="col-xl-4 col-md-6 col-sm-10 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 bg-dark">
                    <div class="media align-items-end profile-header">
                       
                        <div class='profile mr-3'> '<img src= <?php echo "'$pic'"; ?>  alt=' ...' width='130' class='rounded mb-2 img-thumbnail'></div>
                        <div class='media-body mb-5 text-white'>
                            <h3 class='mt-0 mb-0'><?php echo " $firstname " ?></h3>
                        </div>
                    </div>
                </div>
                <?php
                if ($_SESSION['email'] != $_GET['email']) {

                    echo "";
                } ?>

                <div class="py-4 px-4">
                    <div class="py-4">
                        <h4 class="mb-3">Bio</h4>
                        <div class="p-4 bg-light rounded shadow-sm">
                            <p class="paragraph"><?php echo " $description " ?> </p>
                        </div>
                    </div>

                    <div class="py-4">
                        <h5 class="mb-3">Hobbies</h5>
                        <div class="p-4 bg-light rounded shadow-sm">
                            <p class="paragraph"><?php echo "$hobbies" ?></p>
                        </div>
                    </div>

                    <div class="py-4">
                        <h5 class="mb-3">Interests</h5>
                        <div class="p-4 bg-light rounded shadow-sm">
                            <p class="paragraph"><?php echo "$interests" ?></p>
                        </div>
                    </div>

                </div>

            </div><!-- End profile widget -->
        </div>
    </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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

<?php mysqli_close($conn); ?>