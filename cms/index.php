<?php

session_start();

// login page itself is standalone for what I think is better security reasons (not including settings.php for example)

if (isset($_SESSION['logged_in'])){
    //display index page
    
    include "headContent.php";
    
    ?>
    
    <h1>CMS</h1>
    
    <ol>
        <li><a href="add.php">Add Article</a></li>
        <li><a href="edit.php">Edit Article</a></li>
        <li><a href="delete.php">Delete Article</a></li>
        <br/>
        <li><a href="addPage.php">Add Page</a></li>
        <li><a href="editPage.php">Edit Page</a></li>
        <li><a href="deletePage.php">Delete Page</a></li>
        <br/>
        <li><a href="upload.php">Upload Files</a></li>
        <li><a href="browse.php">Browse Files</a></li>
        <br/>
        <li><a href="change.php">Change Password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>
    
    <small>Created by <a href="//www.jeremyplsek.com" title="Personal Website" target="_blank">Jeremy Plsek</a> | Version 0.8.0</small>
    
    <?php
    
    include $footer;
    
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
    
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>CMS Log In Page</title>
            <style>
                *{
                    box-sizing:border-box;
                }
                body{
                    font-family:arial, helvetica, sans;
                    background:#2F2F2F;
                }
                .logIn{
                    text-align:center;
                    margin:100px auto 0;
                    max-width:400px;
                    border:1px solid rgba(0,0,0,0.3);
                    border-radius:10px;
                    padding:10px;
                    background:#F5F5F5;
                }
                .btn{
                    color: #333;
                    background-color: #FFF;
                    border: 1px solid #CCC;
                    cursor: pointer;
                    border-radius: 4px;
                    padding:5px 7px;
                    text-decoration:none;
                    font-size:1em;
                    font-weight:400;
                }
                .btn:hover{
                    background:#EBEBEB;
                }
            </style>
        </head>
        <body>
    
    <div class="logIn">
        <h1>Log In</h1>
        
        <form action="./" method="post">
            <input type="text" name="username" placeholder="Username"/><br/><br/>
            <input type="password" name="password" placeholder="Password"/><br/><br/>
            <a href="/" class="btn">Main Website</a>
            <input type="submit" value="Login" class="btn"/><br/>
        </form>
        
        <?php if (isset($error)) {
            echo '<span class="panelRed"><strong>Error: '.$error.'</strong></span>';
        } ?>
        
    </div>
    
        </body>
    </html>

    <?php

}

?>
