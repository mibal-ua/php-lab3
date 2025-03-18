<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Classrooms</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
require_once('db-connect.php');

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
$query = "SELECT * FROM classrooms ORDER BY $sort_by ASC";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
	echo "<tr>
			<th><a href='?sort_by=id'>Id</a></th>
			<th><a href='?sort_by=name'>Name</a></th>
			<th>Lecturers</th>
		</tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
		$id = $row['id'];
		echo "<td><a href='edit-classroom.php?id=$id'>" . $row['name'] . "</a></td>";
		echo "<td><a href='lecturers.php?classroom_id=$id'>" . "Lecturers</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h1>There are no classrooms yet :(</h1>";
}
?>
</body>
</html>
