<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>navbar</title>
<link rel="stylesheet" href="./styles/home.css">
</head>
<body>
<header>
    <img src="img/logo1.jpeg" alt="MET Logo" style="width: 90px;">
    <nav>
        <a href="homepage.php">Home</a>
        <a href="searchpage.php">Gallery</a>
        <a href="favoritespage.php">Favorites</a>
        <?php
        // Verificați dacă utilizatorul este autentificat și afișați butonul "Logout" dacă este în sesiune
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
            echo '<a href="logout.php">Logout</a>';
        }
        ?>
    </nav>
</header>
</body>
</html>
