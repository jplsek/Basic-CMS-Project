<?php

/*function register($userCreate,$passwordCreate){

    // This creates the password hash
    $options = array('cost' => 6); // Scale this up as hardware gets better
    
    echo password_hash($passwordCreate, PASSWORD_BCRYPT, $options);
    // $hash = password_hash($passwordCreate, PASSWORD_BCRYPT, $options);
}*/

/*function login($userLogin,$passwordLogin){

    //This is the actual (hashed) password!
    $hash = '$2y$11$PUVWfV.LuHD.rcgEotU1m.S3PJ/HWomsdzPoXz4hp6vj3X7X8GA6y';
    
    if (password_verify($passwordLogin, $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
}*/

$hash = '$2y$06$9RhwupGiy1jQRbogFHFmGeJBQxOd8nfh3OFChiy5PsWTAYFp7sYEO';

?>
