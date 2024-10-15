<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../connect.php";

$data = json_decode(file_get_contents('php://input'), true);

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $id = $data['id'];

    try {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        if($stmt){
            echo json_encode("successfully deleted");
        }
    } catch (PDOException $e) {
        $response = [
            'status' => 'error',
            'message' => "there was an error deleting data:" . $e->getMessage()
        ];

        echo json_encode($response);
    }
}
?>