<?php
$link = mysqli_connect("localhost", "root", "", "lab1_db", 3306);
if (!$link) {
    echo "<p style='color: red'>Connection to server was NOT established</p>";
}
