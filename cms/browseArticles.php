<?php

require "headContent.php";

session_start();

include_once 'connect.php';
include_once 'article.php';

$article = new Article;

if (isset($_SESSION['logged_in'])){
    //display delete page

    ?>

    <h1>Browse Posts</h1>

    <?php

    if (isset($_POST['title'], $_POST['content'], $_POST['id'])) {
        $title = $_POST['title'];
        $content = ($_POST['content']);
        $id = $_POST['id'];
        $summary = $_POST['summary'];
        $editTime = time();
        $tags = $_POST['tags'];

        //echo 'Pass 1/2<br/>';

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

            //echo 'Pass 2/2<br/>';

            //echo '<br/>title: ',$title,'<br/>';
            //echo 'content: ',$content,'<br/>';
            //echo 'tags: ',$tags,'<br/>';
            //echo 'id: ',$id,'<br/><br/>';

            echo '<p class="panelGreen">Post Editing Successful!</p>
                  <p>Would you like to <a href="browseArticles.php">edit another post</a>?</p>
                 ';

        }

    } else {

        if (isset($_GET['edit'])){

            $id = $_GET['id'];
            $data = $article->fetch_data($id);

            //echo $title;

            ?>

            <form action="browseArticles.php" method="post" autocomplete="off">

                <label>ID:</label><br/>
                <input type="text" name="id" class="panelReadonly" readonly value="<?php echo $data['article_id']; ?>"/><br/><br/>

                <label for="panelTitle">Title:</label><br/>
                <input id="panelTitle" type="text" name="title" value="<?php echo $data['article_title']; ?>" required/><br/><br/>

                <label>Content:</label><br/>
                <textarea rows="15" name="content" id="wys"><?php echo $data['article_content']; ?></textarea><br/><br/>

                <label for="panelSummary">Summary:</label><br/>
                <textarea id="panelSummary" rows="11" name="summary" class="panelTextarea" maxlength="<?php echo $summmaryMax; ?>"><?php echo $data['article_summary']; ?></textarea><br/><br/>

                <label for="panelTags">Tags:</label><br/>
                <input id="panelTags" type="text" name="tags" value="<?php echo $data['article_tags']; ?>"/><br/><br/>

                <input type="submit" value="Submit" class="panelBtnBlue"/>

            </form>

            <?php

        } else if (isset($_GET['delete'])){
            $id = $_GET['id'];
            $query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');

            $query->bindValue(1,$id);
            $query->execute();

            echo '<p class="panelGreen">Post deleted!</p>
                  <p>Would you like to <a href="browseArticles.php">delete another post</a>?</p>
                  ';

        } else {

            $articles = $article->fetch_all();

            $articles = array_reverse($articles); // sorts the ID's from the highest, down, instead of from lowest, up. This is for newer posts (higher ID's) to be on the top or the "newest". Later, I might implement to use the timestamp of the articles instead.

            ?>

            <p>Select a post to edit or delete.</p>

            <form method="get">

                <select name="id" required>
                    <option class="panelHide"></option>
                    <?php foreach ($articles as $article) { ?>
                        <option value="<?php echo $article['article_id']; ?>">
                            <?php echo $article['article_title']; ?>
                        </option>
                    <?php } ?>
                </select><br/><br/>
                <input type="submit" value="Edit" class="panelBtnGreen" name="edit"/>
                <input type="submit" onclick="clicked(event)" value="Delete" class="panelBtnRed" name="delete"/>

            </form>
            <br/>

            <?php if (isset($error)) { ?>

                <small style="color:red;"><?php echo $error; ?></small>
                <br/><br/>

            <?php }
        }
    }

} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
