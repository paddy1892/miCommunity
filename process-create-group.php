<?php
session_start();
include("conn/connect.php");
include("conn/password.php");

//$id = $row["id"];
$clubnamedata = mysqli_real_escape_string($conn, $_POST['club-name']);
$venuedata = mysqli_real_escape_string($conn,$_POST['venue']);
$dateTime = mysqli_real_escape_string($conn,$_POST["date-time"]);
$descriptiondata = mysqli_real_escape_string($conn,$_POST['description']);
$organizerdata = mysqli_real_escape_string($conn,$_POST['organizer']);

$insertClub = "INSERT INTO groupsCITproject (id, group_name, venue, date_time, description, organizer) VALUES (null, '$clubnamedata', '$venuedata', '$dateTime',
'$descriptiondata', '$organizerdata')";


$result = mysqli_query($conn, $insertClub);


header('Location: groups.php');

mysqli_close($conn);