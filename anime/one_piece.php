<?php
session_start();



include('../config.php');

// Recuperar os dados do usuário
$stmt = $conn->prepare("SELECT email, avatar FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $avatar);
$stmt->fetch();
$stmt->close();
$conn->close();

// Atualizar variáveis de sessão com o avatar
$_SESSION['avatar'] = $avatar;


?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/pages/contentPage.css">
  <link rel="shortcut icon" type="image/jpg" href="../img/Logo.svg" />
  <title>Mokuroku</title>
  <script type="module" src="../js/readData.js"></script>
</head>

<body>
<?php
    if (isset($_SESSION['message'])) {
      echo "<div class='alert'><p class='font-Poppins success'>" . $_SESSION['message'] . "</p></div>";
      unset($_SESSION['message']); // Remove a mensagem após exibir
    } else if (isset($_SESSION['error'])) {
      echo "<div class='alert'><p class='font-Poppins error'>" . $_SESSION['error'] . "</p></div>";
      unset($_SESSION['error']); // Remove a mensagem após exibir
    }
    ?>
  <!-- *Navbar -->
  <header class="navbar">
    <nav class="navbar-items">
      <a href="../index.php">
        <div class="navbar-logo">
          <img src="../img/Logo.svg" width="50px" alt="Logo Lyst">
          <p class="c-white1 font-Bebas"><span class="c-MainColor">Moku</span>roku</p>
        </div>
      </a>
      <!-- > 769px Navbar Options  -->
      <ul class="navbar-options">
        <li class="font-Poppins c-white1"><a href="../index.php">Home</a></li>
        <li class="font-Poppins c-white1"><a href="../userList.php">Anime List</a></li>
        <li class="font-Poppins c-MainColor"><a href="../browseAnimes.php">Browse Animes</a></li>
        
      </ul>

      <!-- < 768px Navbar Options -->
      <div class="navbar-mobile">
        <ul class="navbar-options-MB" id="optionsMobile">
          <li class="font-Poppins c-white1"><a href="../index.php">Home</a></li>
          <li class="font-Poppins c-white1"><a href="../userList.php">Anime List</a></li>
          <li class="font-Poppins c-MainColor"><a href="../browseAnimes.php">Browse Animes</a></li>
          
          <li><a href="#"><img src="../img/icons/x.svg" alt="exit" onclick="disableMenu()"></a></li>
        </ul>
        <ul class="navbar-menu-MB" id="menuMobile">
          <li class="c-white1"><img src="../img/icons/menu.svg" alt="menu icon" onclick="activateMenu()"></li>
        </ul>
      </div>
      <div class="navbar-UserSection">
        
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <div id="userLogged" style="">
          <div class="user-Container">
            <img src="../uploads/<?php echo $_SESSION['avatar']; ?>" alt="user avatar">
            <ul class="user-Dropdown">
              <li><a href="../logout.php" class="font-Poppins c-white1">Logout</a></li>
            </ul>
          </div>
          <img src="../img/icons/down_arrow.svg" width="32" alt="down arrow" id="downArrow" style="cursor: pointer;">
        </div>
        <?php else: ?>
        <div id="userNotLogged" style="">
          <a href="../signIn.php" class="signIn font-Poppins c-white1">Sign In</a>
          <a href="../signUp.php" class="signUp font-Poppins c-white1">Sign Up</a>
        </div>
        <?php endif; ?>
      </div>
    </nav>
  </header>
  <!-- *End Navbar -->

  <!-- *Anime Content -->
  <main class="content-bg">

    <!-- !Banner -->
    <div class="content-banner">
      <img src="https://s4.anilist.co/file/anilistcdn/media/anime/banner/21-wf37VakJmZqs.jpg" alt="banner">
    </div>
    <!-- !End Banner -->

    <!-- !Anime Info -->
    <div class="content-info">

      <!-- ?Content Intro -->
      <div class="content-info-intro-bg">
        <div class="container content-info-intro">

          <div class="anime-cover">

            <div class="cover">
              <img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx21-YCDoj1EkAxFn.jpg" alt="cover">
            </div>

            <div class="cover-selection">
              <!-- *State -->
              <div class="completed">
                <div class="completed-message">
                  <a href=""><p class="font-Poppins">Set as Complete</p></a>
                </div>
                <a href="../addToList.php?status=Completed&anime=One Piece&url=one_piece&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx21-YCDoj1EkAxFn.jpg"><img src="../img/icons/done.svg" alt="completed"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="watching">
                <div class="watching-message">
                  <a href=""><p class="font-Poppins">Set as Watching</p></a>
                </div>
                <a href="../addToList.php?status=Watching&anime=One Piece&url=one_piece&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx21-YCDoj1EkAxFn.jpg"><img src="../img/icons/progress.svg" alt="watching"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="dropped">
              <div class="dropped-message">
                  <a href=""><p class="font-Poppins">Set as Dropped</p></a>
                </div>
                <a href="../addToList.php?status=Dropped&anime=One Piece&url=one_piece&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx21-YCDoj1EkAxFn.jpg"><img src="../img/icons/dislike.svg" alt="dropped"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="planning">
                <div class="planning-message">
                  <a href=""><p class="font-Poppins">Set as Planning</p></a>
                </div>
                <a href="../addToList.php?status=Planning&anime=One Piece&url=one_piece&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx21-YCDoj1EkAxFn.jpg"><img src="../img/icons/description.svg" alt="planning"></a>
              </div>
              <!-- *End State -->
            </div>
          </div>

          <div class="info">
            <h1 class="c-white1 font-Poppins">One Piece</h1>
            <p id="oneSinopse" class="c-white4 font-Poppins">
            Gold Roger was known as the Pirate King, the strongest and most infamous being to have sailed the Grand Line. The capture and death of Roger by the World Government brought a change throughout the world. His last words before his death revealed the location of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece (which promises an unlimited amount of riches and fame), and quite possibly the most coveted of titles for the person who found it, the title of the Pirate King. <br><br> Enter Monkey D. Luffy, a 17-year-old boy that defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate who ransacks villages for fun, Luffy’s reason for being a pirate is one of pure wonder; the thought of an exciting adventure and meeting new and intriguing people, along with finding One Piece, are his reasons of becoming a pirate. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach One Piece. <br><br> <span class='c-white7'>(Source: AnimeNewsNetwork)</span>
            </p>
          </div>
        </div>
      </div>
      <!-- ?End Content Intro -->

      <!-- ?Anime Stats -->
      <div class="content-info-stats-bg">
        <div class="content-info-stats container">
          <div class="details">
            <div>
              <h3 class="font-Poppins c-PurpleWhite1">Airing</h3>
              <p class="font-Poppins c-PurpleWhite3">Ep 1108</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Format</h3>
              <p class="font-Poppins c-white5">TV</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Episode Duration</h3>
              <p class="font-Poppins c-white5">24 mins</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Status</h3>
              <p class="font-Poppins c-white5">Releasing</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Start Date</h3>
              <p class="font-Poppins c-white5">Oct 20, 1999</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Season</h3>
              <p class="font-Poppins c-white5">Fall 1999</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Mean Score</h3>
              <p class="font-Poppins c-white5">88%</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Studios</h3>
              <p class="font-Poppins c-white5">Toei Animation</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Genres</h3>
              <p class="font-Poppins c-white5">Adventure</p>
              <p class="font-Poppins c-white5">Comedy</p>
              <p class="font-Poppins c-white5">Action</p>
              <p class="font-Poppins c-white5">Drama</p>
              <p class="font-Poppins c-white5">Fantasy</p>
            </div>

          </div>
          <div class="stats">
            <!-- *Characters -->
            <div>
              <h2 class="font-Poppins c-white1">Characters</h2>
              <!-- ?Stats Grid -->
              <div class="stats-grid">
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b40-fDTq7f4XyJan.png" alt="Luffy">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Luffy <br> D. Monkey</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Mayumi <br> Tanaka</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95075-1qD4TeW1ON92.png" alt="Mayumi Tanaka">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b61-YQmTA6SO0UuV.png" alt="Robin Nico">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Robin <br> Nico</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Yuriko <br> Yamaguchi</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95130-GoO41ve3YWQw.png" alt="Yuriko Yamaguchi">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b62-Wixe3kLJGVby.png" alt="Zoro Roronoa">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Zoro <br> Roronoa</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Kazuya <br> Nakai</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95123-54LrTiD9kGwY.jpg" alt="Kazuya Nakai">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/n64-ChX6ZzHHjXqA.png" alt="Franky">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Franky</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Kazuki Yao</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95131-TCVTgxb08tfE.png" alt="Kazuki Yao">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b305-OCK4jCGefFKU.png" alt="Sanji">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Sanji</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Hiroaki Hirata</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95125-NeFFiJupoDVj.png" alt="Hiroaki Hirata">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/n309-Px56UsWX35A3.jpg" alt="Chopper Tony Tony">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Chopper <br> Tony Tony</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Ikue <br> Ootani</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95128-9YWpE1d2U8Sj.png" alt="Ikue Ootani">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
              </div>
            </div>
            <!-- ?End Stats Grid -->

            <!-- *Staff -->
            <div>
              <h2 class="font-Poppins c-white1">Staff</h2>
              <!-- ?Stats Grid -->
              <div class="stats-grid">
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n96881-Cyv6wFJxpDw7.png" alt="Eiichirou Oda">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Eiichirou Oda</p>
                      <br>
                      <p class="font-Poppins c-white7">Original Creator</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n100162-DpFzStKbEy9E.png" alt="Kounosuke Uda">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Kounosuke Uda</p>
                      <br>
                      <p class="font-Poppins c-white7">Chief Director (eps 1-278)</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n103798-LdEfvPnDnoWo.png" alt="Kazuya Hisada">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Kazuya Hisada</p>
                      <br>
                      <p class="font-Poppins c-white7">Character Design (eps 385-891)</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
              </div>
            </div>

            <!-- *Trailer & News -->
            <div class="extra-info">
              <div class="trailer">
                <h2 class="font-Poppins c-white1">Trailer</h2>
                <iframe src="https://www.youtube.com/embed/J73vWi2dAt0" title="ONE PIECE Opening 26 - Us! | English / Romaji Subtitles" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              </div>
              <div class="news">
                <h2 class="font-Poppins c-white1">Last News</h2>
                <!-- ?Card -->
                <div class="news-info-card">
                  <div class="news-info-card-image-container">
                    <img src="../img/animes/one piece/banner.jpg" alt="News 1 - Lorem Ipsum">
                  </div>
                  <div class="news-info-card-content">
                    <h1 class="c-white1 font-Poppins fw-regular">NEW One Piece Live Action?!</h1>
                    <div>
                      <a href="#" class="font-Poppins c-white1">Read more <img src="../img/icons/arrow_forward.svg" alt=""></a>
                      <p class="font-Poppins" name="date"></p>
                    </div>
                  </div>
                </div>
                <!-- ?End Card -->
              </div>
            </div>
            <!-- ?End Stats Grid -->
          </div>
        </div>
      </div>
      <!-- ?End Anime Stats -->
    </div>
    <!-- !End Anime Info -->
  </main>
  <!-- *End Anime Content -->

  <!-- *Footer -->
  <footer class="footer-bg">
    <div class="container footer-info">
      <div class="footer-nav">
        <a href="../"><img src="../img/Logo.svg" alt=""></a>
        <ul>
          <li class="c-white1 font-Poppins"><a href="../">Home</a></li>
          <li class="c-white1 font-Poppins"><a href="../userList.php">Anime List</a></li>
          <li class="c-white1 font-Poppins"><a href="../browseAnimes.php">Browse Animes</a></li>
        </ul>
      </div>
      <div class="footer-description">
        <h1 class="font-Poppins fw-regular">Mokuroku is an anime and manga social networking and social cataloging application website which you can create your own account to track, discover and share your favorite animes & mangas.</h1>
        <h2 class="font-Poppins fw-regular">Mokuroku is not a true company, all of the database here was created for a final project course in Tomar, Portugal.</h2>
      </div>
    </div>
  </footer>
  <!-- *End Footer -->

  <script src="../js/navbar.js"></script>
</body>

</html>