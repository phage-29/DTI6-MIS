<?php
require_once "conn.php";

session_start();

$dbDetails = array(
    'host' => servername,
    'user' => username,
    'pass' => password,
    'db' => dbname
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
        array('db' => 'request_number', 'dt' => 0),
        array(
            'db' => 'status',
            'dt' => 1,
            'formatter' => function ($data, $row) {
                return '<p class="text-' . $row['color'] . ' text-center">' . $row['status'] . '</p>';
            }
        ),
        array('db' => 'requestor', 'dt' => 2),
        array('db' => 'request_type', 'dt' => 3),
        array('db' => 'category', 'dt' => 4),
        array('db' => 'sub_category', 'dt' => 5),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($data, $row) {
                $buttons = '<span class="text-nowrap">' .
                    ($row['status'] == 'Cancelled' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button>' : '') .
                    ($row['status'] == 'Open' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Pending' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Pre-repair' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button><button onclick="return useraction(\'print2\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-printer"></i></button>' : '') .
                    ($row['status'] == 'Unserviceable' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'cancel\', ' . $row['id'] . ')" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i></button>' : '') .
                    ($row['status'] == 'Completed' ? '<button onclick="return useraction(\'view\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-eye"></i></button><button onclick="return useraction(\'edit\', ' . $row['id'] . ')" class="btn btn-success btn-sm mx-1"><i class="bi bi-pencil-square"></i></button><button onclick="return useraction(\'csf\', ' . $row['id'] . ')" class="btn ' . ($row['is_csf'] ? 'btn-success' : 'btn-warning') . ' btn-sm mx-1"><i class="bi bi-list-check"></i></button><button onclick="return useraction(\'print\', ' . $row['id'] . ')" class="btn btn-primary btn-sm mx-1"><i class="bi bi-printer"></i></button>' : '') .
                    '</span>';
                return $buttons;
            }
        ),
        array(
            'db' => 'date_requested',
            'dt' => 7,
            function ($data, $row) {
                return '<strong>' . date_format(date_create($row['date_requested']), 'd/m/Y') . '</strong>';
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
        array(
            'db' => 'status',
            'dt' => 1,
            'formatter' => function ($data, $row) {
                return '<p class="text-' . $row['color'] . ' text-center">' . $row['status'] . '</p>';
            }
        ),
        array('db' => 'request_type', 'dt' => 2),
        array('db' => 'category', 'dt' => 3),
        array('db' => 'sub_category', 'dt' => 4),
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
        array('db' => 'is_csf', 'dt' => 7),
        array('db' => 'color', 'dt' => 8)
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
        array(
            'db' => 'active',
            'dt' => 5,
            'formatter' => function ($data, $row) {
                return $row['active'] == 1 ? '<span class="text-success">active</span>' : '<span class="text-secondary">inactive</span>';
            }
        ),
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
        array(
            'db' => 'active',
            'dt' => 5,
            'formatter' => function ($data, $row) {
                return $row['active'] == 1 ? '<span class="text-success">active</span>' : '<span class="text-secondary">inactive</span>';
            }
        ),
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
    WHERE u.role_id != '1') getusers";

    $columns = array(
        array('db' => 'id_number', 'dt' => 0),
        array('db' => 'employee', 'dt' => 1),
        array('db' => 'division', 'dt' => 2),
        array('db' => 'email', 'dt' => 3),
        array('db' => 'role', 'dt' => 4),
        array(
            'db' => 'active',
            'dt' => 5,
            'formatter' => function ($data, $row) {
                return $row['active'] == 1 ? '<span class="text-success">active</span>' : '<span class="text-secondary">inactive</span>';
            }
        ),
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

if (isset($_GET['reports1'])) {
    $table = '(SELECT
        hd.id,
        hd.request_number,
        CONCAT (u.first_name, " ", u.last_name) AS requested_by_name,
        u.email,
        d.division,
        hd.date_requested,
        rt.request_type,
        c.category,
        sc.sub_category,
        hd.complaint,
        rp.repair_type,
        hd.datetime_start,
        hd.datetime_end,
        TIMEDIFF (hd.datetime_end, hd.datetime_start) AS turnaround_time,
        CONCAT (u1.first_name, " ", u1.last_name) AS serviced_by_name,
        CONCAT (u2.first_name, " ", u2.last_name) AS approved_by_name,
        hd.diagnosis,
        hd.remarks,
        hs.status,
        hs.color,
        CASE
            WHEN csf.id IS NOT NULL THEN 1
            ELSE 0
        END AS csf_id
    FROM
        csf
        RIGHT JOIN helpdesks hd ON csf.helpdesks_id = hd.id
        LEFT JOIN users u ON hd.requested_by = u.id
        LEFT JOIN divisions d ON u.division_id = d.id
        LEFT JOIN request_types rt ON hd.request_type_id = rt.id
        LEFT JOIN categories c ON hd.category_id = c.id
        LEFT JOIN sub_categories sc ON hd.sub_category_id = sc.id
        LEFT JOIN repair_types rp ON hd.repair_type_id = rp.id
        LEFT JOIN users u1 ON hd.serviced_by = u1.id
        LEFT JOIN users u2 ON hd.approved_by = u2.id
        LEFT JOIN helpdesks_statuses hs ON hd.status_id = hs.id';
    if (!empty($_GET['from']) && !empty($_GET['to'])) {
        $from = date('Y-m-d', strtotime($conn->real_escape_string($_GET['from'])));
        $to = date('Y-m-d', strtotime($conn->real_escape_string($_GET['to'])));

        $table .= " WHERE date_requested BETWEEN '$from' AND '$to'";
    }

    if (!empty($_GET['status_id'])) {
        $statusId = $conn->real_escape_string($_GET['status_id']);

        $table .= isset($from, $to) ? " AND status_id = $statusId" : " WHERE status_id = $statusId";
    }
    $table .= ') reports';

    $columns = array(
        array('db' => 'request_number', 'dt' => 0),
        array('db' => 'requested_by_name', 'dt' => 1),
        array('db' => 'email', 'dt' => 2),
        array('db' => 'division', 'dt' => 3),
        array(
            'db' => 'date_requested',
            'dt' => 4,
            'formatter' => function ($data) {
                return date('d M, Y', strtotime($data));
            }
        ),
        array('db' => 'request_type', 'dt' => 5),
        array('db' => 'category', 'dt' => 6),
        array('db' => 'sub_category', 'dt' => 7),
        array('db' => 'complaint', 'dt' => 8),
        array('db' => 'repair_type', 'dt' => 9),
        array(
            'db' => 'datetime_start',
            'dt' => 10,
            'formatter' => function ($data) {
                return date('d M, Y H:i A', strtotime($data));
            }
        ),
        array(
            'db' => 'datetime_end',
            'dt' => 11,
            'formatter' => function ($data) {
                return date('d M, Y H:i A', strtotime($data));
            }
        ),
        array(
            'db' => 'turnaround_time',
            'dt' => 12,
            'formatter' => function ($data) {
                return date('H:i:s', strtotime($data));
            }
        ),
        array('db' => 'serviced_by_name', 'dt' => 13),
        array('db' => 'approved_by_name', 'dt' => 14),
        array('db' => 'diagnosis', 'dt' => 15),
        array('db' => 'remarks', 'dt' => 16),
        array(
            'db' => 'status',
            'dt' => 17,
            'formatter' => function ($data, $row) {
                return '<span class="text-' . $row['color'] . '">' . $data . '</span>';
            }
        ),
        array(
            'db' => 'csf_id',
            'dt' => 18,
            'formatter' => function ($data) {
                return $data == 1 ? '<span class="text-success">Submitted</span>' : '<span class="text-primary">Pending</span>';
            }
        ),
        array('db' => 'color', 'dt' => 19),
    );
}

require 'ssp.class.php';

echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);
