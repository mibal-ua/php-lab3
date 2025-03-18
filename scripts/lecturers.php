<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lecturers</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
require_once('db-connect.php');

$id = $_GET['classroom_id'];

if ($id) {
    $query = "SELECT * FROM lecturers where classroom_id = $id";
} else {
    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
    $query = "SELECT * FROM lecturers ORDER BY $sort_by ASC";
}
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
		<th><a href='?sort_by=id'>Id</a></th>
		<th><a href='?sort_by=last_name'>Last name</a></th>
		<th><a href='?sort_by=position'>Position</a></th>
		<th><a href='?sort_by=degree'>Degree</a></th>
	</tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        $id = $row['id'];
        echo "<td><a href='edit-lecturer.php?id=$id'>" . $row['last_name'] . "</a></td>";
        echo "<td>" . $row['position'] . "</td>";
        echo "<td>" . $row['degree'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
	if ($id) {
		echo "<h1>This classroom is free!</h1>";
    } else {
    	echo "<h1>There are no lecturers yet at all :(</h1>";
	}
}
?>
</body>
</html>
