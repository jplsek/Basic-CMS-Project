<?php

include "headContent.php";

session_start();

$dir = substr($uploads, 2); // takes off the two periods

if (isset($_SESSION['logged_in'])){
    //display delete page
    
    ?>
    <div class="panelLeft">
    
    <h1>Upload Files</h1>
    
    <?php
    
    echo '<span title="You can change this size in your php.ini settings.">Max file upload size: '.(ini_get('post_max_size')/8).' Megabyte(s)</span><br/><br/>';
    
    if (isset($_POST['submit'])){
        
        $fileError = $_FILES['file']['error'];
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileTemp = $_FILES['file']['tmp_name'];
        
        if ($fileError > 0) {
            echo '<span class="panelRed">Error Code: '.$fileError.'<br/>';
            if ($fileError == 1) {
                echo 'File size is too big! Increase the size limit in your php.ini! Please try again.</span>';
            } elseif ($fileError == 4) {
                echo 'You did not upload a file! <a href="upload.php">Try again</a>.</span>';
            } else {
                echo '
                    UPLOAD_ERR_INI_SIZE<br/>
                    Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.<br/><br/>
                    
                    UPLOAD_ERR_FORM_SIZE<br/>
                    Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.<br/><br/>

                    UPLOAD_ERR_PARTIAL<br/>
                    Value: 3; The uploaded file was only partially uploaded.<br/><br/>

                    UPLOAD_ERR_NO_FILE<br/>
                    Value: 4; No file was uploaded.<br/><br/>
                    
                    UPLOAD_ERR_NO_TMP_DIR<br/>
                    Value: 6; Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.<br/><br/>
                    
                    UPLOAD_ERR_CANT_WRITE<br/>
                    Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.<br/><br/>

                    UPLOAD_ERR_EXTENSION<br/>
                    Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0.<br/><br/></span>
                ';
            }
        } else {
        
            echo 'File Uploaded: <span class="panelBlue">'.$fileName.'</span><br/>';
            echo 'File Type: <span class="panelBlue">'.$fileType.'</span><br/>';
            echo 'File Size: <span class="panelBlue">'.($fileSize/1024).' kB</span><br/>';
            //echo 'Temp File: <span class="panelBlue">'.$fileTemp.'</span><br/><br/>';

            if (file_exists($uploads.$fileName)) {
                echo '<span class="panelRed">NOTICE:</span>
                    <span class="panelBlue">'.$fileName.'</span> 
                    already exists.<br/><br/>';
            } else {
              move_uploaded_file($fileTemp, $uploads.'/'.$fileName);
              echo '<span class="panelGreen">Success!</span><br/>
                    Stored in: <span class="panelBlue">'.$dir.'/'.$fileName. '</span><br/><br/>';
            }
            
            echo 'If you uploaded an image, you can show it with:<br/>
                <span class="panelBlue">
                    <code>
                        &lt;img src="'.$dir.'/'.$fileName.'" alt=""/&gt;
                    </code>
                </span><br/>';
            ?>
            </div>
            <div class="uploadRight">
                <img class="uploadImg" src="<?php echo $dir.'/'.$fileName; ?>"/>
            </div>
            <div class="panelClear">
            <?php
        }
        
    } else {
        
        ?>
        
        <form method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file"/><br/><br/>
            <input type="submit" name="submit" value="Submit" class="panelBtnBlue"/>
        </form><br/>
        
        <?php
        
    }
    
    echo '</div>'; //panelLeft
    
} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
