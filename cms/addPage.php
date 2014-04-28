<?php

include "headContent.php";

session_start();

if (isset($_SESSION['logged_in'])){ ?>
    <h1>Add Page - WIP</h1>
                
    <a href="index.php">&larr; Back</a><br/><br/>
        
<?php
} else {
    //redirect user
    header('Location: index.php');
}

include $footer;
?>