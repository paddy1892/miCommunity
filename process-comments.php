<?php
session_start();
include("conn/connect.php");
include("conn/password.php");

$email = $_SESSION["email"];
$sessionQuery = "SELECT id FROM usersCITproject WHERE email = '$email'";
//echo "Session Query = '$sessionQuery' <br>";

$sessionResults = mysqli_query($conn, $sessionQuery); // or die(mysqli_error($conn));
//echo "Got session results<br>";

$row = mysqli_fetch_assoc($sessionResults);
$myId = $row['id'];
//echo "$myId <br>";

$comment = mysqli_real_escape_string($conn, $_POST['comment-post']);
$postId = $_GET['id'];
//echo "$groupId";

$insertcomments = "INSERT INTO comments (id, comment, user_id, post_id) VALUES (null, '$comment', $myId, $postId)";


$result = mysqli_query($conn, $insertcomments);

mysqli_close($conn);

header("Location: comments.php?id=$postId");