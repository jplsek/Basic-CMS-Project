<?php

include "headContent.php";

session_start();

$dirUploads = substr($uploads, 3); // takes off the two periods and '/'

$remove = array("..", "/.");

$disallow = array('.git', 'LICENSE', $dirUploads, 'cms'); // For directory searching, removes unwanted directories and files

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
            
            header('Location: ./');
        }
    }
    
    ?>
            
    <h1>Edit Page</h1>
    
    <a href="./">&larr; Back</a><br/><br/>
    
    <?php if (isset($error)) { ?>
        <small style="color:red;"><?php echo $error; ?></small>
        <br/><br/>
    <?php }
    
    ?>
    
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
        </select>

        <input type="submit" value="Edit"/>

    </form>

    <?php
    if (empty($file)) {

        echo '<p>Please select something to edit.</p>';

    } else {
        
        echo '<p>Editing File: '.substr($file, 2).'</p>
              <form method="post">';
        
        if (strpos($file, ".html")) {
echo '<textarea class="panelTextarea" name="fileEdit" id="wys">'; // Shows WYSIWYG editor & CANNOT have newlines under the tag!
        } else {
echo '<textarea class="panelTextarea" name="fileEdit" id="sc">'; // Shows source code instead & CANNOT have newlines under the tag!
        }
print (implode("",file($file))); // Cannot have tabs!!
    echo '</textarea><br /><br />
          <input type="submit" value="Save File" name="changeFile"/>
          </form>';
    
    }

} else {
    //redirect user
    header('Location: ./');
}

include $footer;

?>
