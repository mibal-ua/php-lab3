<?php
require_once('db-connect.php');

if (isset($_GET['id'])) {
    $lecturer_id = $_GET['id'];
    $classroom = isset($_GET['classroom_id']) ? $_GET['classroom_id'] : null;
    $query = "SELECT * FROM lecturers WHERE id = $lecturer_id";
    $result = mysqli_query($link, $query);
    $lecturer = mysqli_fetch_assoc($result);

    if (!$lecturer) {
        echo "<p class='error'>Викладача не знайдено.</p>";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $last_name = $_POST['last_name'];
        $position = $_POST['position'];
        $degree = $_POST['degree'];
        $classroom_id = $_POST['classroom_id'];

        if (empty($last_name) || empty($position) || empty($degree) || empty($classroom_id)) {
            echo "<p class='error'>Всі поля є обов'язковими!</p>";
        } else {
            $query_update = "UPDATE lecturers SET
                         last_name = '$last_name',
                         position = '$position',
                         degree = '$degree',
                         classroom_id = '$classroom_id'
                         WHERE id = $lecturer_id";
            if (mysqli_query($link, $query_update)) {
                header("Location: lecturers.php" . ($classroom ? "?classroom_id={$classroom}" : ''));
                exit();
            } else {
                echo "<p class='error'>Сталася помилка при оновленні викладача.</p>";
            }
        }
    }

    $query_classrooms = "SELECT * FROM classrooms";
    $select_classrooms = mysqli_query($link, $query_classrooms);
} else {
    echo "<p class='error'>Викладача не знайдено!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Редагувати викладача</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Редагувати викладача</h2>
<form action="edit-lecturer.php?id=<?php echo $lecturer_id; ?>" method="POST">
	<div>
		<label for="last_name">Прізвище:</label>
		<input type="text" id="last_name" name="last_name" value="<?php echo $lecturer['last_name']; ?>" required>
	</div>
	<div>
		<label for="position">Посада:</label>
		<input type="text" id="position" name="position" value="<?php echo $lecturer['position']; ?>" required>
	</div>
	<div>
		<label for="degree">Ступінь:</label>
		<input type="text" id="degree" name="degree" value="<?php echo $lecturer['degree']; ?>" required>
	</div>
	<div>
		<label for="classroom_id">Аудиторія:</label>
		<select id="classroom_id" name="classroom_id" required>
            <?php
            while ($classroom = mysqli_fetch_array($select_classrooms)) {
                $selected = ($classroom['id'] == $lecturer['classroom_id']) ? 'selected' : '';
                echo "<option value='{$classroom['id']}' $selected>{$classroom['name']}</option>";
            }
            ?>
		</select>
	</div>
	<input type="hidden" name="classroom" value="<?php echo
    (isset($_GET['classroom_id']) ? $_GET['classroom_id'] : '') ?>">
	<button type="submit">Оновити</button>
</form>
<div class="list-btns">
	<a href="javascript:history.back()" class="btn">Повернутись</a>
</div>
</body>
</html>