<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

$response['status'] = 'error';
$response['message'] = 'Something went wrong!';

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $query = "SELECT * 
    FROM users 
    WHERE username = ?";

    try {
        $result = $conn->execute_query($query, [$username]);

        if ($result && $result->num_rows === 1) {

            $row = $result->fetch_object();

            if (password_verify($password, $row->password)) {

                if ($row->active == 1) {

                    $_SESSION['id'] = $row->id;

                    $response['status'] = 'success';
                    $response['message'] = 'Login successful!';
                    $response['redirect'] = 'dashboard.php';
                } else {

                    $response['status'] = 'error';
                    $response['message'] = 'Account not Activated!';
                }
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Invalid password!';
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['register'])) {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $middle_name = $conn->real_escape_string($_POST['middle_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * 
    FROM users 
    WHERE username = ?";
    $result = $conn->execute_query($query, [$username]);
    if (!$result->num_rows) {
        $query = "SELECT * FROM users WHERE email = ?";
        $result = $conn->execute_query($query, [$email]);
        if (!$result->num_rows) {
            $query = "INSERT 
            INTO users(`first_name`,`middle_name`,`last_name`,`email`,`username`,`password`) 
            VALUES(?,?,?,?,?,?)";
            $result = $conn->execute_query($query, [$first_name, $middle_name, $last_name, $email, $username, $hashed_password]);

            $_SESSION['id'] = $conn->insert_id;

            $response['status'] = 'success';
            $response['message'] = 'registered successfully!';
            $response['redirect'] = 'dashboard.php';
        } else {
            $response['status'] = 'error';
            $response['message'] = $email . ' already exist!';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = $username . ' already exist!';
    }
}

if (isset($_POST['edit_user'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $id_number = $conn->real_escape_string($_POST['id_number']);
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $middle_name = $conn->real_escape_string($_POST['middle_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $position = $conn->real_escape_string($_POST['position']);
    $division_id = $conn->real_escape_string($_POST['division_id']);
    $client_type_id = $conn->real_escape_string($_POST['client_type_id']);
    $date_birth = $conn->real_escape_string($_POST['date_birth']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $address = $conn->real_escape_string($_POST['address']);
    $role_id = $conn->real_escape_string($_POST['role_id']);
    $edit_user = $conn->real_escape_string($_POST['edit_user']);

    $query = "UPDATE users
    SET id_number = ?, first_name = ?, middle_name = ?, last_name = ?, position = ?, division_id = ?, client_type_id = ?, date_birth = ?, phone = ?, email = ?, sex = ?, address = ?, role_id = ?
    WHERE id = ?";

    $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $position, $division_id, $client_type_id, $date_birth, $phone, $email, $sex, $address, $role_id, $id]);
    $response['status'] = 'success';
    $response['message'] = 'User updated successful!';
}

if (isset($_POST['reset_pwd'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "UPDATE users 
    SET password = ?, temp_password = ?, temp_password_expiry = ?
    WHERE id = ?";

    $result = $conn->execute_query($query, [$id]);
    $response['status'] = 'success';
    $response['message'] = 'User deleted successful!';
}

if (isset($_POST['delete_user'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "DELETE FROM users WHERE id = ?";

    $result = $conn->execute_query($query, [$id]);
    $response['status'] = 'success';
    $response['message'] = 'User deleted successful!';
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
