<?php

require "headContent.php";

session_start();

include_once 'connect.php';

if (isset($_SESSION['logged_in'])){
    //display add page
    
    ?>
    
    <h1>Add Post</h1>
    
    <?php
    
    if (isset($_POST['title'], $_POST['content'])) {
        $title   = $_POST['title'];
        $content = $_POST['content'];
        $tags    = $_POST['tags'];
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
            
            echo '<p class="panelGreen">Post Created!</p>
                 ';
        }
    } else {
    
        ?>
        
        <form method="post" autocomplete="off">
            
            <label for="panelTitle">Title:</label><br/>
            <input id="panelTitle" type="text" name="title" placeholder="Title" required /><br/><br/>
            
            <label>Content:</label><br/>
            <textarea rows="15" placeholder="Content" name="content" id="wys"></textarea><br/><br/>
            
            <label for="panelSummary">Summary:</label><br/>
            <textarea id="panelSummary" rows="11" class="panelTextarea" placeholder="Summary" name="summary" maxlength="<?php echo $summmaryMax; ?>"></textarea><br/><br/>
            
            <label for="panelTags">Tags:</label><br/>
            <input id="panelTags" type="text" name="tags" placeholder="Tags"/><br/><br/>
            
            <input type="submit" value="Submit" class="panelBtnBlue"/>
        
        </form>
        
        <?php if (isset($error)) { ?>
            <small style="color:red;"><?php echo $error; ?></small>
            <br/><br/>
        <?php }
    }
} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
