<?php
session_start();
include('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: signUp.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $status = $_GET['status'];
    $anime = $_GET['anime'];
    $url = $_GET['url'];
    $image = $_GET['image'];
    $id = $_SESSION['id'];
  
    $stmt = $conn->prepare("INSERT INTO users_list (user_id, anime, url, status, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id, $anime, $url, $status, $image);

    

    if ($stmt->execute()) {
      $_SESSION['message'] = "Set to " .$status. "!";
  } else {
      $_SESSION['error'] = "Error to set up: " . $stmt->error;
  }
  header("Location: ./anime/".$url.".php");

  $stmt->close();
} else {
  header("Location: ./anime/".$url.".php");
  exit;
}
?>