<?php
require_once 'controller/db.php'; // Include database connection

$tableName = $_GET['table'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$saName = $_GET['sa_name']; // Get selected Sales Agent
//$prosLocation = $_GET['pros_location']; //get selected location prospect

$query = "SELECT * FROM $tableName WHERE 1"; // Start the query with a placeholder condition

if (!empty($start_date) && !empty($end_date)) {
    $query .= " AND curDate BETWEEN '$start_date' AND '$end_date'";
}

//condition query for selection Sales Agent
if (!empty($saName)) {
    $query .= " AND saName = '$saName'";
}

//condition query for selected prospect location
/*if (!empty($prosLocation)) {
    $query .= " AND prosLocation = '$prosLocation'";
}*/

$query .= " ORDER BY curDate ASC"; // Add the ORDER BY clause to sort by curDate in ascending order

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='hover:bg-gray-200'>";
        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosName"] . "</td>";
        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosNum"] . "</td>";
        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosLocation"] . "</td>";
        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["saName"] . "</td>";
        echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["curDate"] . "</td>";       
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='border px-4 py-2'>No results found.</td></tr>";
}
?>
