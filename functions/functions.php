<?php


/* Nav bar */


function navBar() {
    echo "<nav class='navbar navbar-expand-lg navbar-light'>
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo03' aria-controls='navbarTogglerDemo03' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
</button>
<div class='navbar-toggler' id='menu-text'>Menu</div>
<div class='collapse navbar-collapse' id='navbarTogglerDemo03'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0' id='menu-links'>
        <li class='nav-link'>
            <a class='nav-link font-weight-bold' href='profile.php'>Profile<span class='sr-only'>(current)</span></a>
        </li>
        <li class='nav-link'>
            <a class='nav-link font-weight-bold' href='groups.php'>Groups</a>
        </li>
        <li class='nav-link'>
            <a class='nav-link font-weight-bold' href='people-nearby.php'>People Nearby</a>
        </li>
        <li class='nav-link'>
            <a class='nav-link font-weight-bold' href='messages.php'>Messages</a>
        </li>
        <li class='nav-link'>
            <a class='nav-link font-weight-bold' href='search.php'>Search</a>
        </li>
    </ul>";
    if (isset($_SESSION['email'])) {
        echo '<a href="logout.php" class="btn btn-outline-secondary" role="button" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>';
    }
    echo "</div>
</nav>";
}


?>
