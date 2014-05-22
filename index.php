<?php

// You must have these 3 includes in this order:

include_once $_SERVER["DOCUMENT_ROOT"].'/cms/aSettings.php'; // has <title> information
include "assets/header.php"; // header information
include "assets/nav.php"; // navigation

?>

<h2>Articles</h2>

<?php

if (isset($_GET['post'])){ // if a post is clicked, show the singular post

    include $blogA.'/post.php';

} else {

    include $blogA.'/articles.php'; // else, show all the posts

}

include "assets/footer.php";

?>
