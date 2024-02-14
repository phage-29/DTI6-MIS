<?php

require_once realpath(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('servername', $_ENV['servername']);
define('username', $_ENV['username']);
define('password', $_ENV['password']);
define('dbname', $_ENV['dbname']);
define('website', $_ENV['website']);
define('sitekey', $_ENV['sitekey']);
define('secretkey', $_ENV['secretkey']);

$conn = new mysqli(servername, username, password, dbname);

$website = website;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$enckey = $_ENV['enckey'];