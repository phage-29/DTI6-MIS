<?php
require_once "conn.php";

session_start();

// Example query
if (isset($_GET['bar1'])) {
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
}

if (isset($_GET['donut1'])) {
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
    ORDER BY count_helpdesks DESC";
}

if (isset($_GET['line1'])) {
    $year = !empty($_GET['year']) ? $_GET['year'] : date('Y');
    $query = "SELECT m.months, COUNT(h.id) AS count_helpdesks
    FROM (
            SELECT 1 AS id, 'JAN' AS months
            UNION
            SELECT 2, 'FEB'
            UNION
            SELECT 3, 'MAR'
            UNION
            SELECT 4, 'APR'
            UNION
            SELECT 5, 'MAY'
            UNION
            SELECT 6, 'JUN'
            UNION
            SELECT 7, 'JUL'
            UNION
            SELECT 8, 'AUG'
            UNION
            SELECT 9, 'SEP'
            UNION
            SELECT 10, 'OCT'
            UNION
            SELECT 11, 'NOV'
            UNION
            SELECT 12, 'DEC'
        ) m
        LEFT JOIN helpdesks h ON MONTH(h.date_requested) = m.id AND YEAR(h.date_requested) = $year
    GROUP BY
        m.months,
        m.id
    ORDER BY m.id";
}

if (isset($_GET['pie1'])) {
    $query = "SELECT u.sex, COUNT(h.id) AS count_helpdesks
    FROM users AS u
    INNER JOIN helpdesks AS h ON u.id = h.requested_by";
    if (!empty($_GET['year'])) {
        $query .= " WHERE
        YEAR(h.date_requested) = " . $_GET['year'];
    }
    $query .= " GROUP BY u.sex
    ORDER BY count_helpdesks DESC";
}

$result = mysqli_query($conn, $query);

// Fetch data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
