<?php
include 'db.php'; // Include your database connection

// Calculate the start date for the last 7 days
$lastWeekStartDate = date("Y-m-d", strtotime("-1 week"));

// Query to fetch combined data from multiple tables for the last 7 days
$query = "SELECT curDate, SUM(total_count) AS entry_count
          FROM (
            SELECT curDate, COUNT(*) AS total_count FROM sagaData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM irizData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM personaData WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM s70Data WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM x50Data WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM x70Data WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
            UNION ALL
            SELECT curDate, COUNT(*) AS total_count FROM x90Data WHERE curDate >= '$lastWeekStartDate' GROUP BY curDate
          ) AS combined_data
          GROUP BY curDate
          ORDER BY curDate";

$result = $conn->query($query);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'date' => $row['curDate'],
            'entry_count' => $row['entry_count']
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
