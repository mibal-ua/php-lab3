<?php
require_once('db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['lecturers'])) {
        $lecturers_to_delete = $_POST['lecturers'];
        $lecturers_ids = implode(',', $lecturers_to_delete);
        $query = "DELETE FROM lecturers WHERE id IN ($lecturers_ids)";
        if (mysqli_query($link, $query)) {
            header("Location: lecturers.php");
            exit();
        } else {
            echo "<p class='error'>Сталася помилка при видаленні викладачів.</p>";
        }
    } else {
        echo "<p class='error'>Будь ласка, виберіть хоча б одного викладача для видалення.</p>";
    }
}
$query = "SELECT * FROM lecturers";
$select_lecturers = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Видалити викладачів</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Виберіть викладачів для видалення</h2>
<form action="delete-lecturer.php" method="POST">
    <table>
        <tr>
            <th>Id</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Degree</th>
            <th>Вибір</th>
        </tr>
        <?php
        if (mysqli_num_rows($select_lecturers) > 0) {
            while ($lecturer = mysqli_fetch_array($select_lecturers)) {
                echo "<tr>
                        <td>{$lecturer['id']}</td>
                        <td>{$lecturer['last_name']}</td>
                        <td>{$lecturer['position']}</td>
                        <td>{$lecturer['degree']}</td>
                        <td><input type='checkbox' name='lecturers[]' value='{$lecturer['id']}'></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Немає викладачів для видалення.</td></tr>";
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
