<?php

function connectDb()
{
    $config = require('config.php');
    $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']}";
    try {
        $conn = new PDO($dsn, $config['db_user'], $config['db_password']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function logUser($email, $password)
{
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE email = "' . $email . '" AND password = "' .$password . '"';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getUser($id) {
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE id = :id';
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function saveUser($username, $email, $password) {
    $connexion = connectDb();
    $sql = 'INSERT INTO users(id, username, email, password) VALUES(UUID(), :username, :email, :password)';
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    return $stmt->execute();
}