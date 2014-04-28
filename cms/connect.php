<?php

include "settings.php";

try {
    $pdo = new PDO('mysql:host='.$hostname, $databaseUsername, $databasePassword);
    $pdo->query('create database '.$databaseName);
    $pdo->query('use '.$databaseName);
    $sql = "CREATE TABLE articles(
            article_id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
            article_title VARCHAR(255) NOT NULL,
            article_content TEXT NOT NULL,
            article_summary VARCHAR (500) NOT NULL,
            article_timestamp INTEGER NOT NULL,
            article_edit_timestamp INTEGER NOT NULL,
            article_tags TEXT NOT NULL
            );";
    $pdo->exec($sql);
    
} catch (PDOException $e) {
    echo '<span class="panelRed">Database <strong>login</strong> error. Check settings in settings.php</span><br/><br/>';
    var_dump($e->getMessage());
}

?>
