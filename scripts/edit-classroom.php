<?php
require_once('db-connect.php');
if (isset($_GET['id'])) {

    $classroom_id = $_GET['id'];
    $query = "SELECT * FROM classrooms WHERE id = $classroom_id";
    $result = mysqli_query($link, $query);
    $classroom = mysqli_fetch_assoc($result);

    if (!$classroom) {
        echo "<p class='error'>Аудиторії не знайдено.</p>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	if (empty($name)) {
		echo "<p class='error'>Назва аудиторії є обов'язковою!</p>";
	} else {
		$update_query = "UPDATE classrooms SET name = '$name' WHERE id = $classroom_id";
		if (mysqli_query($link, $update_query)) {
			header("Location: classrooms.php");
			exit();
		} else {
			echo "<p class='error'>Сталася помилка при оновленні даних.</p>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Редагувати аудиторію</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Редагувати аудиторію</h2>
<form action="edit-classroom.php?id=<?php echo $classroom_id; ?>" method="POST">
	<label for="name">Назва аудиторії:</label>
	<input type="text" id="name" name="name" value="<?php echo $classroom['name']; ?>" required>
	<button type="submit">Оновити</button>
</form>
<div class="list-btns">
	<a href="javascript:history.back()" class="btn">Повернутись</a>
</div>
</body>
</html>