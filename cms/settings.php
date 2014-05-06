<?php

// CMS Specfic Settings

// ---Website settings---

// Note: This assumes that the cms is located in the docroot
$header  = "/assets/header.php"; // put your header file here (optional, can be empty)
$nav     = "/assets/nav.php";    // put your navigation file here (optional, can be empty)
$footer  = "/assets/footer.php"; // put your footer file here (optional, can be empty)
$css     = "/assets/style.css";  // put your stylesheet file here
$uploads = "/uploads"; // put your uploads folder here

// ---Database Settings---

$hostname         = "localhost"; // the hostname
$databaseName     = "cms"; // the database name within the database
$databaseUsername = "root"; // the database username
$databasePassword = ""; // the database username password

// NOW EDIT aSettings.php

// ---Password Settings---

$scale = 6; // Password encryption scaling. 1 takes the least processing, 6 is good (default), 12 is excessive.

?>
