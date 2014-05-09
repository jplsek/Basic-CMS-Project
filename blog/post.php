<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/cms/aSettings.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/cms/article.php';

if (isset($_GET['post'])){ // shows a specific post after a user clicks it
    
    $id = $_GET['post'];
    $article = $article->fetch_data($id);
    
    $title = $article['article_title']; // separated these to make it easier to make a custom styled post
    $date = date($dateFormat, $article['article_timestamp']);
    $tags = $article['article_tags'];
    
    if ($article['article_edit_timestamp'] == 0){ // checks to see if the article was ever edited (0 means that it has NEVER been edited)
        $edited = "";
    } else {
        $edited = $editedMessage.date('m/d/Y', $article['article_edit_timestamp']);
    }
    
    $content = $article['article_content'];
    
    ?>
    
    <div class="post">
        <div class="postTitle">
            <?php echo $title; ?>
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
            <?php echo $content; ?>
        </div>
        
        <div class="postFooter">
            <div class="postTags">
                <?php echo $tags; ?>
            </div>
            <a href="..">Back</a>
        </div>
    </div>
    
    <?php
}

?>
