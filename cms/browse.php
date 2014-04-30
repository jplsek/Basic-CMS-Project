<?php

include "headContent.php";

session_start();

$dir = substr($uploads, 2); // takes off the two periods

if (isset($_SESSION['logged_in'])){
    ?>
    <h1>Browse Files</h1>
                
    <a href="index.php">&larr; Back</a><br/><br/>
    
    <script>
        function clicked(e){
            if(!confirm('Are you sure? This will be deleted permanently!'))e.preventDefault();
        }
    </script>
    <?php
    
    if ($handle = opendir($uploads)) {
        //echo 'Directory handle: '.$handle.'<br/><br/>';
    
        if (isset($_POST['delete'])){
            $delete = $_POST['delete'];
            unlink($uploads.'/'.$delete);
            echo '<strong>You deleted /uploads/'.$delete.'<br/><br/></strong>';
        }
    
        while (false !== ($entry = readdir($handle))) {
            if ($entry != '.' && $entry != '..')
            echo '
            <div class="panelBrowse">
                <form action="browse.php" method="post">
                    <a href="'.$dir.'/'.$entry.'">'.$entry.'</a>
                    <input type="text" name="delete" value="'.$entry.'" readonly class="browseInputDelete"/>
                    <input type="submit" onclick="clicked(event)" value="Delete File"/>
                </form><br/>
                <img class="browseImg" src="'.$dir.'/'.$entry.'"/><br/>
                <span class="panelBlue">
                    <code>
                        &lt;img src="'.$dir.'/'.$entry.'" alt=""/&gt;
                    </code>
                </span>
            </div>';
        }

        closedir($handle);
    }
} else {
    //redirect user
    header('Location: index.php');
}

include $footer;

?>
