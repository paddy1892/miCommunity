<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

if (isset($_SESSION["email"])) {

    //echo "is set email<br>";

    $email = $_SESSION["email"];
    $sessionQuery = "SELECT id FROM usersCITproject WHERE email = '$email'";
    //echo "Session Query = '$sessionQuery' <br>";

    $sessionResults = mysqli_query($conn, $sessionQuery); // or die(mysqli_error($conn));
    //echo "Got session results<br>";

    $row = mysqli_fetch_assoc($sessionResults);
    $myId = $row['id'];
}



$profile = "SELECT * FROM profilesCITproject WHERE user_id = '$myId'";
$profileResult = mysqli_query($conn, $profile);
if (mysqli_num_rows($profileResult) > 0) {
    while ($row = mysqli_fetch_assoc($profileResult)) {
        $profileImg = $row['profile_img'];
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

    <title>Group Discussion</title>

</head>

<body>
    <!-- <div class="d-flex" id="wrapper"> -->

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


    <!-- Page Content -->
    <!--  <div id="page-content-wrapper">-->
    <div class="paragraph">
    <?php

    $id = $_GET['id'];
    $groupId = "SELECT * FROM groupsCITproject WHERE id = '$id' ";
    //echo "$groupId";
    $result_group = mysqli_query($conn, $groupId); //or die(mysqli_error($conn));
    //echo " " . $row["group_name"] . " ";

    while ($row = mysqli_fetch_assoc($result_group)) {
        echo    "<div class='card' id='group-card'>
                <div class='card-body'>
                    <h4 class='card-title'> " . $row["group_name"] . " </h4>
                    <h6 class='card-subtitle mb-2 text-muted'> " . $row["venue"] . " </h6><h6 class='card-subtitle mb-2 text-muted'> " . $row["date_time"] . "</h6>
                    <p class='card-text'> " . $row["description"] . " </p>
                </div>
            </div>";
    }
    ?>


    <!--Post-->
    
    <div class="discussion-post">
        <div class="card gedf-card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                            a post</a>
                    </li>
                </ul>
            </div>
            <form class="card-body" method="post" action=<?php echo " 'process-discussion.php?id=$id' " ?>>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                        <label class="sr-only" for="message">post</label>
                        <textarea class="form-control" name="discussion-post" id="message" rows="3" placeholder="What are you thinking?"></textarea>

                    </div>
                </div>
                <div class="btn-toolbar justify-content-between">
                    <div class="btn-group">
                        <button type="submit" id="share-button" class="btn btn-primary">Share</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Post-->

        <?php


        // inner join to get users details and group discussion data
        $innerjoin = "SELECT * FROM group_discussion INNER JOIN usersCITproject ON group_discussion.user_id = usersCITproject.id WHERE group_id = '$id' ";

        $profile = "SELECT * FROM profilesCITproject";
        //$postsQuery = "SELECT * FROM group_discussion WHERE group_id = '$id'";
        $postsResult = mysqli_query($conn, $innerjoin);
        $profileResult = mysqli_query($conn, $profile);

        while ($row = mysqli_fetch_assoc($postsResult)) {
            echo "<div class='card gedf-card' id='poster-name'>
        <div class='card-header'>
            <div class='d-flex justify-content-between align-items-center'>
                <div class='d-flex justify-content-between align-items-center'>
                    <div class='mr-2'>
                        <img class='rounded-circle' width='45' src=' $profileImg ' alt=''>
                    </div>
                    <div class='ml-2'>
                        <div class='h5 m-0'>" . $row['firstname'] . "</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class='card-body' id='discussion-card'>
        <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>" . $row['time'] . "</div>
        <a class='card-link' href='#'>
            <h5 class='card-title'></h5>
        </a>

        <p class='card-text'>
            " . $row['post_body'] . "
        </p>
    </div>  
    <div class='card-footer' id='comment-footer'>
    <a href='comments.php?id=" . $row["post_id"] . "' class='card-link'><i class='fa fa-comment'></i> Comments</a>
</div><br>";
        }
        ?>
    </div>
    </div>
    </div><!-- discussion post -->
    </div>
    <!-- Post /////-->

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


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</body>

</html>