<!DOCTYPE html>
<html>

<?php
session_start();


include("conn/connect.php");
include("conn/password.php");
include("functions/functions.php");

if ($_GET["receiverid"] == "") {

    if (isset($_SESSION["email"])) {

        echo "is set email<br>";

        $email = $_SESSION["email"];
        $sessionQuery = "SELECT id FROM usersCITproject WHERE email = '$email'";
        //echo "Session Query = '$sessionQuery' <br>";

        $sessionResults = mysqli_query($conn, $sessionQuery); // or die(mysqli_error($conn));
        //echo "Got session results<br>";

        $row = mysqli_fetch_assoc($sessionResults);
        $myId = $row['id'];
    }
} else {

    $myId =  $_GET["receiverid"];
}

// SELECT * FROM `messages` WHERE (sender=1 and receiver=4) or (sender=4 and receiver=1) ORDER BY datetime
$msgquery = "SELECT * FROM messages WHERE (sender=" . $_GET["senderid"] . " AND receiver=" . $myId . ") OR (sender=" . $myId . " AND receiver=" . $_GET["senderid"] . ") ORDER BY datetime";
$messages = mysqli_query($conn, $msgquery);


?>

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

    <title>Messages</title>

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

    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Messenger </div>
            <div class="list-group list-group-flush">
                <?php
                $q = "SELECT firstname,surname,id FROM usersCITproject WHERE id != '$myId'";
                $r = mysqli_query($conn, $q);
                //$numRows = mysqli_num_rows($r);
                while ($row = mysqli_fetch_assoc($r)) {
                    echo "<a href='messages-box.php?senderid=" . $row['id'] . "&receiverid=" . $myId . "' class='list-group-item list-group-item-action bg-light'>" . $row["firstname"] . " " . $row["surname"] . "</a>";
                }
                ?>

            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- UI from CodePen by Sajad Hashemian    -->
            <?php
            $sql = "SELECT * FROM usersCITproject WHERE id = " . $_GET['senderid'] . " ";
            $senderName = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($senderName)) {

                echo " <section class='container' id='msger'>
                    <header class='msger-header'>
                        <div class='msger-header-title'>
                            <i class='fas fa-comment-alt'></i> " . $row['firstname'] . " " . $row['surname'] . " 
                        </div>
                        <div class='msger-header-options'>
                        </div>
                    </header>";
            }
            ?>
            <main class="msger-chat">

                <?php

                while ($row = mysqli_fetch_assoc($messages)) {
                    if ($row["sender"] == $myId) {
                        echo "<div class='msg right-msg'>
                                    <div class='msg-img' style='background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)'></div>

                                    <div class='msg-bubble' id='right-msg'>
                                        <div class='msg-info'>
                                        <div class='msg-text'>" . $row["body"] . "</div><br>

                                        <div class='msg-info-time'> " . $row["datetime"] . "</div><br>
                                            <div class='msg-info-name'> " . $row["firstname"] . "</div>
                                            
                                            
                                        </div>

                                    </div>
                                </div>";
                    } else {
                        echo "<div class='msg left-msg'>
                                    <div class='msg-img' style='background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)'></div>

                                    <div class='msg-bubble'>
                                        <div class='msg-info'>
                                            <div class='msg-info-name'>" . $sendername . "</div>
                                            <div class='msg-info-time'>" . $row["datetime"] . "</div><br>
                                            <div class='msg-text'>" . $row["body"] . "</div>
                                        </div>
                                    </div>
                                </div>";
                    }
                }

                //  if(empty($row['body'])) {
                //      echo "<p id='no-messages' style='text-align: center;'>No messages! Type a message below to start a conversation.</p>";
                //  }

                ?>

            </main>

            <?php
            echo "<form class='msger-inputarea' method='post' action='process-message.php?senderid=" . $_GET["senderid"] . "&receiverid=" . $myId . "'>";
            //mysqli_close($conn);
            ?>
            <input type="text" name="message-body" class="msger-input" placeholder="Enter your message...">
            <button type="submit" name="send-message" class="msger-send-btn">Send</button>
            </form>


            </section>

        </div>


        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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



        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>

</body>

</html>