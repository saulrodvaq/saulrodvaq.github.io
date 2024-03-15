<?php
include("templates/conexion.php");

$response = ["success" => false, "message" => "Error al iniciar sesión."];

if ($conn->connect_error) {
    $response["message"] = "Conexión fallida: " . $conn->connect_error;
} else {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            session_start();
            $_SESSION["usuario"] = $email;
            $_SESSION['id'] = $row['id'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['fullname'] = $row['fullname'];
            $token = bin2hex(random_bytes(32));

            $user_id = $row['id'];
            $expiry_date = date('Y-m-d H:i:s', strtotime('+1 day'));
            $insert_token_query = "INSERT INTO tokens (user_id, token, expiry_date) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_token_query);
            $insert_stmt->bind_param("iss", $user_id, $token, $expiry_date);
            if ($insert_stmt->execute()) {
                $userTypeText = "";
                switch ($row['role_id']) {
                    case 1:
                        $userTypeText = "administradores";
                        break;
                }
                $response = ["success" => true, "message" => "Inicio de sesión exitoso.", "token" => $token, "user_type" => $userTypeText];
            } else {
                $response["message"] = "Error al generar token de sesión.";
            }
        } else {
            $response["message"] = "Contraseña incorrecta.";
        }
    } else {
        $response["message"] = "Usuario no encontrado.";
    }
}

echo json_encode($response);
$conn->close();
?>