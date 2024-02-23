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

    $query = "
    SELECT
        h.id,
        h.request_number,
        h.requested_by,
        CONCAT(u1.first_name, ' ', u1.last_name) AS requested_by_name,
        h.date_requested,
        h.request_type_id,
        rt.request_type,
        h.category_id,
        c.category,
        h.sub_category_id,
        sc.sub_category,
        h.complaint,
        h.datetime_preferred,
        h.status_id,
        hs.status,
        h.property_number,
        hs.color,
        hs.color_hex,
        h.sent_id,
        hs1.status AS sent_status,
        hs1.color AS sent_color,
        hs1.color_hex AS sent_color_hex,
        h.priority_level_id,
        pl.priority_level,
        h.repair_type_id,
        rt2.repair_type,
        h.repair_class_id,
        rc.repair_class,
        h.medium_id,
        m.medium,
        h.assigned_to,
        CONCAT(u2.first_name, ' ', u2.last_name) AS assigned_to_name,
        h.approved_by,
        CONCAT(u3.first_name, ' ', u3.last_name) AS approved_by_name,
        h.serviced_by,
        CONCAT(u4.first_name, ' ', u4.last_name) AS serviced_by_name,
        h.datetime_start,
        h.datetime_end,
        h.diagnosis,
        h.remarks,
        h.created_at,
        h.updated_at,
        h.pull_out,
        h.turn_over,
        c2.id AS csf_id,
        c2.crit1,
        c2.crit2,
        c2.crit3,
        c2.crit4,
        c2.overall,
        c2.reasons,
        c2.comments,
        c2.created_at AS created_csf_at,
        c2.updated_at AS updated_csf_at
    FROM
        helpdesks AS h
        LEFT JOIN users AS u1 ON h.requested_by = u1.id
        LEFT JOIN request_types AS rt ON h.request_type_id = rt.id
        LEFT JOIN categories AS c ON h.category_id = c.id
        LEFT JOIN sub_categories AS sc ON h.sub_category_id = sc.id
        LEFT JOIN helpdesks_statuses AS hs ON h.status_id = hs.id
        LEFT JOIN helpdesks_statuses AS hs1 ON h.sent_id = hs1.id
        LEFT JOIN priority_levels AS pl ON h.priority_level_id = pl.id
        LEFT JOIN repair_types AS rt2 ON h.repair_type_id = rt2.id
        LEFT JOIN repair_classes AS rc ON h.repair_class_id = rc.id
        LEFT JOIN mediums AS m ON h.medium_id = m.id
        LEFT JOIN users AS u2 ON h.assigned_to = u2.id
        LEFT JOIN users AS u3 ON h.approved_by = u3.id
        LEFT JOIN users AS u4 ON h.serviced_by = u4.id
        LEFT JOIN csf c2 ON h.id = c2.helpdesks_id
    WHERE 
        h.id = ?
    ";
    $result = $conn->execute_query($query, [$id]);
    $response = $result->fetch_object();
}

if (isset($_GET['count_users'])) {
    $query = "SELECT COUNT(*) AS counts FROM users";
    if (!empty($_GET['year'])) {
        $query .= " WHERE YEAR(created_at) >= " . $_GET['year'];
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

    while ($row = $result->fetch_object()) {
        $response['title'] = $row->topic;
        $response['start'] = $row->date_schedule . 'T' . $row->time_start;
        $response['end'] = $row->date_schedule . 'T' . $row->time_end;
    }

    $response = $result->fetch_object();
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
