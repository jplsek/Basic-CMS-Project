<?php

include "headContent.php";

session_start();

include_once('connect.php');
include_once('article.php');

$article = new Article;

if (isset($_SESSION['logged_in'])){
    //display delete page
    
    ?>
    
    <h1>Delete Posts</h1>
    
    <?php
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
        
        $query->bindValue(1,$id);
        $query->execute();
        
        echo '<p class="panelGreen">Post deleted!</p>';
        
    } else {
    
        $articles = $article->fetch_all();
        
        $articles = array_reverse($articles); // sorts the ID's from the highest, down, instead of from lowest, up. This is for newer posts (higher ID's) to be on the top or the "newest". Later, I might implement to use the timestamp of the articles instead.
        
        ?>
        
        <p>Select a post to delete.</p>
        
        <form method="get">
        
            <select name="id" required>
                <option></option>
                <?php foreach ($articles as $article) { ?>
                    <option value="<?php echo $article['article_id']; ?>">
                        <?php echo $article['article_title']; ?>
                    </option>
                <?php } ?>
            </select><br/><br/>
            <input type="submit" onclick="clicked(event)" value="Delete" class="panelBtnRed"/>
            
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
