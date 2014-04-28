<?php 
require "settings.php";
include $header;
?>

<link rel="stylesheet" href="panel.css"/>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({ // The wysiwyg editor
    selector: "textarea#wys", // Selects specific text area
    plugins: "code autolink link importcss", // shows source, pasting links, uses website style
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code", // custom toolbar
    content_css: "<?php echo $css; ?>", // uses website style
});
</script>

<?php include $nav ?>