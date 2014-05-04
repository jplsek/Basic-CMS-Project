<?php 

require "settings.php";

// Functions and strings for multiple files and other checks

function strposa($haystack, $needle, $offset=0) { // uses strpoos with arrays
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

// $root = $_SERVER["DOCUMENT_ROOT"]; // having a hard time making this work the way I want it to
$root = "..";

$header  = $root.$header;
$nav     = $root.$nav;
$footer  = $root.$footer;
$css     = $root.$css;
$uploads = $root.$uploads;

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

include 'aSettings.php';
include $header;

?>

<link rel="stylesheet" href="panel.css"/>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
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
    
</script>

<?php
    include $nav;
    include 'header.php';
?>
