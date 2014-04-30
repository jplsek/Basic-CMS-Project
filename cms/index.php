<?php

include "headContent.php";

session_start();

if (isset($_SESSION['logged_in'])){
    //display index page
    ?>
    
    <h1>CMS</h1>
    
    <ol>
        <li><a href="add.php">Add Article</a></li>
        <li><a href="edit.php">Edit Article</a></li>
        <li><a href="delete.php">Delete Article</a></li>
        <li><a href="addPage.php">Add Page</a></li>
        <li><a href="static.php">Edit Page</a></li>
        <li><a href="upload.php">Upload Files</a></li>
        <li><a href="browse.php">Browse Files</a></li>
        <li><a href="change.php">Change Password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>
    
    <small>Created by <a href="//www.jeremyplsek.com" title="Personal Website" target="_blank">Jeremy Plsek</a> | Version 0.7.0</small>
    
    <?php
} else {
    
    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) or empty($password)) {
            $error = 'All fields are required.';
        } else {
        
            require 'key.php';
            
            if ($username == $user) {
                if (password_verify($password, $passEnc)) {
                    // user correct
                    $_SESSION['logged_in'] = true;
                    header('Location: ./');
                    exit();
                } else {
                    // user false
                    $error = 'Incorrect username or password.';
                }
            } else {
                // user false
                $error = 'Incorrect username or password.';
            }
        }
    }

    ?>
    
    <div class="panelLogIn">
        <h1>Log In</h1>
        
        <form action="./" method="post">
            <input type="text" name="username" placeholder="Username"/><br/><br/>
            <input type="password" name="password" placeholder="Password"/><br/><br/>
            <input type="submit" value="Login"/><br/>
        </form>
        
        <?php if (isset($error)) {
            echo '<span class="panelRed"><strong>Error: '.$error.'</strong></span>';
        } ?>
        
    </div>
    <br/>

    <?php

}

include $footer;

?>
