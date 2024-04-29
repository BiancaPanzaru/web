<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Artworks</title>
    <link rel="stylesheet" href="./styles/favorites.css">
</head>
<body>
<?php 
include "navbar.php";
?>

        <h1>Favorite Artworks</h1>


    <div class="container" id="artworksContainer"></div>


    <script>
        // Funcția pentru afișarea operelor de artă favorite și adăugarea funcționalității de ștergere
        window.onload = function() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    const artworksContainer = document.getElementById('artworksContainer');
    artworksContainer.innerHTML = '';

    if (favorites.length === 0) {
        artworksContainer.innerHTML = '<p>You dont have any favorite artworks.</p>';
    } else {
        favorites.forEach(artwork => {
            const artworkElement = document.createElement('div');
            artworkElement.classList.add('artwork');

            // Creează un link care trimite utilizatorul la pagina de detalii cu parametrii relevanți
            const artworkLink = document.createElement('a');
            artworkLink.href = `artdetails.php?id=${encodeURIComponent(artwork.idart)}&title=${encodeURIComponent(artwork.title)}&artist=${encodeURIComponent(artwork.artist)}&creationDate=${encodeURIComponent(artwork.creationDate)}&imageUrl=${encodeURIComponent(artwork.imageUrl)}&idart=${encodeURIComponent(artwork.idart)}`;

            // Adaugă imaginea și celelalte detalii ale operei de artă
            artworkLink.innerHTML = `
                <img src="${artwork.imageUrl}" alt="${artwork.title}">
                <h2>${artwork.title}</h2>
                <p><strong>Artist:</strong> ${artwork.artist}</p>
                <p><strong>Data creației:</strong> ${artwork.creationDate}</p>
            `;

            // Adaugă butonul de ștergere a operei de artă din favorite
            const deleteButton = document.createElement('span');
            deleteButton.classList.add('delete-heart');
            deleteButton.innerHTML = '&#10084;';
            deleteButton.onclick = function() {
                removeFavorite(artwork.title);
            };

            // Adaugă linkul și butonul de ștergere în containerul operei de artă
            artworkElement.appendChild(artworkLink);
            artworkElement.appendChild(deleteButton);

            // Adaugă containerul operei de artă în containerul principal
            artworksContainer.appendChild(artworkElement);
        });
    }
};

        // Funcția pentru eliminarea unei opere de artă din lista de favorite
        function removeFavorite(title) {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(artwork => artwork.title !== title);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            // Reîncarcăm pagina pentru a actualiza vizualizarea
            location.reload();
        }
    </script>
</body>
<footer>
        <p>&copy; 2024 Art Gallery. All rights reserved.</p>
</footer>
</html>
