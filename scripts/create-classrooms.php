<?php
$link = mysqli_connect("localhost", "root", "", "", 3306);
if ($link) {
    echo '<p>Connection to server was established</p>';
} else {
    echo "<p style='color: red'>Connection to server was NOT established</p>";
}

$db = "lab1_db";
$select_db = mysqli_select_db($link, $db);
if ($select_db) {
    echo "<p>Database $db was selected</p>";
} else {
    echo "<p style='color: red'>Database $db was NOT selected</p>";
}

$query =
    "CREATE TABLE classrooms (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
$create_table = mysqli_query($link, $query);
if ($create_table) {
    echo '<p>Table was created</p>';
} else {
    echo "<p style='color: red'>Table was NOT created</p>";
}
