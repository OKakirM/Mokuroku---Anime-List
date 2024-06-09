<?php
session_start();
include('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: signUp.php");
  exit;
}

// Recuperar os dados do usuário
$stmt = $conn->prepare("SELECT email, avatar FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $avatar);
$stmt->fetch();
$stmt->close();

// Atualizar variáveis de sessão com o avatar
$_SESSION['avatar'] = $avatar;

if (isset($_GET['search'])) {
  // Escapar caracteres especiais da consulta de pesquisa
  $search = mysqli_real_escape_string($conn, $_GET['search']);

  // Consulta SQL para pesquisar por nome de usuário
  $sql = "SELECT image, anime, url, status FROM users_list WHERE anime LIKE '%$search%' OR status LIKE '%$search%' AND user_id = ". $_SESSION['id'];
  $result = $conn->query($sql);
} else {
  // Consulta SQL para selecionar todos os registros
  $sql = "SELECT image, anime, url, status FROM users_list WHERE user_id = ". $_SESSION['id'];
  $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/pages/listPage.css">
  <link rel="shortcut icon" type="image/jpg" href="./img/Logo.svg" />
  <title>Mokuroku</title>
  <script type="module" src="./js/readData.js"></script>
</head>

<body>
    <!-- *Navbar -->
    <header class="navbar">
      <nav class="navbar-items">
        <a href="./index.php">
          <div class="navbar-logo">
            <img src="./img/Logo.svg" width="50px" alt="Logo Lyst">
            <p class="c-white1 font-Bebas"><span class="c-MainColor">Moku</span>roku</p>
          </div>
        </a>
        <!-- > 769px Navbar Options  -->
        <ul class="navbar-options">
          <li class="font-Poppins c-white1"><a href="./">Home</a></li>
          <li class="font-Poppins c-MainColor"><a href="./userList.php">Anime List</a></li>
          <li class="font-Poppins c-white1"><a href="./browseAnimes.php">Browse Animes</a></li>
          
        </ul>

        <!-- < 768px Navbar Options -->
        <div class="navbar-mobile">
          <ul class="navbar-options-MB" id="optionsMobile">
            <li class="font-Poppins c-white1"><a href="./index.php">Home</a></li>
            <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
            <li class="font-Poppins c-white1"><a href="./browseAnimes.php">Browse Animes</a></li>
            
            <li><a href="#"><img src="./img/icons/x.svg" alt="exit" onclick="disableMenu()"></a></li>
          </ul>
          <ul class="navbar-menu-MB" id="menuMobile">
            <li class="c-white1"><img src="./img/icons/menu.svg" alt="menu icon" onclick="activateMenu()"></li>
          </ul>
        </div>
        <div class="navbar-UserSection">
          
          <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
          <div id="userLogged" style="">
            <div class="user-Container">
              <img src="./uploads/<?php echo $_SESSION['avatar']; ?>" alt="user avatar">
              <ul class="user-Dropdown">
                <li><a href="./logout.php" class="font-Poppins c-white1">Logout</a></li>
              </ul>
            </div>
            <img src="./img/icons/down_arrow.svg" width="32" alt="down arrow" id="downArrow" style="cursor: pointer;">
          </div>
          <?php else: ?>
          <div id="userNotLogged" style="">
            <a href="./signIn.php" class="signIn font-Poppins c-white1">Sign In</a>
            <a href="./signUp.php" class="signUp font-Poppins c-white1">Sign Up</a>
          </div>
          <?php endif; ?>
        </div>
      </nav>
    </header>
    <!-- *End Navbar -->
     <main class="list-bg">
      
      <div class="list container">
        <h1 class="font-Poppins c-white1">Anime List</h1>
        <form action="userList.php" method="get">
          <label class="font-Poppins c-white1" for="search">Search:</label>
          <input type="text" id="search" name="search">
        </form>
        <table>
            <tr>
                <th>Cover</th>
                <th>Anime</th>
                <th>Status</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output dos dados de cada linha
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><div class='img-container'><a href='./anime/".$row["url"].".php'>
                    <img src='".$row["image"]."'> </a></div>
                    </td><td><a href='./anime/".$row["url"].".php'>" . $row["anime"] . "</a></td><td><span class='".$row["status"]."'>" . $row["status"] . "</span></td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No lists saved on your profile</td></tr>";
            }
            $conn->close();
            ?>
        </table>
      </div>
     </main>
       <!-- *Footer -->
  <footer class="footer-bg">
    <div class="container footer-info">
      <div class="footer-nav">
        <a href="./"><img src="./img/Logo.svg" alt=""></a>
        <ul>
          <li class="c-white1 font-Poppins"><a href="./">Home</a></li>
          <li class="c-white1 font-Poppins"><a href="./userList.php">Anime List</a></li>
          <li class="c-white1 font-Poppins"><a href="./browseAnimes.php">Browse Animes</a></li>
        </ul>
      </div>
      <div class="footer-description">
        <h1 class="font-Poppins fw-regular">Mokuroku is an anime and manga social networking and social cataloging application website which you can create your own account to track, discover and share your favorite animes & mangas.</h1>
        <h2 class="font-Poppins fw-regular">Mokuroku is not a true company, all of the database here was created for a final project course in Tomar, Portugal.</h2>
      </div>
    </div>
  </footer>
  <!-- *End Footer -->
    
</body>
</html>
