<?php

include "assets/header.php";
include "assets/nav.php";

include_once('cms/connect.php');
include_once('cms/article.php');

$article = new Article;
$articles = $article->fetch_all();

$articles = array_reverse($articles); // sorts the ID's from the highest, down, instead of from lowest, up. This is for newer posts (higher ID's) to be on the top or the "newest". Later, I might implement to use the timestamp of the articles instead.

?>

<h2>Articles</h2>

<?php

if (isset($_GET['post'])){ // shows a specific post
    
    $id = $_GET['post'];
    $article = $article->fetch_data($id);
    
    $title = $article['article_title']; // separated these to make it easier to make a custom styled post
    $date = date('m/d/Y', $article['article_timestamp']);
    $content = $article['article_content'];
    
    ?>
    
    <div class="post">
        <div class="postTitle">
            <?php echo $title; ?>
        </div>
        
        <div class="postDate">
            <?php echo $date; ?>
        </div>
        
        <div style="clear:both"></div>
        
        <div class="postContent">
            <?php echo $content; ?>
        </div>
        
        <a href="/">&larr; Back</a>
    </div>
    
    <?php
    
    
} else { // shows all the posts

    foreach ($articles as $article) { // Starts the loop of the articles 
    
    $id = $article['article_id']; // separated these to make it easier to make a custom styled post
    $title = $article['article_title'];
    $date = date('m/d/Y', $article['article_timestamp']);
    $summary = $article['article_summary'];
    
    ?>
    
    <div class="post">
        
        <div class="postTitle">
            <a href="?post=<?php echo $id; ?>" class="postTitle">
                <?php echo $title; ?>
            </a>
        </div>
        
        <div class="postDate">
            <?php echo $date; ?>
        </div>
        
        <div style="clear:both"></div>
        
        <div class="postContent">
            <?php echo $summary; ?>
        </div>
        
        <div class="postFooter">
            <a href="?post=<?php echo $id; ?>" class="postNext">
                Continue Reading
            </a>
        </div>
        
    </div>
    
    

<?php

    } // foreache
} // end else

include "assets/footer.php";

?>
