<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Content-type: application/json");

include "../connect.php";

try {
    $sql = "SELECT * FROM user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e) {
    $response = [
        "status" => "error",
        "message" => "error getting data: " . $e->getMessage()
    ];

    echo json_encode($response);
    exit;
}

?>