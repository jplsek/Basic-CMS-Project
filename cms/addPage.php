<?php

require "headContent.php";

session_start();

$remove = array("/..", "\..");

$disallow = array('.git', 'LICENSE', $uploads, 'cms', $blog); // For directory searching, removes unwanted directories and files

if (isset($_SESSION['logged_in'])){ ?>

    <h1>Add Page</h1>

    <?php

    if (isset($_POST['fileNew'])){

        $name      = $_POST['fileName'];
        $location  = substr($_POST['folder'], 0, -2); // removes last 2 periods
        $titlePage = $_POST['title'];
        $fileIndex = "index.php";
        $fileName  = "content.html";
        if (!empty($_POST['page'])){
            $whatToDo  = $_POST['page'];
        }

        $fullLocation = $location.$name.'/'; // out: ../location/folderNameCreated
        $dirName1 = substr($location, 2).$name; // out: /location/folderNameCreated
        $dirName2 = substr($fullLocation, 2).$name; // out: /location/fNC/newFileName
        $dirName3 = $fullLocation.$name; // Out: ../location/fNC/nFN

        if (!empty($whatToDo)){ // checks if it's not empty (because there is only one option currently)

            // todo: check if duplicate

            if (!file_exists($location.$name)) {

                //echo $location.$name;

                $fileOpen = fopen($location.$name,'w');
                fwrite($fileOpen,'');
                fclose($fileOpen);

                echo '<p class="panelGreen">Created <a href="'.$dirName1.'">'.$dirName1.'</a></p>
                      <p>Would you like to <a href="editPage.php?fileSelect='.$location.$name.'">edit '.$name.'</a> or <a href="addPage.php">add another page</a>?</p>
                      <p>You can link to it with:<br/>
                      <code>&lt;a href="'.$dirName1.'"&gt;<a target="_blank" href="'.$dirName1.'">'.$name.'</a>&lt;/a&gt;</code></p>
                     ';

             } else {
                echo '<p class="panelRed">Warning: <a target="_blank" href="'.$dirName1.'">'.$dirName1.'</a> exists.</p>
                      <p>Would you like to <a href="editPage.php?fileSelect='.$dirName1.'">edit '.$name.'</a> or <a href="addPage.php">try again?</a></p>
                      <p>You can link to it with:<br/>
                      <code>&lt;a href="'.$dirName1.'"&gt;<a target="_blank" href="'.$dirName1.'.html">'.$name.'</a>&lt;/a&gt;</code></p>
                     ';

             }

        } else if (!is_dir($fullLocation)){  // checks to see if the folder exsists, then create the first page.

            mkdir($fullLocation, 0771);

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

            echo '<p class="panelGreen">Created folder: '.$dirName1.'<p>
                  <p class="panelGreen">Created file: '.$dirName1.'/'.$fileIndex.'<p>
                  <p class="panelGreen">Created file: '.$dirName1.'/'.$fileName.'<p>
                 ';

            echo '<p>Would you like to <a href="editPage.php?fileSelect='.   $fullLocation.'content.html">edit '.$name.'</a> or <a href="addPage.php">add another page</a>?</p>
                  <p>You can link to it with:<br/>
                  <code>&lt;a href="'.$dirName1.'"&gt;<a target="_blank" href="'.$dirName1.'">'.$name.'</a>&lt;/a&gt;</code></p>
                 ';

        } else {

            if (!file_exists($dirName3.'.html')) {

                echo '<p class="panelBlue">Note: Destination folder already exists, only adding '.$dirName1.'.html.</p>';

                $fileOpen = fopen($dirName3.'.html','w');
                fwrite($fileOpen,"");
                fclose($fileOpen);

                echo '<p>Would you like to <a href="editPage.php?fileSelect='.$dirName3.'.html">edit '.$dirName2.'.html</a>?</p>
                      <p>You can link to it with:<br/>
                      <code>&lt;a href="'.$dirName2.'.html"&gt;<a target="_blank" href="'.$dirName2.'.html">'.$name.'.html</a>&lt;/a&gt;</code></p>
                     ';

            } else {
                echo '<p class="panelRed">Warning: <a target="_blank" href="'.$dirName2.'.html">'.$dirName2.'.html</a> exists.</p>
                      <p>Would you like to <a href="editPage.php?fileSelect='.$dirName3.'.html">edit '.$dirName2.'.html</a> or <a href="addPage.php">try again?</a></p>
                      <p>You can link to it with:<br/>
                      <code>&lt;a href="'.$dirName2.'.html"&gt;<a target="_blank" href="'.$dirName2.'.html">'.$name.'.html</a>&lt;/a&gt;</code></p>
                     ';
            }
        }

    } else {

    ?>

    <span class="noticeIcon panelBGBlue" title="If you want a url to look like 'example.com/about', you would put 'about' in the 'New File Name'. Add any title (this will apply to the &lt;title&gt; tag and add a default &lt;h1&gt; to the page). Then select the root (/) folder. If you want to create just a file, make the 'New File Name' with 'about.txt' or 'about.html', then check the "Create only a file" box.">?</span>

        <form method="post"> <!-- create folder with the name and add the index.php and content.php to the folder -->

            <label for="panelName" title="ex: 'foobar' if a link, 'foobar.txt' if a file.">New File Name:</label><br/>
            <input id="panelName" type="text" name="fileName" placeholder="ex: 'foobar' if a link, 'foobar.txt' if a file." required/><br/><br/>

            <label for="panelTitle" title="optional">Page Title:</label><br/>
            <input id="panelTitle" type="text" name="title" placeholder="Enter Page Title"/><br/><br/>

            <label for="panelFolder">Select where the link will be:</label><br/>
            <select id="panelFolder" name="folder" required>
                <option></option>

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
            <label class="radio-inline">
                <input type="checkbox" name="page" value="file" title="the file name should have an extension (like .html or .txt)"/>
                Create only a file?
            </label><br/><br/>

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
