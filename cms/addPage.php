<?php

include "headContent.php";

session_start();

$remove = array("/..");

$disallow = array('.git', 'LICENSE', $uploads, 'cms'); // For directory searching, removes unwanted directories and files

if (isset($_SESSION['logged_in'])){ ?>
    
    <h1>Add Page</h1>
    
    <?php
    
    if (isset($_POST['fileNew'])){
        
        $name = $_POST['fileName'];
        $location = substr($_POST['folder'], 0, -2); // removes last 2 periods
        $titlePage = $_POST['title'];
        $fileIndex = "index.php";
        $fileName = "content.html";
        
        $fullLocation = $location.$name.'/'; // out: ../location/folderNameCreated
        $dirName1 = substr($location, 2).$name; // out: /location/folderNameCreated
        $dirName2 = substr($fullLocation, 2).$name; // out: /location/fNC/newFileName
        $dirName3 = $fullLocation.$name; // Out: ../location/fNC/nFN
        
        if(!is_dir($fullLocation)){  // checks to see if the folder exsists.
            
            mkdir($fullLocation, 0771);
            
            echo '<p class="panelGreen">Created folder at: '.$dirName1.'.<p>
                  <p class="panelGreen">Created file: '.$fileIndex.' in '.$dirName1.'.<p>
                  <p class="panelGreen">Created file: '.$fileName.' in '.$dirName1.'.<p>
                 ';
            
            $fileOpen = fopen($fullLocation.$fileIndex,'w');
            fwrite($fileOpen,$index);
            fclose($fileOpen);
            
            $fileOpen = fopen($fullLocation.$fileName,'w');
            fwrite($fileOpen,'<h1>'.$titlePage.'</h1>');
            fclose($fileOpen);
            
            $str = implode(file($fullLocation.$fileIndex));
            $fileOpen = fopen($fullLocation.$fileIndex,'w');
            
            $replace = str_replace("ReplaceThisTitle", $titlePage, $str);
            
            fwrite($fileOpen, $replace);
            fclose($fileOpen);
            
            echo '<p>Would you like to <a href="editPage.php?fileSelect='.   $fullLocation.'content.html">edit '.$dirName1.'/content.html</a>?</p>
                  <p>You can link to it with:<br/>
                  <code>&lt;a href="'.$dirName1.'"&gt;<a href="'.$dirName1.'">'.$name.'</a>&lt;/a&gt;</code></p>
                 ';
            
        } else {
            
            if (!file_exists($dirName3.'.html')) {
                
                echo '<p class="panelBlue">Note: Destination folder already exists, only adding '.$dirName1.'.html.</p>';
                
                $fileOpen = fopen($dirName3.'.html','w');
                fwrite($fileOpen,"");
                fclose($fileOpen);
                
                echo '<p>Would you like to <a href="editPage.php?fileSelect='.$dirName3.'.html">edit '.$dirName2.'.html</a>?</p>
                      <p>You can link to it with:<br/>
                      <code>&lt;a href="'.$dirName2.'.html"&gt;<a href="'.$dirName2.'.html">'.$name.'.html</a>&lt;/a&gt;</code></p>
                     ';
            
            } else {
                echo '<p class="panelRed">Warning: <a href="'.$dirName2.'.html">'.$dirName2.'.html</a> exists.</p>
                      <p>Would you like to <a href="editPage.php?fileSelect='.$dirName3.'.html">edit '.$dirName2.'.html</a> or <a href="addPage.php">try again?</a></p>
                      <p>You can link to it with:<br/>
                      <code>&lt;a href="'.$dirName2.'.html"&gt;<a href="'.$dirName2.'.html">'.$name.'.html</a>&lt;/a&gt;</code></p>
                     ';
            }
        }
        
    } else {
    
    ?>
    
        <form method="post"> <!-- create folder with the name and add the index.php and content.php to the folder -->
            <label for="panelTitle">Page Title:</label><br/>
            <input id="panelTitle" type="text" name="title" placeholder="Enter Page Title"/><br/><br/>
            
            <label for="panelName">New File Name (without extensions):</label><br/>
            <input id="panelName" type="text" name="fileName" placeholder="Enter New Link Name" required/><br/><br/>
            
            <label for="panelFolder">Select where the link will be:</label><br/>
            <select id="panelFolder" name="folder">
                <option value=""></option>
                
                <?php
                
                $dir = new RecursiveDirectoryIterator($root);
                foreach (new RecursiveIteratorIterator($dir) as $entry) {
                    if (!strposa($entry, $disallow)){ // if $entry does NOT contain $disallow, show the rest
                        if (strposa($entry, $remove)) {
                            echo '<option value="'.$entry.'">
                                 '.substr($entry, 2, -2).'
                                  </option>
                                 ';
                        }
                    }
                }
                
                ?>
                
            </select><br/><br/>
            
            <input type="submit" name="fileNew" value="Submit" class="panelBtnBlue"/>
        </form>
            
    <?php
    }
} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';
?>
