<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

if (isset($_POST['edit'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "SELECT *
    FROM
        users AS u
        LEFT JOIN roles AS r ON u.role_id = r.id
        LEFT JOIN divisions AS d ON u.division_id = d.id
    WHERE u.id = ?";

    $result = $conn->execute_query($query, [$id]);

    $response = $result->fetch_object();
}

if (isset($_POST['edit_helpdesks'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "SELECT *
    FROM
        helpdesks
    WHERE id = ?";

    $result = $conn->execute_query($query, [$id]);

    $response = $result->fetch_object();
}

if (isset($_POST['edit_helpdesks'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "SELECT *
    FROM
        helpdesks
    WHERE id = ?";

    $result = $conn->execute_query($query, [$id]);

    $response = $result->fetch_object();
}

if (isset($_GET['count_meetings'])) {
    $query = "SELECT COUNT(*) AS counts FROM meetings";
    if (!empty($_GET['year'])) {
        $query .= " WHERE YEAR(created_at) = " . $_GET['year'];
    }
    $result = $conn->execute_query($query);

    $response = $result->fetch_object();
}

if (isset($_GET['count_helpdesks'])) {
    $query = "SELECT COUNT(*) AS counts FROM helpdesks";
    if (!empty($_GET['year'])) {
        $query .= " WHERE YEAR(date_requested) = " . $_GET['year'];
    }
    $result = $conn->execute_query($query);

    $response = $result->fetch_object();
}

if (isset($_GET['count_equipment'])) {
    $query = "SELECT COUNT(*) AS counts FROM equipment";
    if (!empty($_GET['year'])) {
        $query .= " WHERE YEAR(created_at) = " . $_GET['year'];
    }
    $result = $conn->execute_query($query);

    $response = $result->fetch_object();
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
