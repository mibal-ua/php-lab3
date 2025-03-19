<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Пошук</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Пошук</h1>
<form method="GET" action="search.php">
	<label>Пошук за ключовим словом</label>
	<input type="text" id="keyword" name="keyword" placeholder="Введіть ключове слово">

	<label>Пошук за шаблоном</label>
	<input type="text" id="pattern" name="pattern" placeholder="Введіть шаблон (наприклад, title%)">

	<label>Пошук у діапазоні дат</label>
	<label>Від:</label>
	<input type="date" id="date_from" name="date_from">
	<label>До:</label>
	<input type="date" id="date_to" name="date_to">

	<button type="submit">Шукати</button>
</form>
<h2>Результат пошуку</h2>
<?php
require_once('db-connect.php'); // Підключення до бази даних

// Ініціалізація змінних
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
$pattern = isset($_GET['pattern']) ? $_GET['pattern'] : null;
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : null;
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : null;

//echo "<p>$keyword</p>";
//echo "<p>$pattern</p>";
//echo "<p>$date_from</p>";
//echo "<p>$date_to</p>";


// Основний SQL-запит
$query = "SELECT * FROM classrooms WHERE 1=1";

// Додавання умов до запиту
if ($keyword) {
    $query .= " AND name LIKE '%$keyword%'"; // Пошук за ключовим словом
}

if ($pattern) {
    $query .= " AND name LIKE '$pattern'"; // Пошук за шаблоном
}

if ($date_from && $date_to) {
    $query .= " AND created_at BETWEEN '$date_from' AND '$date_to'"; // Пошук у діапазоні дат
}

// Виконання запиту
$result = mysqli_query($link, $query);

// Виведення результатів
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Created at</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Нічого не знайдено.</p>";
}
?>
<div class="list-btns">
	<a href="javascript:history.back()" class="btn">Повернутись</a>
</div>
</body>
</html>
