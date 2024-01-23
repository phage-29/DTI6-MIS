<?php
 require_once "../conn.php";
session_start();

$query = "SELECT 
    u.id, 
    u.id_number, 
    u.first_name, 
    u.middle_name, 
    u.last_name, 
    d.division, 
    u.email, 
    u.username, 
    r.role, 
    u.active
FROM 
    users AS u
    LEFT JOIN roles AS r ON u.role_id = r.id
    LEFT JOIN divisions AS d ON u.division_id = d.id
WHERE u.role_id = '1'";
$result = $conn->execute_query($query);
$totalRecords = $result->num_rows;

$length = $_GET['length'];
$start = $_GET['start'];


if (isset($_GET['search']) && !empty($_GET['search']['value'])) {
    $search = $conn->real_escape_string($_GET['search']['value']);
    $query .= sprintf(" AND (u.id_number LIKE '%s' OR CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name) LIKE '%s' OR d.division LIKE '%s' OR u.email LIKE '%s' OR u.username LIKE '%s' OR r.role LIKE '%s')", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%");
}

$query .= " LIMIT $start, $length";
$result = $conn->execute_query($query);
$response = [];
while ($row = $result->fetch_object()) {
    $response[] = [
        $row->id_number,
        $row->first_name . ' ' . $row->last_name,
        $row->division,
        $row->email,
        $row->username,
        $row->role,
        $row->active ? '<strong class="text-success">Active</strong>' : '<strong class="text-secondary">Inactive</strong>',
        '<div class="btn-group" role="group" aria-label="Options">
            <button onclick="return useraction(\'edit\',' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit User" class="actionbtn btn btn-primary"><i class="bi bi-pencil-square"></i></button>
            <!--<button onclick="return useraction(\'reset\',' . $row->id . ')"  title="Reset Password" class="actionbtn btn btn-warning"><i class="bi bi-key"></i></button>-->
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
