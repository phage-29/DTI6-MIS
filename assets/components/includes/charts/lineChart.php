<?php
require_once "../conn.php";
session_start();

// Example query
$year = !empty($_GET['year']) ? $_GET['year'] : date('Y');
$query = "SELECT DATE_FORMAT(all_months.date, '%b') AS months, IFNULL(COUNT(helpdesks.id), 0) AS count_helpdesks
FROM (
        SELECT '" . $year . "-01-01' - INTERVAL(n -1) MONTH AS date
        FROM (
                SELECT 1 n
                UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
        UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
        UNION SELECT 8 UNION SELECT 9 UNION SELECT 10
        UNION SELECT 11 UNION SELECT 12
            ) numbers
        WHERE
            '" . $year . "-01-01' - INTERVAL(n -1) MONTH <= '" . $year . "-01-01'
    ) AS all_months
    LEFT JOIN helpdesks ON MONTH(helpdesks.date_requested) = MONTH(all_months.date)
    AND YEAR(helpdesks.date_requested) = YEAR(all_months.date)
GROUP BY
    all_months.date
ORDER BY MONTH(all_months.date)";
$result = mysqli_query($conn, $query);

// Fetch data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
