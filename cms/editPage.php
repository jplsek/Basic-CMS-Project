<?php

include "headContent.php";

session_start();

$dirUploads = substr($uploads, 3); // takes off the two periods and '/'

$remove = array("..", "/.", "\.");

$disallow = array('.git', 'LICENSE', $dirUploads, 'cms'); // For directory searching, removes unwanted directories and files

if (isset($_SESSION['logged_in'])){
    //display add page
    
    ?>
            
    <h1>Edit Page</h1>
    
    <?php
    
    if (isset($_GET['fileSelect'])){
        $file = $_GET['fileSelect'];
        
        echo '<label for="sc">Editing File: '.substr($file, 2).'</label><br/>
              <form method="post">';
        
        if (strpos($file, ".html")) {
echo '<textarea class="panelTextarea" name="fileEdit" id="wys">'; // Shows WYSIWYG editor & CANNOT have newlines under the tag!
        } else {
echo '<textarea class="panelTextarea" name="fileEdit" id="sc">'; // Shows source code instead & CANNOT have newlines under the tag!
        }
print (implode("",file($file))); // Cannot have tabs!!
echo '</textarea><br /><br />
          <input type="submit" value="Save File" name="changeFile" class="panelBtnBlue"/>
          </form>';
        
        //echo $file; //debug
        
        if (isset($_POST['changeFile'])) {
            $slash = stripslashes($_POST['fileEdit']);
            $fileOpen = fopen($file,'w');
            fwrite($fileOpen,$slash);
            fclose($fileOpen);
            
            echo '<p class="panelGreen">Edit successful!</p>';
        }
        
    } else {
    
        ?>
        
        <p>Please select something to edit.</p>
        
        <form method="get">

            <select name="fileSelect" required>
                    <option value="">
                    </option>
                    
                    <?php
                    $dir = new RecursiveDirectoryIterator($root);
                    foreach (new RecursiveIteratorIterator($dir) as $entry) {
                        if (!strposa($entry, $disallow)){ // if $entry does NOT contain $disallow, show the rest
                            if (!strposa(substr($entry, -2), $remove)) {
                                echo '<option value="'.$entry.'">
                                     '.substr($entry, 2).'
                                      </option>
                                     ';
                            }
                        }
                    }
                    ?>
            </select><br/><br/>
            <input type="submit" value="Edit" class="panelBtnGreen"/>

        </form>
        
        <?php
    }

} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
