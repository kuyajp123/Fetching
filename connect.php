<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo json_encode("connected");
} catch (PDOException $e) {
    error_log("connection failed: " . $e->getMessage());
    echo json_encode(["error" => "An error accoured please try again later."]);
}
?>