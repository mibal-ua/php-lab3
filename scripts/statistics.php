<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Статистика</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Статистика</h1>
<?php
require_once('db-connect.php');

// Запити до бази даних
$classrooms_count_query = "SELECT count(*) AS count FROM classrooms";
$lecturers_count_query = "SELECT count(*) AS count FROM lecturers";

$last_month_classrooms_count_query = "SELECT count(*) AS count FROM classrooms WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$last_month_lecturers_count_query = "SELECT count(*) AS count FROM lecturers WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

$last_classroom_created_query = "SELECT * FROM classrooms ORDER BY created_at DESC LIMIT 1";

$most_coupled_classroom_query = "
    SELECT 
        classrooms.id, classrooms.name, COUNT(lecturers.id) AS lecturers_count 
    FROM classrooms 
    LEFT JOIN lecturers ON classrooms.id = lecturers.classroom_id 
    GROUP BY classrooms.id 
    ORDER BY lecturers_count DESC 
    LIMIT 1
";

// Виконання запитів
$classrooms_count_result = mysqli_query($link, $classrooms_count_query);
$lecturers_count_result = mysqli_query($link, $lecturers_count_query);

$last_month_classrooms_result = mysqli_query($link, $last_month_classrooms_count_query);
$last_month_lecturers_result = mysqli_query($link, $last_month_lecturers_count_query);

$last_classroom_result = mysqli_query($link, $last_classroom_created_query);
$most_coupled_classroom_result = mysqli_query($link, $most_coupled_classroom_query);

// Отримання даних
$classrooms_count = mysqli_fetch_assoc($classrooms_count_result)['count'];
$lecturers_count = mysqli_fetch_assoc($lecturers_count_result)['count'];

$last_month_classrooms_count = mysqli_fetch_assoc($last_month_classrooms_result)['count'];
$last_month_lecturers_count = mysqli_fetch_assoc($last_month_lecturers_result)['count'];

$last_classroom = mysqli_fetch_assoc($last_classroom_result);
$most_coupled_classroom = mysqli_fetch_assoc($most_coupled_classroom_result);

// Виведення результатів
echo "<p>Розміщено аудиторій: " . $classrooms_count . "</p>";
echo "<p>Викладає викладачів: " . $lecturers_count . "</p>";
echo "<p>За останній місяць додано аудиторій: " . $last_month_classrooms_count . "</p>";
echo "<p>За останній місяць додано викладачів: " . $last_month_lecturers_count . "</p>";

if ($last_classroom) {
	$id = $last_classroom['id'];
    echo "<p>Остання додана аудиторія: <a href='edit-classroom.php?id=$id'>" . $last_classroom['name'] . "</a></p>";
} else {
    echo "<p>Остання аудиторія не знайдена.</p>";
}

if ($most_coupled_classroom) {
    $id = $most_coupled_classroom['id'];
    echo "<p>Аудиторія з найбільшою кількістю викладачів: <a href='edit-classroom.php?id=$id'>" . $most_coupled_classroom['name'] . "</a> (" . $most_coupled_classroom['lecturers_count'] . " викладачів)</p>";
} else {
    echo "<p>Немає аудиторій із викладачами.</p>";
}
?>
</body>
</html>
