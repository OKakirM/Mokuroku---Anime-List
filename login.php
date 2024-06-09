<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $password = $_POST['pass'];

    // Prepara e executa a consulta para encontrar o usuário
    $stmt = $conn->prepare("SELECT id, username, password, avatar FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password, $db_avatar);
        $stmt->fetch();

        // Verifica a senha usando password_verify
        if ($password === $db_password) {
            if($username === $db_username){
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $db_username;
                $_SESSION['id'] = $id;
                $_SESSION['avatar'] = $db_avatar;
                header("location: index.php");
            } else{
                header("location: signIn.php");
                $_SESSION['error'] = "Invalid Name.";
            }
        } else {
            $_SESSION['error'] = "Invalid Password.";
            header("location: signIn.php");
        }
    } else {
        $_SESSION['error'] = "No users found with that name.";
        header("location: signIn.php");
    }
    $stmt->close();
}
$conn->close();
?>
