<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

$response['status'] = 'error';
$response['message'] = 'Something went wrong!';

if (isset($_POST['Login'])) {
    $Username = $conn->real_escape_string($_POST['Username']);
    $Password = $conn->real_escape_string($_POST['Password']);

    $query = "SELECT * FROM `users` where `Username`=?";

    try {
        $result = $conn->execute_query($query, [$Username]);

        if ($result && $result->num_rows === 1) {

            $row = $result->fetch_object();

            if (password_verify($Password, $row->Password)) {

                if ($row->Activation == 1) {

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
                $response['message'] = 'Invalid Password!';
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
        $response['status'] = 'success';
        $response['message'] = 'sample returned';
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
