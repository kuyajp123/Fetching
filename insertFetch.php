<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include '../connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO user (email, name, password) values (:email, :name, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email, ':name' => $name, ':password' => $password]);

        if($stmt){
            echo json_encode("data inserted successfully");
        }else{
            echo json_encode("data inserted unsuccessful");
        }
    } catch (PDOException $e) {
        $response = [
            'status' => 'error',
            'message' => 'Error inserting data: ' . $e->getMessage()
        ];

        header("Content-type: application/json");

        echo json_encode($response);
        exit;
    }
}
?>