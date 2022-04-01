<?php

// AUTHORS: Rachel Zhao

// LINK TO SERVER: https://cs4640.cs.virginia.edu/rwz4qy/myTheater
// LINK TO GOOGLE CLOUD PLATFORM: 

// Sources used: https://developers.themoviedb.org/3

session_start();

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// Parse the query string for command
$command = "login";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// If the user's email is not set in the cookies, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!
if (!isset($_SESSION["email"])) {
    // they need to see the login
    $command = "login";
}

// Instantiate the controller and run
$theater = new TheaterController($command);
$theater->run();