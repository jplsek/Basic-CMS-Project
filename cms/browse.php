<?php

include "headContent.php";

session_start();

$dir = substr($uploads, 2); // takes off the two periods

if (isset($_SESSION['logged_in'])){
    ?>
    <h1>Browse Files</h1>
    
    <?php
    
    if ($handle = opendir($uploads)) {
        //echo 'Directory handle: '.$handle.'<br/><br/>';
    
        if (isset($_POST['delete'])){
            
            $delete = $_POST['delete'];
            
            unlink($uploads.'/'.$delete);
            
            echo '<p>File /uploads/'.$delete.' deleted.</p>';
        }
    
        while (false !== ($entry = readdir($handle))) {
            
            if ($entry != '.' && $entry != '..')
            echo '
            <div class="panelBrowse">
                <form action="browse.php" method="post">
                    <a href="'.$dir.'/'.$entry.'">'.$entry.'</a>
                    <input type="text" name="delete" value="'.$entry.'" readonly class="browseInputDelete"/>
                    <input type="submit" onclick="clicked(event)" value="Delete File" class="panelBtnRed"/>
                </form><br/>
                <img class="browseImg" src="'.$dir.'/'.$entry.'"/><br/>
                <p>You can show it with: 
                    <span class="panelBlue">
                        <code>
                            &lt;img src="'.$dir.'/'.$entry.'" alt=""/&gt;
                        </code>
                    </span>
                </p>
            </div>';
        }

        closedir($handle);
    }
} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
