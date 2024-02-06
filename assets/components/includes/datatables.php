<?php
require_once "conn.php";

session_start();

$dbDetails = array(
    'host' => $servername,
    'user' => $username,
    'pass' => $password,
    'db'   => $dbname
);

$primaryKey = 'id';

if (isset($_GET['helpdesks1'])) {
    $table = "(SELECT
        h.id,
        h.date_requested,
        h.request_number,
        rt.request_type,
        c.category,
        sc.sub_category,
        s.id as s_id,
        s.status,
        s.status_desc,
        s.color,
        CONCAT (r.first_name, ' ', r.last_name) AS requestor,
        COUNT(csf.id) AS is_csf
    FROM
        helpdesks h
        LEFT JOIN users r ON h.requested_by = r.id
        LEFT JOIN request_types rt ON h.request_type_id = rt.id
        LEFT JOIN categories c ON h.category_id = c.id
        LEFT JOIN sub_categories sc ON h.sub_category_id = sc.id
        LEFT JOIN helpdesks_statuses s ON h.status_id = s.id
        LEFT JOIN csf ON h.id = csf.helpdesks_id
    GROUP BY
        h.id) gethelpdesks";

    $columns = array(
        array('db' => 'date_requested', 'dt' => 0, function ($data, $row) {
            return '<strong>' . date_format(date_create($row['date_requested']), 'd/m/Y') . '</strong>';
        }),
        array('db' => 'request_number', 'dt' => 1),
        array('db' => 'status', 'dt' => 2),
        array('db' => 'requestor', 'dt' => 3),
        array('db' => 'request_type', 'dt' => 4),
        array('db' => 'category', 'dt' => 5),
        array('db' => 'sub_category', 'dt' => 6),
        array(
            'db' => 'id',
            'dt' => 7,
            'formatter' => function ($data, $row) {
                $buttons = '<span class="text-nowrap">' .
                    ($row['status'] == 'Cancelled' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button>' : '') .
                    ($row['status'] == 'Open' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Pending' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Pre-repair' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Unserviceable' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Completed' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'csf\', ' . $row['id'] . ')" class="btn ' . ($row['is_csf'] ? 'btn-success' : 'btn-warning') . ' btn-sm mx-1"><i class="bi bi-list-check"></i></button>' : '') .
                    '</span>';
                return $buttons;
            }
        ),
        array('db' => 's_id', 'dt' => 8),
        array('db' => 'is_csf', 'dt' => 9),
        array('db' => 'color', 'dt' => 10)
    );
}

if (isset($_GET['helpdesks4'])) {
    $table = "(SELECT
        h.id,
        h.date_requested,
        h.request_number,
        rt.request_type,
        c.category,
        sc.sub_category,
        s.id as s_id,
        s.status,
        s.status_desc,
        s.color,
        CONCAT (r.first_name, ' ', r.last_name) AS requestor,
        COUNT(csf.id) AS is_csf
    FROM
        helpdesks h
        LEFT JOIN users r ON h.requested_by = r.id
        LEFT JOIN request_types rt ON h.request_type_id = rt.id
        LEFT JOIN categories c ON h.category_id = c.id
        LEFT JOIN sub_categories sc ON h.sub_category_id = sc.id
        LEFT JOIN helpdesks_statuses s ON h.status_id = s.id
        LEFT JOIN csf ON h.id = csf.helpdesks_id
    WHERE 
        h.requested_by=" . $_SESSION['id'] . "
    GROUP BY
        h.id) gethelpdesks";

    $columns = array(
        array('db' => 'request_number', 'dt' => 0),
        array('db' => 'request_type', 'dt' => 1),
        array('db' => 'category', 'dt' => 2),
        array('db' => 'sub_category', 'dt' => 3),
        array('db' => 'status', 'dt' => 4),
        array(
            'db' => 'id',
            'dt' => 5,
            'formatter' => function ($data, $row) {
                $buttons = '<span class="text-nowrap">' .
                    ($row['status'] == 'Cancelled' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button>' : '') .
                    ($row['status'] == 'Open' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Pending' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button>' : '') .
                    ($row['status'] == 'Pre-repair' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button>' : '') .
                    ($row['status'] == 'Unserviceable' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button>' : '') .
                    ($row['status'] == 'Completed' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'csf\', ' . $row['id'] . ')" class="btn ' . ($row['is_csf'] ? 'btn-success' : 'btn-warning') . ' btn-sm mx-1"><i class="bi bi-list-check"></i></button>' : '') .
                    '</span>';
                return $buttons;
            }
        ),
        array('db' => 's_id', 'dt' => 6),
        array('db' => 'is_csf', 'dt' => 7)
    );
}

if (isset($_GET['users4'])) {
    $table = "(SELECT 
        u.id, 
        u.id_number,
        CONCAT(u.first_name, ' ', u.last_name) AS employee, 
        d.division, 
        u.email, 
        u.username, 
        r.role, 
        u.active
    FROM 
        users AS u
        LEFT JOIN roles AS r ON u.role_id = r.id
        LEFT JOIN divisions AS d ON u.division_id = d.id
    WHERE u.role_id = '4') getusers";

    $columns = array(
        array('db' => 'id_number', 'dt' => 0),
        array('db' => 'employee', 'dt' => 1),
        array('db' => 'division', 'dt' => 2),
        array('db' => 'email', 'dt' => 3),
        array('db' => 'role', 'dt' => 4),
        array('db' => 'active', 'dt' => 5),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($data, $row) {
                $buttons = '<span class="text-nowrap"><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'delete\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-trash3"></i></button></span>';
                return $buttons;
            }
        )
    );
}

if (isset($_GET['users3'])) {
    $table = "(SELECT 
        u.id, 
        u.id_number,
        CONCAT(u.first_name, ' ', u.last_name) AS employee, 
        d.division, 
        u.email, 
        u.username, 
        r.role, 
        u.active
    FROM 
        users AS u
        LEFT JOIN roles AS r ON u.role_id = r.id
        LEFT JOIN divisions AS d ON u.division_id = d.id
    WHERE u.role_id = '3') getusers";

    $columns = array(
        array('db' => 'id_number', 'dt' => 0),
        array('db' => 'employee', 'dt' => 1),
        array('db' => 'division', 'dt' => 2),
        array('db' => 'email', 'dt' => 3),
        array('db' => 'role', 'dt' => 4),
        array('db' => 'active', 'dt' => 5),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($data, $row) {
                $buttons = '<span class="text-nowrap"><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'delete\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-trash3"></i></button></span>';
                return $buttons;
            }
        )
    );
}

if (isset($_GET['users2'])) {
    $table = "(SELECT 
        u.id, 
        u.id_number,
        CONCAT(u.first_name, ' ', u.last_name) AS employee, 
        d.division, 
        u.email, 
        u.username, 
        r.role, 
        u.active
    FROM 
        users AS u
        LEFT JOIN roles AS r ON u.role_id = r.id
        LEFT JOIN divisions AS d ON u.division_id = d.id
    WHERE u.role_id = '2') getusers";

    $columns = array(
        array('db' => 'id_number', 'dt' => 0),
        array('db' => 'employee', 'dt' => 1),
        array('db' => 'division', 'dt' => 2),
        array('db' => 'email', 'dt' => 3),
        array('db' => 'role', 'dt' => 4),
        array('db' => 'active', 'dt' => 5),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($data, $row) {
                $buttons = '<span class="text-nowrap"><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'delete\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-trash3"></i></button></span>';
                return $buttons;
            }
        )
    );
}

require 'ssp.class.php';

echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);
