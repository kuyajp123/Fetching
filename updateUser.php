<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../connect.php";

// Get the input data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$email = $data['email'];
$name = $data['name'];
$password = $data['password'];

try {
    $sql = "UPDATE user SET email = :email, name = :name, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':name' => $name,
        ':password' => $password,
        ':id' => $id
    ]);

    if ($stmt) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
}
?>
