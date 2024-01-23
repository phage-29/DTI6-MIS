<?php
require_once "../conn.php";
session_start();

// Example query
$query = "SELECT d.division, COUNT(h.id) AS count_helpdesks
FROM
    divisions AS d
    INNER JOIN users AS u ON d.id = u.division_id
    INNER JOIN helpdesks AS h ON u.id = h.requested_by";
if (!empty($_GET['year'])) {
    $query .= " WHERE
    YEAR(h.date_requested) = " . $_GET['year'];
}
$query .= " GROUP BY
    d.division
ORDER BY count_helpdesks DESC;
";
$result = mysqli_query($conn, $query);

// Fetch data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
