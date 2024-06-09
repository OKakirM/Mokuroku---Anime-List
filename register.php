<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['name'];
    $password = $_POST['pass'];
    $avatar = $_FILES['avatar'];

    // Verificar se o email já foi cadastrado
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Este email já está cadastrado!";
        $stmt->close();
        header("Location: register.php");
        exit;
    }
    $stmt->close();

    // Verificar se o arquivo de avatar foi enviado
    if ($avatar['error'] === UPLOAD_ERR_OK) {
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_name = basename($avatar['name']);
        $avatar_dir = "uploads/";

        // Certificar-se de que o diretório de uploads existe
        if (!is_dir($avatar_dir)) {
            mkdir($avatar_dir, 0755, true);
        }

        // Caminho completo para onde o avatar será salvo
        $avatar_path = $avatar_dir . $avatar_name;

        // Mover o arquivo de avatar para o diretório de uploads
        if (move_uploaded_file($avatar_tmp_name, $avatar_path)) {

            // Preparar e executar a consulta de inserção
            $stmt = $conn->prepare("INSERT INTO users (email, username, password, avatar) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $username, $password, $avatar_name);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Registration completed successfully!";
            } else {
                $_SESSION['error'] = "Error when registering: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = "Error uploading avatar.";
        }
    } else {
        $_SESSION['error'] = "Avatar upload error: " . $avatar['error'];
    }
}
$conn->close();
header("Location: signUp.php");
exit;
?>
