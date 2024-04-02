
<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'swiftlink';
$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) die('Database connection failed: ' . $conn->connect_error);
$query = "CREATE DATABASE IF NOT EXISTS $database";
if (!$conn->query($query)) {
    echo "Error creating database: " . $conn->error; 
}
$conn->close();
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}


/**
 * column removed package, coverage, bill
 */
$queryCreateTable = "CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    phone VARCHAR(255),
    password VARCHAR(255),
    firstname VARCHAR(255),
    middle_initial VARCHAR(255),
    lastname VARCHAR(255),
    account_no VARCHAR(255),
    address VARCHAR(500),
    town VARCHAR(255),
    city VARCHAR(255),
    province VARCHAR(500),
    postal_code VARCHAR(255),
    valid_id VARCHAR(500),
    profile VARCHAR(255),
    role VARCHAR(255) DEFAULT 'user',
    enable2FA VARCHAR(255) DEFAULT 'true',
    status VARCHAR(255) DEFAULT 'Pending',
    verified VARCHAR(255) DEFAULT 'false',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}


// for package table
$queryCreateTable = "CREATE TABLE IF NOT EXISTS package (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package VARCHAR(255),
    price INT(11),
    category VARCHAR(255),
    status VARCHAR(255) DEFAULT 'Active',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}

//  for user packages
$queryCreateTable = "CREATE TABLE IF NOT EXISTS user_package (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_no VARCHAR(255),
    invoice VARCHAR(255),
    package VARCHAR(255),
    coverage VARCHAR(255),
    total DECIMAL(10,2),
    category VARCHAR(255) DEFAULT 'Fiber',
    period VARCHAR(255),
    due_date VARCHAR(255),
    status VARCHAR(255) DEFAULT 'Unpaid',
    process_status VARCHAR(255) DEFAULT 'Pending',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}



//  for payment_confirmation
$queryCreateTable = "CREATE TABLE IF NOT EXISTS payment_confirmation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice VARCHAR(255),
    payment_method VARCHAR(255),
    date_payment VARCHAR(255),
    image_path VARCHAR(255),
    status VARCHAR(255) DEFAULT 'Pending',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}


// for coverage table
$queryCreateTable = "CREATE TABLE IF NOT EXISTS coverage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    status VARCHAR(255) DEFAULT 'Active',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}


//  help category table

$queryCreateTable = "CREATE TABLE IF NOT EXISTS help_category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255),
    remarks VARCHAR(500),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}



//  help remarks table

$queryCreateTable = "CREATE TABLE IF NOT EXISTS help_remarks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    help VARCHAR(255),
    type VARCHAR(255),
    remarks VARCHAR(500),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}


$queryCreateTable = "CREATE TABLE IF NOT EXISTS customer_ticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_no VARCHAR(255),
    account_no VARCHAR(255),
    report VARCHAR(255),
    status VARCHAR(255) DEFAULT 'Pending',
    remark VARCHAR(500),
    document VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";



if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}


$queryCreateTable = "CREATE TABLE IF NOT EXISTS user_log_activity (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_no VARCHAR(255),
    category VARCHAR(255),
    activity VARCHAR(1000),
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";



if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}



$queryCreateTable = "CREATE TABLE IF NOT EXISTS admin_log_activity (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_no VARCHAR(255),
    category VARCHAR(255) DEFAULT 'Activity',
    remark VARCHAR(1000),
    level VARCHAR(100) DEFAULT 'Admin',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";



if (!$conn->query($queryCreateTable)) {
    die("Error creating table: " . $conn->error);
}