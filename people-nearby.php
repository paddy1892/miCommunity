<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

$email = $_SESSION['email'];


//Select and show here database data for user

if (isset($_SESSION["email"])) {

    $sessionQuery = "SELECT * FROM usersCITproject WHERE email = '$email'";
    $sessionResult = mysqli_query($conn, $sessionQuery) or die(mysqli_error($conn));

    $row = mysqli_fetch_assoc($sessionResult);
    $myId = $row['id'];
    //echo "$myId";
    //echo "session set";
}

$joinQuery = "SELECT profilesCITproject.description, profilesCITproject.hobbies, profilesCITproject.interests, profilesCITproject.profile_img, usersCITproject.firstname, usersCITproject.id FROM profilesCITproject
 INNER JOIN usersCITproject ON usersCITproject.id = profilesCITproject.user_id";
//$q = "SELECT * FROM profilesCITproject";
$r = mysqli_query($conn, $joinQuery);

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

    <title>People Nearby</title>

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

    <div class="bd-example" id="carousel">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators" id="indicators">
                <?php
                $i = 0;
                foreach ($r as $row) {
                    $actives = '';
                    if ($i == 0) {
                        $actives = 'active';
                    }
                ?>
                    <li data-target="#carouselExampleCaptions" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                <?php $i++;
                } ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($r as $row) {
                    $actives = '';
                    if ($i == 0) {
                        $actives = 'active';
                    }
                ?>
                    <div class="carousel-item <?= $actives; ?>">
                        <img src="<?= $row["profile_img"] ?>" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block" id="user-info">
                            <h4 class="paragraph"><?= $row["firstname"] ?></h4>
                            <p class="paragraph">Hobbies: <?= $row["hobbies"] ?></p>
                            <p class="paragraph">Interests: <?= $row["interests"] ?></p>
                            <div id="message-button">
                                <?php echo "<a href='messages03.php?senderid=" . $row['id'] . "&receiverid=" . $myId . "' role='button' class='btn btn-primary'> Message </a> "; ?>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                }
                if ($row['user_id'] = $myId) {
                    echo " ";
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" id="arrow"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" id="arrow"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <script src="https:code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https:stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
<?php
mysqli_close($conn);
?>