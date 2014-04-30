<?php

include "headContent.php";

session_start();

include_once('connect.php');

if (isset($_SESSION['logged_in'])){
    //display add page
    
    if (isset($_POST['title'], $_POST['content'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $tags = $_POST['tags'];
        $summary = $_POST['summary'];
        
        if (empty($title) or empty($content)) {
            $error = 'Title and content fields required';
        } else {
            $query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_summary, article_timestamp, article_tags) VALUES (?, ?, ?, ?, ?)');
            
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, $summary);
            $query->bindValue(4, time());
            $query->bindValue(5, $tags);
            
            $query->execute();
            
            header('Location: ./');
        }
    }
    
    ?>
            
            <h1>Add Article</h1>
            
            <a href="./">&larr; Back</a><br/><br/>
            
            <?php if (isset($error)) { ?>
                <small style="color:red;"><?php echo $error; ?></small>
                <br/><br/>
            <?php } ?>
            
            <form action="add.php" method="post" autocomplete="off">
                
                Title:<br/>
                <input type="text" name="title" placeholder="Title" required /><br/><br/>
                Content:<br/>
                <textarea rows="15" placeholder="Content" name="content" id="wys"></textarea><br/><br/>
                Summary:<br/>
                <textarea rows="11" class="panelTextarea" placeholder="Summary" name="summary" maxlength="530"></textarea><br/><br/>
                Tags:<br/>
                <input type="text" name="tags" placeholder="Tags"/><br/><br/>
                <input type="submit" value="Add Article"/>
            
            </form>
    
    <?php
} else {
    //redirect user
    header('Location: ./');
}

include $footer;

?>
