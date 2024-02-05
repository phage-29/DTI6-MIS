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

if (isset($_POST['edit_helpdesk'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "SELECT h.*, hs.status, hs.color
    FROM
        helpdesks h LEFT JOIN helpdesks_statuses hs ON h.status_id = hs.id
    WHERE h.id = ?";

    $result = $conn->execute_query($query, [$id]);

    $response = $result->fetch_object();
}

if (isset($_GET['count_users'])) {
    $query = "SELECT COUNT(*) AS counts FROM users";
    if (!empty($_GET['year'])) {
        $query .= " WHERE YEAR(created_at) = " . $_GET['year'];
    }
    $result = $conn->execute_query($query);

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

if (isset($_POST['get_meetings'])) {
    $query = "SELECT m.* 
    FROM meetings m";

    $result = $conn->execute_query($query);

    while($row = $result->fetch_object()) {
        $response['title'] = $row->topic;
        $response['start'] = $row->date_schedule .'T'. $row->time_start;
        $response['end'] = $row->date_schedule .'T'. $row->time_end;
    }

    $response = $result->fetch_object();
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
