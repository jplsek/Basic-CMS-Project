<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/cms/aSettings.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/cms/article.php';

$articles = array_reverse($articles); // sorts the ID's from the highest, down, instead of from lowest, up. This is for newer posts (higher ID's) to be on the top or the "newest". Later, I might implement to use the timestamp of the articles instead.

foreach ($articles as $article) { // Starts the loop of the articles 

    $id = $article['article_id']; // separated these to make it easier to make a custom styled post
    $title = $article['article_title'];
    $date = date($dateFormat, $article['article_timestamp']);
    $summary = $article['article_summary'];
    $tags = $article['article_tags'];

    if ($article['article_edit_timestamp'] == 0){ // checks to see if the article was ever edited (0 means that it has NEVER been edited)
        $edited = "";
    } else {
        $edited = $editedMessage.date('m/d/Y', $article['article_edit_timestamp']);
    }

    ?>

    <div class="post">
        
        <div class="postTitle">
            <a href="?post=<?php echo $id; ?>" class="postTitle">
                <?php echo $title; ?>
            </a>
        </div>
        
        <div class="postDate">
            <?php echo $date; ?>
            <br/>
            <span class="postEdit">
                <?php echo $edited; ?>
            </span>
        </div>
        
        <div style="clear:both"></div>
        
        <div class="postContent">
            <?php echo $summary; ?>
        </div>
        
        <div class="postFooter">
            <div class="postTags">
                <?php echo $tags; ?>
            </div>
            <a href="?post=<?php echo $id; ?>" class="postNext">
                Continue Reading
            </a>
        </div>
        
    </div>

<?php

}

?>
