<?php
require_once 'assets/components/includes/conn.php';

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header('Location: assets/components/includes/logout.php');
        exit();
    }

    $_SESSION['last_activity'] = time();

    $query = "
        SELECT * 
        FROM users u
        LEFT JOIN divisions d ON u.division_id = d.id
        LEFT JOIN client_types ct ON u.client_type_id = ct.id
        LEFT JOIN roles r ON u.role_id = r.id
        WHERE u.id = ? AND u.active = ?
    ";

    $result = $conn->execute_query($query, [$_SESSION['id'], '1']);

    if ($result && $result->num_rows > 0) {
        $acc = $result->fetch_object();
        $_SESSION['role'] = $acc->role;
    } else {
        header('Location: assets/components/includes/logout.php');
        exit();
    }
} else {
    $public = ['login.php', 'register.php', 'quick_csf.php'];
    $cur_page = basename($_SERVER['REQUEST_URI']);
    $cur_page = explode('?', $cur_page)[0];
    if (!in_array($cur_page, $public)) {
        header('Location: assets/components/includes/logout.php');
        exit();
    }
}
