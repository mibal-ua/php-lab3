<?php
require_once('db-connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $query = "INSERT INTO classrooms (name) VALUES ('$name')";
    if (mysqli_query($link, $query)) {
        header("Location: classrooms.php");
        exit();
    } else {
        echo "<p class='error'>Сталася помилка при додаванні аудиторії.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Додати аудиторію</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Додати нову аудиторію</h1>
<form method="post" action="create-classroom.php">
    <label for="name">Назва:</label><br>
    <input type="text" id="name" name="name"><br><br>
    <input type="submit" value="Зберегти">
</form>
<div class="list-btns">
	<a href="javascript:history.back()" class="btn">Повернутись</a>
</div>
</body>
</html>
