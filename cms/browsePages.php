<?php

require "headContent.php";

session_start();

$dirUploads = substr($uploads, 3); // takes off the two periods and '/'

$remove = array("/..", "\.."); // for direcotries
$remove2 = array("/.", "\."); // for files

$disallow = array('.git', 'LICENSE', $uploads, 'cms', '../..', '..\..', 'README.md', $blog); // For directory searching, removes unwanted directories and files

if (isset($_SESSION['logged_in'])){
    //display add page

    ?>

    <h1>Browse Pages</h1>

    <?php

    if (isset($_GET['edit'])){ // when edit is pressed...
        $file = $_GET['item'];
        $fileRoot = substr($file, 2); // removes first 2 periods

        if (strpos($fileRoot, '/.')){ // checks if selecting a folder

            echo '<p class="panelYellow">You selected a folder, not a file! <a href="browsePages.php">Try again</a>.</p>';

        } else if (isset($_POST['changeFile'])) { // checks if sending an acutal edit

            $slash = stripslashes($_POST['fileEdit']);
            $fileOpen = fopen($file,'w');
            fwrite($fileOpen,$slash);
            fclose($fileOpen);

            echo '<p class="panelGreen">Edit successful!</p>';

            if (strpos($fileRoot, 'content.html')){ // checks if content.html exsists to change the file name to look liek the appropriate folder.

                $fileRootDir  = substr($fileRoot, 0, -13);
                $fileRootDir1 = substr($fileRoot, 1, -13);

                echo '<p>Would you like to view <a target="_blank" href="'.$fileRootDir.'">'.$fileRootDir1.'</a>?</p>
                      <p>Or wourld you like to <a href="browsePages.php">edit another page</a>?</p>';

            } else { // shows the normal text

                echo '<p>Would you like to view <a target="_blank" href="'.$fileRoot.'">'.$fileRoot.'</a> or <a href="browsePages.php">edit another page</a>?</p>';

            }

        } else { // Shows the editing panel

            echo '<label for="sc">Editing File: '.$fileRoot.'</label><br/>
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

        }

    } else if (isset($_GET['delete'])){ // when delte is pressed...

            $name = $_GET['item']; // out: ../name/.. (or ../name.bar)

            $dirName1  = substr($name, 2, -2); // out: /name(.bar)
            $dirName2  = substr($name, 0, -2); // out: ../name
            $fileName1 = substr($name, 2);     // out: /name.bar

            if (is_dir($name)) {

                function delTree($dir) {
                   $files = array_diff(scandir($dir), array('.','..'));
                    foreach ($files as $file) {
                        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
                        echo '<p class="panelGreen">Deleted: '.substr($dir, 2).$file.'</p>';
                    }
                    return rmdir($dir);
                }

                deltree($dirName2);

                echo '<p class="panelGreen">Deleted: '.$dirName1.'</p>';

            } else {

                unlink($name);
                echo '<p class="panelGreen">File deleted: '.$fileName1.'</p>';

            }

            echo '<p>Would you like to <a href="browsePages.php">delete another page</a>?</p>';

        } else {

        ?>

        <p>Select a file to edit or delete.</p>

        <form method="get">

            <select name="item" required>
                    <option class="panelHide"></option>

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
            <input type="submit" value="Edit" class="panelBtnGreen" name="edit"/>
            <input type="submit" onclick="clicked(event)" value="Delete" class="panelBtnRed" name="delete"/>

        </form>

        <?php
    }

} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
