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

$postbody = mysqli_real_escape_string($conn, $_POST['discussion-post']);
$groupId = $_GET['id'];
//echo "$groupId";

$insertDiscussion = "INSERT INTO group_discussion (post_id, post_body, user_id, group_id) VALUES (null, '$postbody', $myId, $groupId)";


$result = mysqli_query($conn, $insertDiscussion);

mysqli_close($conn);

header("Location: group-discussion.php?id=$groupId");
