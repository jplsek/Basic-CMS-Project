<?php

require "headContent.php";

session_start();

if (isset($_SESSION['logged_in'])){
    //display change password page
    ?>

    <h1>Change Password</h1>

    <?php
    if(isset($_POST['passwordSubmit'])){
        $usernameLogin = $_POST['username'];
        $passwordLogin = $_POST['password'];
        $passNew  = $_POST['passwordNew'];
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

                    replace('key.php',$passEnc, $passEncNew);

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

        <label for="panelUser">Username:</label><br/>
        <input id="panelUser" type="text" name="username" placeholder="Username" required/><br/><br/>

        <label for="panelPass">Current Password:</label><br/>
        <input id="panelPass" type="password" name="password" placeholder="Current Password" required/><br/><br/>

        <label for="panelNewPass">New Password:</label><br/>
        <input id="panelNewPass" type="password" name="passwordNew" placeholder="New Password" required/><br/><br/>

        <label for="panelCNewPass">Confirm New Password:</label><br/>
        <input id="panelCNewPass" type="password" name="passwordConfirm" placeholder="Retype New Password" required/><br/><br/>

        <input type="submit" value="Submit" name="passwordSubmit" class="panelBtnBlue"/><br/>

    </form>

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
