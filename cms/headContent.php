<?php

include_once "settings.php";

// Functions and strings for multiple files and other checks

function strposa($haystack, $needle, $offset=0) { // uses strpoos with arrays
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

function replace($fileChange, $original, $new){ // (fileToOpen, StringContentToChange, StringContentToReplaceOriginal) - replaces string contentents in a file, there's probably a better way
    $str = implode(file($fileChange));
    $fileOpen = fopen($fileChange,'w');

    $replace = str_replace($original, $new, $str);

    fwrite($fileOpen, $replace);
    fclose($fileOpen);
}

// $root = $_SERVER["DOCUMENT_ROOT"]; // having a hard time making this work the way I want it to (some strings are used a links)

include 'aSettings.php';

$root = "..";

$header  = $root.$headerS;
$nav     = $root.$navS;
$footer  = $root.$footerS;
$css     = $root.$cssS;
$uploads = $root.$uploadsS;
$blog    = $root.$blogS;

$index = '
<?php
include $_SERVER["DOCUMENT_ROOT"]."/cms/aSettings.php";
$pageTitle = "ReplaceThisTitle - ".$title; // Dont change this, used in addPage.php
include $headerA;
include $navA;
include "content.html";
include $footerA;
?>
';

if(!is_dir($uploads)){
    mkdir($uploads, 0771);
}

if ($header != $root){ // checks to see if the $header is empty
    include $header;
} else {

    ?>

    <!DOCTYPE html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>CMS</title>
            <meta name="viewport" content="width=device-width">

    <?php

}

?>

<link rel="stylesheet" href="panel.css"/>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script>

tinymce.init({ // The wysiwyg editor
    selector: "textarea#wys", // Selects specific text area
    plugins: "code autolink link importcss", // shows source, pasting links, uses website style
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code", // custom toolbar
    content_css: "<?php echo $css; ?>", // uses website style
});

function clicked(e){
    if(!confirm('Are you sure? This will be deleted permanently!'))e.preventDefault();
}

$(document).ready(function(){
    $(".multipleSelect").css("height", parseInt($(".multipleSelect option").length) * 20);
});

</script>

<?php

if ($nav != $root){ // checks to see if $nav is empty
    include $nav;
} else {
    echo '</head>';
}

?>

<div id="panelContainer">
    <div class="panelChoose">
        <h1 class="panelTitle"><a href="./">CMS</a></h1>

            <ul class="panelNav">
                <li><a href="add.php">Add Article</a></li>
                <li><a href="browseArticles.php">Browse Articles</a><br/></li>
                <li><a href="addPage.php">Add Page</a></li>
                <li><a href="browsePages.php">Browse Pages</a><br/></li>
                <li><a href="upload.php">Upload Files</a></li>
                <li><a href="browse.php">Browse Files</a><br/></li>
                <li><a href="articleSettings.php">Settings</a></li>
                <li><a href="change.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

            <small class="panelMention">Created by <a href="//www.jeremyplsek.com" title="Personal Website" target="_blank">Jeremy Plsek</a><br/> Version 0.8.10</small>
        </div>
        <div class="panelContent">
