<?php

require "headContent.php";
require "aSettings.php";

session_start();

if (isset($_SESSION['logged_in'])){
    //display change password page
    ?>

    <h1>Change Settings</h1>

    <?php

    if (isset($_POST['change'])){

        $titleNew         = $_POST['pageTitle'];
        $dateFormatNew    = $_POST['dateFormat'];
        $editedMessageNew = $_POST['editedMessage'];
        $summaryMaxNew   = $_POST['summaryCount'];
        $headerASNew     = $_POST['articleHeader'];
        $navASNew       = $_POST['articleNav'];
        $blogASNew     = $_POST['articleBlog'];
        $footerASNew  = $_POST['articleFooter'];

        replace('aSettings.php', $title, $titleNew);
        replace('aSettings.php', $dateFormat, $dateFormatNew);
        replace('aSettings.php', $editedMessage, $editedMessageNew);
        replace('aSettings.php', $summaryMax, $summaryMaxNew);
        replace('aSettings.php', $headerAS, $headerASNew);
        replace('aSettings.php', $navAS, $navASNew);
        replace('aSettings.php', $blogAS, $blogASNew);
        replace('aSettings.php', $footerAS, $footerASNew);

        echo '<p class="panelGreen">Change Successful!</p>
              <p>Article header location has been changed to: <span class="panelGreen">'.$headerASNew.'</span></p>
              <p>Article Navigation location has been changed to: <span class="panelGreen">'.$navASNew.'</span></p>
              <p>Article Blog location has been changed to: <span class="panelGreen">'.$blogASNew.'</span></p>
              <p>Article Footer has been changed to: <span class="panelGreen">'.$footerASNew.'</span></p>
              <p>Page title has been changed to: <span class="panelGreen">'.$titleNew.'</span></p>
              <p>Date format has been changed to: <span class="panelGreen">'.$dateFormatNew.'</span></p>
              <p>Edited message has been changed to: <span class="panelGreen">'.$editedMessageNew.'</span></p>
              <p>Summary count has been changed to: <span class="panelGreen">'.$summaryMaxNew.'</span></p>
             ';

    } else if (isset($_POST['reset'])){

        require "defaults.php";

        replace('aSettings.php', $title, $titleDefault);
        replace('aSettings.php', $dateFormat, $dateFormatDefault);
        replace('aSettings.php', $editedMessage, $editedMessageDefault);
        replace('aSettings.php', $summaryMax, $summaryMaxDefault);
        replace('aSettings.php', $headerAS, $headerASDefault);
        replace('aSettings.php', $navAS, $navASDefault);
        replace('aSettings.php', $blogAS, $blogASDefault);
        replace('aSettings.php', $footerAS, $footerASDefault);

        echo '<p class="panelGreen">Change Successful!</p>
              <p>Article header location has been changed to: <span class="panelGreen">'.$headerASDefault.'</span></p>
              <p>Article Navigation location has been changed to: <span class="panelGreen">'.$navASDefault.'</span></p>
              <p>Article Blog location has been changed to: <span class="panelGreen">'.$blogASDefault.'</span></p>
              <p>Article Footer has been changed to: <span class="panelGreen">'.$footerASDefault.'</span></p>
              <p>Page title has been changed to: <span class="panelGreen">'.$titleDefault.'</span></p>
              <p>Date format has been changed to: <span class="panelGreen">'.$dateFormatDefault.'</span></p>
              <p>Edited message has been changed to: <span class="panelGreen">'.$editedMessageDefault.'</span></p>
              <p>Summary count has been changed to: <span class="panelGreen">'.$summaryMaxDefault.'</span></p>
             ';

    } else {

        ?>

        <form method="post">

            <label for="articleHeader">Header Location:</label><br/>
            <input id="articleHeader" type="text" name="articleHeader" value="<?php echo $headerAS; ?>"/><br/><br/>

            <label for="articleNav">Navigation Location:</label><br/>
            <input id="articleNav" type="text" name="articleNav" value="<?php echo $navAS; ?>"/><br/><br/>

            <label for="articleBlog">Blog Location (folder):</label><br/>
            <input id="articleBlog" type="text" name="articleBlog" value="<?php echo $blogAS; ?>"/><br/><br/>

            <label for="articleFooter">Footer Location:</label><br/>
            <input id="articleFooter" type="text" name="articleFooter" value="<?php echo $footerAS; ?>"/><br/><br/>

            <label for="panelTitle">Page Title:</label><br/>
            <input id="panelTitle" type="text" name="pageTitle" value="<?php echo $title; ?>" required/><br/><br/>

            <label for="panelDate">
                Blog Date
                <a href="http://php.net/manual/en/function.date.php" title="PHP Date Manual" target="_blank">Format</a>
                <small>(<?php echo date($dateFormat, time()); ?>)</small>:
            </label><br/>
            <input id="panelDate" type="text" name="dateFormat" value="<?php echo $dateFormat; ?>" required/><br/><br/>

            <label for="panelEdit">Blog Edited Message:</label><br/>
            <input id="panelNewEdit" type="text" name="editedMessage" value="<?php echo $editedMessage; ?>"/><br/><br/>

            <label for="panelSummary">Blog Summary Character Count:</label><br/>
            <input id="panelSummary" type="number" name="summaryCount" value="<?php echo $summaryMax; ?>"/><br/><br/>

            <input type="submit" value="Submit" name="change" class="panelBtnBlue"/><br/>

        </form><br/>

        <form method="post">

            <input type="submit" value="Reset Settings" onclick="clicked(event)" name="reset" class="panelBtnGreen"/><br/>

        </form>

        <span class="noticeIcon panelBGRed" title="Warning: Do not have the same 'settings' value as other settings (this includes empty values)! This will be fixed in a later version! (ex: 'header: /empty' and 'footer: /empty')">!</span>

        <?php

    }

} else {
    //redirect user
    header('Location: ./');
}

include 'footer.php';

?>
