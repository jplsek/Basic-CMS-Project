<?php

include "headContent.php";

session_start();

if (isset($_SESSION['logged_in'])){
    //display change password page
    ?>
    
    <h1>Change Article Settings - WIP</h1>
    
    <?php
    //if(isset()){
            
              
    //}
    ?>
      
      (edit cms/aSettings.php for now)<br/><br/>
        
    <form method="post">
        
        <label for="panelTitle">Page Title:</label><br/>
        <input id="panelTitle" type="text" name="username" required/><br/><br/>
        
        <label for="panelDate">Date Format:</label><br/>
        <input id="panelDate" type="text" name="password" Password" required/><br/><br/>
        
        <label for="panelEdit">Edited Message:</label><br/>
        <input id="panelNewEdit" type="text" name="passwordNew"required/><br/><br/>
        
        <label for="panelSummary">Summary Character Count:</label><br/>
        <input id="panelSummary" type="text" name="passwordConfirm" required/><br/><br/>
        
        <input type="submit" value="Submit" name="change" class="panelBtnBlue"/><br/>
        
    </form><br/>
    
    <form method="post">
        
        <input type="submit" value="Reset Settings" name="reset" class="panelBtnGreen"/><br/>
        
    <form>
    
    <?php
    
    if (isset($error)){
        echo '<p class="panelRed">'.$error.'</p>';
    }
    
} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
