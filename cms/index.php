<?php

session_start();

// login page itself is standalone for what I think is better security reasons (not including settings.php for example)

if (isset($_SESSION['logged_in'])){
    //display index page
    
    include "headContent.php";
    
    echo "<h1>Welcome!</h1><p>This is the starter page. (WIP)</p>";
    
    include 'footer.php';
    
} else {
    
    include 'aSettings.php';
    
    include $headerA;
    include $navA;
    
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
    
    <style>
        .logIn{
            text-align:center;
            margin:0 auto;
            max-width:400px;
            min-width:200px;
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
        a{
            color:inherit;
            text-decoration:none;
        }
    </style>
    
    <div class="logIn">
        <h1>Log In</h1>
        
        <form action="./" method="post">
            <input type="text" name="username" placeholder="Username"/><br/><br/>
            <input type="password" name="password" placeholder="Password"/><br/><br/>
            <button type="button" class="btn"><a href="/">Main Website</a></button>
            <input type="submit" value="Login" class="btn"/><br/>
        </form>
        
        <?php if (isset($error)) {
            echo '<span class="panelRed"><strong>Error: '.$error.'</strong></span>';
        } ?>
        
    </div>
    

    <?php

    include $footerA;
}

?>
