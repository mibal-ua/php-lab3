<?php
require_once('db-connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $last_name = $_POST['last_name'];
    $position = $_POST['position'];
    $degree = $_POST['degree'];
    $classroom_id = $_POST['classroom_id'];

    $query = "INSERT INTO lecturers (
                       				last_name, position, degree, classroom_id
			   ) VALUES ('$last_name', '$position', '$degree', '$classroom_id')";
    if (mysqli_query($link, $query)) {
        header("Location: lecturers.php");
        exit();
    } else {
        echo "<p class='error'>Сталася помилка при додаванні викладача.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Додати Викладача</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Додати нового викладача:</h2>
<form action="create-lecturer.php" method="POST">
	<div>
		<label for="last_name">Прізвище:</label>
		<input type="text" id="last_name" name="last_name" required>
	</div>
	<div>
		<label for="position">Посада:</label>
		<input type="text" id="position" name="position" required>
	</div>
	<div>
		<label for="degree">Ступінь:</label>
		<input type="text" id="degree" name="degree" required>
	</div>
	<div>
		<label for="classroom_id">Виберіть аудиторію:</label>
		<select id="classroom_id" name="classroom_id" required>
			<option value="">Оберіть аудиторію:</option>
            <?php
            $query = "SELECT * FROM classrooms";
            $select_classrooms = mysqli_query($link, $query);
            if (mysqli_num_rows($select_classrooms) > 0) {
                while ($classroom = mysqli_fetch_array($select_classrooms)) {
                    echo "<option value='{$classroom['id']}'>{$classroom['name']}</option>";
                }
            } else {
                echo "<option value=''>Жодної аудиторії :(</option>";
            }
            ?> </select>
	</div>
	<button type="submit">Додати</button>
</form>
<div class="list-btns">
	<a href="javascript:history.back()" class="btn">Повернутись</a>
</div>
</body>
</html>
