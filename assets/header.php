<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php // this is optional
            if (isset($_GET['post'])) { // checks if a post is shown to show it in the title
                include_once $_SERVER["DOCUMENT_ROOT"].'/cms/article.php';
                $articleHTitle = $article->fetch_data($_GET['post']);
                echo $articleHTitle['article_title'].' - '.$title;
             } else if (empty($pageTitle)){ // checks if on a 'page'
                echo $title;
             } else { // fallback
                 echo $pageTitle; 
             }
             ?>
        </title>
        <link rel="stylesheet" href="/assets/style.css"/>
