<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Art Gallery - Home</title>
<link rel="stylesheet" href="./styles/home.css">
</head>
<body>
<?php
    include("navbar.php")
?>
<div class="container">
    <div class="about">
        <img src="img/met.jpeg" alt="MET Museum" id="met-img" onclick="toggleImageSize('met-img')">
        <h2>About the Museum</h2>
        <p>The Metropolitan Museum of Art presents over 5,000 years of art from around the world for everyone to experience and enjoy. The Museum lives in two iconic sites in New York City—The Met Fifth Avenue and The Met Cloisters. Since its founding in 1870, The Met has always aspired to be more than a treasury of rare and beautiful objects. Every day, art comes alive in the Museum's galleries and through its exhibitions and events, revealing new ideas and unexpected connections across time and across cultures.</p>
    </div>
    <div class="about">
        <img src="img/cloisters.jpeg" alt="MET Cloisters" id="cloisters-img" onclick="toggleImageSize('cloisters-img')">
        <h2>Mission Statement</h2>
        <p>The Metropolitan Museum of Art collects, studies, conserves, and presents significant works of art across time and cultures in order to connect all people to creativity, knowledge, ideas, and one another.</p>
    </div>
</div>
<footer>
    <p>&copy; 2024 Art Gallery. All rights reserved.</p>
</footer>

<script>
    function toggleImageSize(imageId) {
        var image = document.getElementById(imageId);
        image.classList.toggle('clicked');
    }
</script>

</body>
</html>
