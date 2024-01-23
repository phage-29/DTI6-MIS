<?php

// get connection
require_once 'conn.php';
require_once 'sendmail.php';

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

if (isset($_POST['request_helpdesk'])) {

    $requested_by = $conn->real_escape_string(isset($_POST['request_by']) ? $_POST['request_by'] : $_SESSION['id']);
    $request_type_id = $conn->real_escape_string($_POST['request_type_id']);
    $category_id = $conn->real_escape_string($_POST['category_id']);
    $sub_category_id = $conn->real_escape_string($_POST['sub_category_id']);
    $complaint = $conn->real_escape_string($_POST['complaint']);
    $datetime_preferred = $conn->real_escape_string($_POST['datetime_preferred']);
    $date_requested = $conn->real_escape_string($_POST['date_requested']);

    $Ym = date_format(date_create($date_requested), "Y-m");
    $result = $conn->query("SELECT * FROM helpdesks WHERE DATE_FORMAT(date_requested, '%Y-%m') = '$Ym'");
    $request_number = 'REQ-' . $Ym . '-' . str_pad($result->num_rows + 1, 3, '0', STR_PAD_LEFT);

    $query = "INSERT INTO helpdesks (`request_number`,`requested_by`,`date_requested`, `request_type_id`, `category_id`, `sub_category_id`, `complaint`, `datetime_preferred`) VALUES (?,?,?,?,?,?,?,?)";
    try {
        $result = $conn->execute_query($query, [$request_number, $requested_by, $date_requested, $request_type_id, $category_id, $sub_category_id, $complaint, $datetime_preferred]);

        if (isset($_FILES['files'])) {
            $fileCount = count($_FILES['files']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                $file_name = $_FILES['files']['name'][$i];
                $file_name = explode('.', $file_name);
                $file_name = md5(uniqid(rand(), true)) . '.' . end($file_name);
                $file_temp_name = $_FILES['files']['tmp_name'][$i];
                $file_size = $_FILES['files']['size'][$i];
                $file_type = $_FILES['files']['type'][$i];
                $file_error = $_FILES['files']['error'][$i];

                $fileExt = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowedExtensions = ["pdf", "doc", "docx", "txt", "jpg", "jpeg", "png", "gif"];

                if (in_array($fileExt, $allowedExtensions)) {
                    $uploadDir = "uploads/";
                    $destination = $uploadDir . $file_name;

                    if (move_uploaded_file($file_temp_name, $destination)) {
                        $query = "INSERT INTO files (reference_id, file_name, file_path, file_mime) VALUES (?, ?, ?, ?)";
                        $result = $conn->execute_query($query, [$requested_by, $file_name, $destination, $file_type]);
                    }
                }
            }
        }
        if ($_SESSION['role'] == 'Employee') {
            $query = $conn->execute_query("SELECT * FROM users WHERE id = ?", [$requested_by]);
            $row = $query->fetch_object();

            $Subject = "DTI6 MIS | " . $request_number;

            $Message = "";
            $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
            $Message .= "<hr>";
            $Message .= "<div>";
            $Message .= "<div>Dear " . $row->first_name . " " . $row->last_name . ",</div>";
            $Message .= "<br>";
            $Message .= "<div>We acknowledge and appreciate your report related to IT/ICT Issue.</div>";
            $Message .= "<br>";
            $Message .= "<br>";
            $Message .= "<div>Here are the details of your ticket:</div>";
            $Message .= "<br>";
            $Message .= "<div>Ticket Number: " . $request_number . "</div>";
            $Message .= "<div>Date Submitted: " . date_format(date_create($date_requested), "d M, Y") . "</div>";
            $Message .= "<div>Description of Issue: " . $complaint . "</div>";
            $Message .= "<br>";
            $Message .= "<br>";
            $Message .= "<div>Our support team will reach out to you with updates.</div>";
            $Message .= "<div>Thank you.</div>";
            $Message .= "<br>";
            $Message .= "<br>";
            $Message .= "<div>Best Regards,</div>";
            $Message .= "<br>";
            $Message .= "<div>DTI6 MIS Administrator</div>";
            $Message .= "<div>DTI Region VI</div>";
            $Message .= "<br>";
            $Message .= "<hr>";
            $Message .= "<div>&copy; Copyright <strong>DTI6 MIS </strong>2024. All Rights Reserved</div>";
            $Message .= "</div>";

            sendEmail($row->email, $Subject, $Message);
        }

        $response['status'] = 'success';
        $response['message'] = 'Request submit successful!';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['edit_helpdesk'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $requested_by = $conn->real_escape_string(isset($_POST['request_by']) ? $_POST['request_by'] : $_SESSION['id']);
    $request_type_id = $conn->real_escape_string($_POST['request_type_id']);
    $category_id = $conn->real_escape_string($_POST['category_id']);
    $sub_category_id = $conn->real_escape_string($_POST['sub_category_id']);
    $complaint = $conn->real_escape_string($_POST['complaint']);
    $datetime_preferred = $conn->real_escape_string($_POST['datetime_preferred']);
    $date_requested = $conn->real_escape_string($_POST['date_requested']);

    $query = "UPDATE helpdesks
    SET requested_by = ?, request_type_id = ?, category_id = ?, sub_category_id = ?, complaint = ?, datetime_preferred = ?, date_requested = ?
    WHERE id = ?";

    $result = $conn->execute_query($query, [$requested_by, $request_type_id, $category_id, $sub_category_id, $complaint, $datetime_preferred, $date_requested, $id]);
    $response['status'] = 'success';
    $response['message'] = 'Helpdesk updated successful!';
}

if (isset($_POST['delete_helpdesk'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "DELETE FROM helpdesks WHERE id = ?";

    $result = $conn->execute_query($query, [$id]);
    $response['status'] = 'success';
    $response['message'] = 'Helpdesk deleted successful!';
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
