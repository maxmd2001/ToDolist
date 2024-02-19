<?php 

include('pdo.php');


try {
    
    // create database
    $sql = "CREATE DATABASE IF NOT EXISTS `app1`";
    $conn->exec($sql);
    echo "table of accounts created successfully.<br>";
    
    $db = 'app1';
    
    $conn->query("USE $db");

    
    // create table for accounts
    $sql = "CREATE TABLE IF NOT EXISTS `aaccounts`(
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(99) UNIQUE NOT NULL,
        password VARCHAR(128) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $conn->exec($sql);
    echo "table aaccounts created successfully.<br>";

    // create table for tasks
    $sql = "CREATE TABLE IF NOT EXISTS `tasks`(
        taskId INT AUTO_INCREMENT PRIMARY KEY,
        text VARCHAR(99) NOT NULL,
        complete boolean not null default 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $conn->exec($sql);
    echo "table tasks created successfully.<br>";
    




} catch (PDOException $pe) {
    echo $pe;

}

?>