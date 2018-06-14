<?php

/*
    Logout page of Dental Information System
*/

// Start session
session_start();

// Destroy user session
session_destroy();

// Redirect to index.php
header("location: ../index.php");



?>