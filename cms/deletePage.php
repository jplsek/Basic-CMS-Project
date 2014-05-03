<?php

include "headContent.php";

session_start();

$remove = array("/.."); // for direcotries
$remove2 = array("/."); // for files

$disallow = array('.git', 'LICENSE', $uploads, 'cms'); // For directory searching, removes unwanted directories and files

if (isset($_SESSION['logged_in'])){ ?>
    
    <h1>Delete Page</h1>
                
    <a href="./">&larr; Back</a><br/><br/>
    
    <?php
    
    if (isset($_POST['fileDelete'])){
        
        $name = $_POST['item']; // out: ../name/.. (or ../name.bar)
        
        $dirName1 = substr($name, 2, -2); // out: /name(.bar)
        $dirName2 = substr($name, 0, -2); // out: ../name
        $fileName1 = substr($name, 2); // out: /name.bar
        
        if (is_dir($name)) {
            
            function delTree($dir) {
               $files = array_diff(scandir($dir), array('.','..'));
                foreach ($files as $file) {
                    (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
                }
                return rmdir($dir);
            }
            
            deltree($dirName2);
            
            echo '<p class="panelGreen">Directory deleted: '.$dirName1.'</p>';
            
        } else {
            
            unlink($name);
            echo '<p class="panelGreen">File deleted: '.$fileName1.'</p>';
            
        }
        
    } else {
    
    ?>
    
        <form method="post"> <!-- create folder with the name and add the index.php and content.php to the folder -->
            Select what will be deleted:<br/>
            <select name="item">
                <option value=""></option>
                
                <?php
                
                $dir = new RecursiveDirectoryIterator($root);
                foreach (new RecursiveIteratorIterator($dir) as $entry) {
                    if (!strposa($entry, $disallow)){ // if $entry does NOT contain $disallow, show the rest
                        if (strposa($entry, $remove)) { // directories
                            echo '<option value="'.$entry.'">
                                 '.substr($entry, 2, -2).'
                                  </option>
                                 ';
                        } else if (!strposa($entry, $remove2)) { // files
                            echo '<option value="'.$entry.'">
                                 '.substr($entry, 2).'
                                  </option>
                                 ';
                        }
                    }
                }
                
                ?>
                
            </select><br/><br/>
            <input type="submit" onclick="clicked(event)" name="fileDelete" value="Delete" />
        </form>
            
    <?php
    }
} else {
    //redirect user
    header('Location: ./');
}

include $footer;
?>