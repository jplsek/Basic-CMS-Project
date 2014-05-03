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
        $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
        
        $query->bindValue(1,$id);
        $query->execute();
        
        header('Location: ./');
    }
    
    $articles = $article->fetch_all();
    
    $articles = array_reverse($articles); // sorts the ID's from the highest, down, instead of from lowest, up. This is for newer posts (higher ID's) to be on the top or the "newest". Later, I might implement to use the timestamp of the articles instead.
    
    ?>            
            <h1>Delete Posts</h1>
            
            <a href="index.php">&larr; Back</a><br/><br/>
            
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
                <input type="submit" onclick="clicked(event)" value="Delete"/>
                
            </form>
    <?php
} else {
    //redirect user
    header('Location: ./');
}

include "..".$footer;

?>
