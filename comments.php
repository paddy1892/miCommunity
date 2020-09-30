<?php
session_start();
include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

if (isset($_SESSION["email"])) {

    //echo "is set email<br>";

    $email = $_SESSION["email"];
    $sessionQuery = "SELECT * FROM usersCITproject WHERE email = '$email'";
    //echo "Session Query = '$sessionQuery' <br>";

    $sessionResults = mysqli_query($conn, $sessionQuery); // or die(mysqli_error($conn));
    //echo "Got session results<br>";

    $row = mysqli_fetch_assoc($sessionResults);
    $myId = $row['id'];
    //$firstname = $row['firstname'];
}



$comment = "SELECT * FROM comments WHERE post_id = " . $_GET['id'] . "  ";
$commentResult = mysqli_query($conn, $comment);
if (mysqli_num_rows($commentResult) > 0) {
    while ($row = mysqli_fetch_assoc($commentResult)) {
        $commentBody = $row['comment'];
        $userId = $row['user_id'];
    }
}

$userData = "SELECT firstname FROM usersCITproject WHERE id = '$userId' ";
$userResult = mysqli_query($conn, $userData);
if (mysqli_num_rows($userResult) > 0) {
    while ($row = mysqli_fetch_assoc($userResult)) {
        $userFName = $row['firstname'];
        //$userId = $row['user-id'];
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

    <title>Comments</title>
</head>

<body>

    <!-- Nav bar -->
    <?php
    navBar();
    ?>


    <div class='discussion-post'>

        <?php

        $postid = $_GET['id'];
        $postId = "SELECT * FROM groups_discussion WHERE post_id = '$id' ";

        $result_group = mysqli_query($conn, $postId);


        $posts = "SELECT * FROM group_discussion WHERE post_id = '$postid'";
        $postsResult = mysqli_query($conn, $posts);

        // inner join to get users details and group discussion data
        // $innerjoin = "SELECT * FROM group_discussion INNER JOIN usersCITproject ON group_discussion.user_id = usersCITproject.id WHERE group_id = '$id' ";

        $profile = "SELECT * FROM profilesCITproject";
        $profileResult = mysqli_query($conn, $profile);

        while ($row = mysqli_fetch_assoc($postsResult)) {
            echo "<div class='card gedf-card' id='poster-name'>
<div class='card-header'>
    <div class='d-flex justify-content-between align-items-center'>
        <div class='d-flex justify-content-between align-items-center'>
            
            <div class='ml-2'>
                <div class='h5 m-0'>  </div>
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

<p class='paragraph'>
    " . $row['post_body'] . "
</p>
<hr>
<p class='paragraph' style='font-weight: bold;'>Comments</p>
<p class='paragraph'> $userFName: $commentBody </p>
<hr>
</div>";
        }
        ?>

        <?php echo   "<form class='card-body' method='post' id='comment-form' action='process-comments.php?id=$postid'>" ?>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                <label class="sr-only" for="message">post</label>
                <input class="form-control" name="comment-post" id="message" rows="3" placeholder="What are you thinking?"></input>

            </div>
        </div>
        <div class="btn-toolbar justify-content-between">
            <div class="btn-group">
                <button type="submit" id="share-button" class="btn btn-primary">Comment</button>
            </div>
        </div>
        </form>
    </div>


    <script>
        function text_size() {
            p_font = document.getElementByClassName('paragraph');
            p_font.style.fontSize = "150%";
        }

        function decrease_text() {
            font = document.getElementByClassName('paragraph');
            font.style.fontSize = "100%";
        }
    </script>
</body>



</html>