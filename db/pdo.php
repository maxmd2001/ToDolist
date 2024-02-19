<?php 

// config
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = '';
$db = '';

$conn;

try {
        // create connection
        $conn = new PDO("mysql:host=$host;", $user, $password);
        $conn->query("use app1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected to $host successfully.<br>";
    
} catch (PDOException $th) {
    
}
?>