<?php

session_start();

include_once('connect.php');
include_once('article.php');

echo 'If this page stays, something is broken. Check /cms/realedit.php and /cms/settings.php<br/>';

if (isset($_SESSION['logged_in'])){
    //behind the edit
    
    echo 'Pass 1/3<br/>';
    
    if (isset($_POST['title'], $_POST['content'], $_POST['id'])) {
        $title = $_POST['title'];
        $content = ($_POST['content']);
        $id = $_POST['id'];
        $summary = $_POST['summary'];
        $editTime = time();
        $tags = $_POST['tags'];
        
        echo 'Pass 2/3<br/>';
        
        if (empty($title) or empty($content)) {
            $error = 'All fields are required.';
            echo $error;
        } else {
            $query = $pdo->prepare('UPDATE articles SET article_title = ?, article_content = ?, article_summary = ?, article_edit_timestamp = ?, article_tags = ? WHERE article_id = ?');
            
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, $summary);
            $query->bindValue(4, $editTime);
            $query->bindValue(5, $tags);
            $query->bindValue(6, $id);
            
            $query->execute();
            
            echo 'Pass 3/3<br/>';
            
            echo '<br/>title: ',$title,'<br/>';
            echo 'content: ',$content,'<br/>';
            echo 'id: ',$id,'<br/><br/>';
            
            header('Location: index.php'); //Comment out for debuging
        }
    } else {
        echo 'Connection from edit.php failed?';
    }
    
} else {
    //redirect user
    header('Location: index.php');
}
    
?>
