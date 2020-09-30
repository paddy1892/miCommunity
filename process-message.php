<?php 

if(isset($_POST['send-message'])) {

    include("conn/connect.php");
    include("conn/password.php");

    $q = "INSERT INTO messages (body, sender, receiver) VALUES (\"".$_POST["message-body"]."\",".$_GET["receiverid"].",".$_GET["senderid"].")";
    //echo "Session Query = $q<br>";
            
    $r = mysqli_query($conn, $q); // or die(mysqli_error($conn));
    //echo "Query result=$r<br>";
    header("Location: messages03.php?senderid=" . $_GET["senderid"] ."&receiverid=" . $_GET["receiverid"]."");

}

mysqli_close($conn);

?>
