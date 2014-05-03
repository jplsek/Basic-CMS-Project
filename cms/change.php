<?php

include "headContent.php";

session_start();

if (isset($_SESSION['logged_in'])){
    //display change password page
    ?>
    
    <h1>Change Password</h1>
    
    <a href="./">&larr; Back</a><br/><br/>
    
    <?php
    if(isset($_POST['username'], $_POST['password'])){
        $usernameLogin = $_POST['username'];
        $passwordLogin = $_POST['password'];
        $passNew = $_POST['passwordNew'];
        $passConf = $_POST['passwordConfirm'];
            
        require 'key.php';
        
        function register($passwordCreate){

            // This creates the password hash
            $options = array('cost' => 6); // Scale this up as hardware gets better
            
            echo password_hash($passwordCreate, PASSWORD_BCRYPT, $options);
        }
        
        if ($usernameLogin == $user) {
            //echo '<br/>User is valid!';
            
            if (password_verify($passwordLogin, $passEnc)) {
                //echo '<br/>password is valid!';
                
                if ($passNew == $passConf){
                    
                    $options = array('cost' => $scale);
    
                    $passEncNew = password_hash($passNew, PASSWORD_BCRYPT, $options);
                    
                    $str = implode(file('key.php'));
                    $fileOpen = fopen('key.php','w') or die ('Error editing file. Check permissions!');
                    
                    $replace = str_replace($passEnc, $passEncNew, $str);
                    
                    fwrite($fileOpen, $replace);
                    fclose($fileOpen) or die ("Error closing file! Check permissions!");
                    
                    session_destroy();

                    header('Location: ./');
                    
                } else {
                    $error = 'You mistyped the new password.';
                }
                
            } else {
                $error = 'You mistyped your username or password.';
            }
            
        } else {
            $error = 'You mistyped your username or password.';
        }
              
    }
    ?>
        
    <form method="post">
        
        Username:<br/>
        <input type="text" name="username" placeholder="Username" required/><br/><br/>
        
        Current Password:<br/>
        <input type="password" name="password" placeholder="Current Password" required/><br/><br/>
        
        New Password:<br/>
        <input type="password" name="passwordNew" placeholder="New Password" required/><br/><br/>
        
        Confirm New Password:<br/>
        <input type="password" name="passwordConfirm" placeholder="Retype New Password" required/><br/><br/>
        <input type="submit" value="Submit"/><br/>
        
    </form>
    
    <?php
    
    if (isset($error)){
        echo '<p class="panelRed">'.$error.'</p>';
    }
    
} else {
    //redirect user
    header('Location: ./');
}

include $footer;

?>
