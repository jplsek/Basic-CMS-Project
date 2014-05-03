<?php

include "headContent.php";

session_start();

include_once('connect.php');
include_once('article.php');

$article = new Article;

if (isset($_SESSION['logged_in'])){
    //display delete page
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $data = $article->fetch_data($id);
                
        //echo $title;

        //header('Location: edit.php');
    }
    
    $articles = $article->fetch_all();
    
    $articles = array_reverse($articles); // sorts the ID's from the highest, down, instead of from lowest, up. This is for newer posts (higher ID's) to be on the top or the "newest". Later, I might implement to use the timestamp of the articles instead.
    
    ?>
            
            <h1>Edit Posts</h1>
            
            <a href="./">&larr; Back</a><br/><br/>
            
            <?php if (isset($error)) { ?>
                <small style="color:red;"><?php echo $error; ?></small>
                <br/><br/>
            <?php } ?>
            
            <form method="get">
            
                <select name="id">
                    <option>
                    </option>
                    <?php foreach ($articles as $article) { ?>
                        <option value="<?php echo $article['article_id']; ?>">
                            <?php echo $article['article_title']; ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="submit" value="Edit"/>
            
            </form>
            <br/>
            
            <?php if (empty($id)) { ?>

                Please select something to edit.
            
            <?php } else { ?>
            
                <form action="realedit.php" method="post" autocomplete="off">
                
                    ID:<br/>
                    <input type="text" name="id" readonly value="<?php echo $data['article_id']; ?>"/><br/><br/>
                    Title:<br/>
                    <input type="text" name="title" value="<?php echo $data['article_title']; ?>"/><br/><br/>
                    Content:<br/>
                    <textarea rows="15" name="content" id="wys"><?php echo $data['article_content']; ?></textarea><br/><br/>
                    Summary:<br/>
                    <textarea rows="11" name="summary" class="panelTextarea"><?php echo $data['article_summary']; ?></textarea><br/><br/>
                    Tags:<br/>
                    <input type="text" name="tags" value="<?php echo $data['article_tags']; ?>"/><br/><br/>
                    <input type="submit" value="Submit Edit"/>
                
                </form>
                
            <?php } ?>
    <?php
} else {
    //redirect user
    header('Location: ./');
}

include "..".$footer;

?>
