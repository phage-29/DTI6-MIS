<?php
require_once "../conn.php";
session_start();

$query = "SELECT 
h.id,  
h.date_requested, 
h.request_number, 
rt.request_type, 
c.category, 
sc.sub_category,
s.status
FROM helpdesks h
LEFT JOIN request_types rt ON h.request_type_id = rt.id
LEFT JOIN categories c ON h.category_id = c.id
LEFT JOIN sub_categories sc ON h.sub_category_id = sc.id
LEFT JOIN helpdesks_statuses s ON h.status_id = s.id";
$result = $conn->execute_query($query);
$totalRecords = $result->num_rows;

$length = $_GET['length'];
$start = $_GET['start'];


if (isset($_GET['search']) && !empty($_GET['search']['value'])) {
    $search = $conn->real_escape_string($_GET['search']['value']);
    $query .= sprintf(" AND (h.date_requested LIKE '%s' OR h.request_number LIKE '%s' OR rt.request_type LIKE '%s' OR c.category LIKE '%s' OR sc.sub_category LIKE '%s' OR s.status LIKE '%s')", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%");
}

$query .= " ORDER BY h.request_number DESC LIMIT $start, $length";
$result = $conn->execute_query($query);
$response = [];
while ($row = $result->fetch_object()) {
    $response[] = [
        '<span class="text-nowrap">' . $row->date_requested . '</span>',
        '<span class="font-monospace text-nowrap">' . $row->request_number . '</span>',
        '<span class="text-nowrap">' . $row->request_type . '</span>',
        '<span class="text-nowrap">' . $row->category . '</span>',
        '<span class="text-nowrap">' . $row->sub_category . '</span>',
        '<span class="text-nowrap">' . $row->status . '</span>',
        '<div class="btn-group" role="group" aria-label="Options">
            <button onclick="return useraction(\'edit\',' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit User" class="actionbtn btn btn-primary"><i class="bi bi-pencil-square"></i></button>
            <!--<button onclick="return useraction(\'reset\',' . $row->id . ')" title="Reset Password" class="actionbtn btn btn-warning"><i class="bi bi-key"></i></button>-->
            <button onclick="return useraction(\'delete\',' . $row->id . ')" title="Delete User" class="actionbtn btn btn-danger"><i class="bi bi-trash3"></i></button>
        </div>'
    ];
}

echo json_encode([
    'draw' => $_GET['draw'],
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalRecords,
    'data' => $response,
]);
