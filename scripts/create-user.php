<?php
$link = mysqli_connect("localhost", "root", "", "", 3306);
if ($link) {
    echo '<p>Connection to server was established</p>';
} else {
    echo "<p style='color: red'>Connection to server was NOT established</p>";
}

$query =
    "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost'
        IDENTIFIED BY 'admin'
            WITH GRANT OPTION";
$create_user = mysqli_query($link, $query);
if ($create_user) {
    echo '<p>User was created</p>';
} else {
    echo "<p style='color: red'>User was NOT created</p>";
}