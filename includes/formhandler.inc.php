<?php

//security, if the user manually tries to access this page without sending a post request the file will send them back to the index page
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Checks if the JSON is valid
    if (!$data) {
        http_response_code(400);
        echo "Erro: JSON inválido.";
        exit();
    }

    // Checks if the required camps are empty
    if (empty(trim($data['username'])) || empty(trim($data['email'])) || empty(trim($data['pwd']))) {
        http_response_code(400);
        echo "Erro: Preencha todos os campos.";
        exit();
    }

    $username = $data['username'] ?? '';
    $pwd = $data['pwd'] ?? '';
    $email = $data['email'] ?? '';

    try {
        require_once "dbh.inc.php";

        //raw query
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email)";
        //prepared statement
        $stmt = $pdo->prepare($query);
        //binding the name to the var
        $stmt-> bindParam(":username",$username);
        //hashing the pwd and binding it to the name
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
        $stmt->bindParam(":pwd", $hashedPwd);
        //binding the email to the var
        $stmt-> bindParam(":email", $email);
        //adding the data to the prepared statement and executing the query
        $stmt-> execute();

        //stop the db connection and query to free resources
        $pdo = null;
        $stmt = null;

        echo "success";
        die();
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erro: " . $e->getMessage();
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Método não permitido.";
    exit();
}