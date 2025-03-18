<?php
require_once('db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['classrooms'])) {
        $classrooms_to_delete = $_POST['classrooms'];
        $classrooms_ids = implode(',', $classrooms_to_delete);
        $query = "DELETE FROM classrooms WHERE id IN ($classrooms_ids)";
        if (mysqli_query($link, $query)) {
            header("Location: classrooms.php");
            exit();
        } else {
            echo "<p class='error'>Сталася помилка при видаленні аудиторій.</p>";
        }
    } else {
        echo "<p class='error'>Будь ласка, виберіть хоча б одну аудиторію для видалення.</p>";
    }
}
$query = "SELECT * FROM classrooms";
$select_classrooms = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Видалити аудиторії</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Виберіть аудиторії для видалення</h2>
<form action="delete-classroom.php" method="POST">
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Вибір</th>
		</tr>
        <?php
        if (mysqli_num_rows($select_classrooms) > 0) {
            while ($classroom = mysqli_fetch_array($select_classrooms)) {
                echo "<tr>
						<td>{$classroom['id']}</td>
    					<td>{$classroom['name']}</td>
						<td><input type='checkbox' name='classrooms[]' value='{$classroom['id']}'></td>
					</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Немає аудиторій для видалення.</td></tr>";
        }
        ?>
	</table>
	<button type="submit" class="red">Видалити</button>
</form>
<div class="list-btns">
	<a href="javascript:history.back()" class="btn">Повернутись</a>
</div>
</body>
</html>
