<?php

include "headContent.php";

session_start();

$dirUploads = substr($uploads, 3); // takes off the two periods and '/'

$remove = array("..", "/.");

$disallow = array('.git', 'LICENSE', $dirUploads, 'cms'); // For directory searching, removes unwanted directories and files

function strposa($haystack, $needle, $offset=0) { // uses strpoos with arrays
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

if (isset($_SESSION['logged_in'])){
    //display add page
    
    if (isset($_GET['fileSelect'])){
        $file = $_GET['fileSelect'];
        
        //echo $file; //debug
        
        if (isset($_POST['fileEdit'])) {
            $slash = stripslashes($_POST['fileEdit']);
            $fileOpen = fopen($file,'w') or die ('Error editing. Check permissions!');
            fwrite($fileOpen,$slash);
            fclose($fileOpen) or die ("Error closing file! Check permissions!");
            
            header('Location: index.php');
        }
    }
    
    ?>
            
    <h1>Edit Static Content</h1>
    
    <a href="index.php">&larr; Back</a><br/><br/>
    
    <?php if (isset($error)) { ?>
        <small style="color:red;"><?php echo $error; ?></small>
        <br/><br/>
    <?php }
    
    ?>
    
    <form method="get">

        <select name="fileSelect"> <!-- ABSOLUTE PATHS! -->
                <option value="">
                </option>
                
                <?php
                $dir = new RecursiveDirectoryIterator($root);
                foreach (new RecursiveIteratorIterator($dir) as $entry) {
                    if (!strposa($entry, $disallow)){ // if $entry does NOT contain $disallow, show the rest
                        if (!strposa(substr($entry, -2), $remove)) {
                            echo '<option value="'.$entry.'">
                                 '.$entry.'
                                  </option>
                                 ';
                        }
                    }
                }
                ?>
        </select>

        <input type="submit" value="Edit"/>

    </form>

    <?php
    if (empty($file)) {

        echo '<p>Please select something to edit.</p>';

    } else {
        
        echo '<p class="panelBlue">Note: Some files require you to edit the source (click the &lt;&gt; icon)! </p>';
        echo '<p>Editing File: '.$file.'</p>';
        echo '<form method="post">';
        
        if (strpos($file, ".html")) {
echo '<textarea class="panelTextarea" name="fileEdit" id="wys">'; // Shows WYSIWYG editor & CANNOT have newlines under the tag!
        } else {
echo '<textarea class="panelTextarea" name="fileEdit" id="sc">'; // Shows source code instead & CANNOT have newlines under the tag!
        }
print (implode("",file($file))); // Cannot have tabs!!
    echo '</textarea><br /><br />';
    echo '<input type="submit" value="Save File" name="changeFile"/>';
    echo '</form>';
    
    }

} else {
    //redirect user
    header('Location: index.php');
}

include $footer;

?>
