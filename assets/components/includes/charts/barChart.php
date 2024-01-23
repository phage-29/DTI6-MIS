<?php
require_once "../conn.php";
session_start();

// Example query
$query = "SELECT c.category, COUNT(h.id) AS count_helpdesks
FROM categories AS c
    INNER JOIN helpdesks AS h ON c.id = h.category_id";
if (!empty($_GET['year'])) {
    $query .= " WHERE
        YEAR(h.date_requested) = " . $_GET['year'];
}
$query .= " GROUP BY
    c.category
ORDER BY count_helpdesks DESC";
$result = mysqli_query($conn, $query);

// Fetch data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
