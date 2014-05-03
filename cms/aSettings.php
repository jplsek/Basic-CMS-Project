<?php

$headerA  = "/assets/header.php"; // put your header file here
$navA     = "/assets/nav.php";    // put your navigation file here
$footerA  = "/assets/footer.php"; // put your footer file here

$title = "CMS"; // The default page title when creating new pages

$dateFormat = "m/d/Y"; // The date format on an article

$editedMessage = "Edited: "; // The message when an article has been edited.

// Ignore this stuff...

$rootA = $_SERVER["DOCUMENT_ROOT"];
$headerA  = $rootA.$headerA;
$navA     = $rootA.$navA;
$footerA  = $rootA.$footerA;

?>
