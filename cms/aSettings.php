<?php

// Used when creating new pages and managing article settings ** These can be changed via the CMS settings panel afterwards ** Change defaults.php once these settings work properly

$headerAS  = "/assets/header.php"; // put your header file here
$navAS     = "/assets/nav.php";    // put your navigation file here
$footerAS  = "/assets/footer.php"; // put your footer file here
$blogAS  = "/blog"; // put location of blog here

$title = "CMS"; // The default page title when creating new pages

$dateFormat    = "m/d/Y"; // The date format on an article
$editedMessage = "Edited: "; // The message when an article has been edited
$summaryMax    = "530"; // The max amount of characters for the summary

// Ignore this stuff...

$rootA = $_SERVER["DOCUMENT_ROOT"];
$headerA  = $rootA.$headerAS;
$navA     = $rootA.$navAS;
$footerA  = $rootA.$footerAS;
$blogA    = $rootA.$blogAS;

// For CMS access only
$headerS  = $headerAS;
$navS     = $navAS;
$footerS  = $footerAS;
$uploadsS = "/uploads";
$blogS    = $blogAS;

?>
