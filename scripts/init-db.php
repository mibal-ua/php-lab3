<?php
$link = mysqli_connect("localhost", "root", "", "", 3306);
if ($link) {
    echo '<p>Connection to server was established</p>';
} else {
    echo "<p style='color: red'>Connection to server was NOT established</p>";
}

$db = "lab1_db";
$query = "CREATE DATABASE $db";

$create_db = mysqli_query($link, $query);
if ($create_db) {
    echo "<p>Database with name $db was created</p>";
} else {
    echo "<p style='color: red'>Database with name $db was NOT created</p>";
}
?>