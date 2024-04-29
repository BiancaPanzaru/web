
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for Artworks</title>
    <link rel="stylesheet" href="./styles/searchpage.css">
</head>
<body>
<?php
    include "navbar.php";
?>

    <h1>Search for a Piece of Art</h1>

    <!-- Artwork Search Container -->
    <div id="searchContainer">
        <input type="text" id="artistName" placeholder="Enter artist's name">
        <button onclick="searchArtworks()">Search</button>
    </div>

    <!-- Artwork Display Container -->
    <div id="artworks"></div>

    <!-- "View More" Button -->
    <div id="viewMoreContainer" style="display: none; position: fixed; bottom: 10px; right: 10px;">
        <button id="viewMoreButton" onclick="viewMoreArtworks()">View More</button>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Art Gallery. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        window.onload = function() {
            const randomArtworksUrl = 'https://collectionapi.metmuseum.org/public/collection/v1/search?q=sculpture';
            fetch(randomArtworksUrl)
                .then(response => response.json())
                .then(data => {
                    const objectIDs = data.objectIDs.slice(0, 10);
                    const artworksContainer = document.getElementById('artworks');
                    artworksContainer.innerHTML = '';

                    objectIDs.forEach(objectID => {
                        const artworkUrl = `https://collectionapi.metmuseum.org/public/collection/v1/objects/${objectID}`;

                        fetch(artworkUrl)
                            .then(response => response.json())
                            .then(artworkData => {
                                const title = artworkData.title;
                                const imageUrl = artworkData.primaryImage;

                                if (imageUrl && imageUrl.startsWith('https://')) {
                                    const artist = artworkData.artistDisplayName;
                                    const creationDate = artworkData.objectDate;
                                    const idart = artworkData.objectID;

                                    const artworkElement = document.createElement('div');
                                    artworkElement.classList.add('artwork');
                                    artworkElement.innerHTML = `
                                    <a href="artdetails.php?id=${objectID}">
                            <img src="${imageUrl}" alt="${title}">
                        </a>
                        <h2>${title}</h2>
                        <p><strong>Artist:</strong> ${artist}</p>
                        <p><strong>Data creației:</strong> ${creationDate}</p>
                        <p><strong> ID: </strong> ${idart}</p>
                        <span class="favorite-heart" onclick="toggleFavorite(this, '${title}', '${artist}', '${creationDate}', '${imageUrl}', '${idart}')">&#10084;</span>
                    `;
                                    artworksContainer.appendChild(artworkElement);
                                }
                            })
                            .catch(error => {
                                console.error('A apărut o eroare:', error);
                            });
                    });
                })
                .catch(error => {
                    console.error('A apărut o eroare:', error);
                });
        };

        let currentIndex = 0; // Current index for displaying artworks

// Function to display artworks
function displayArtworks(limit) {
    const artworksContainer = document.getElementById('artworks');
    const endIndex = Math.min(currentIndex + limit, objectIDs.length);

    for (let i = currentIndex; i < endIndex; i++) {
        const objectID = objectIDs[i];
        const artworkUrl = `https://collectionapi.metmuseum.org/public/collection/v1/objects/${objectID}`;

        fetch(artworkUrl)
            .then(response => response.json())
            .then(artworkData => {
                const title = artworkData.title;
                const imageUrl = artworkData.primaryImage;
                const artist = artworkData.artistDisplayName;
                const creationDate = artworkData.objectDate;
                const idart = artworkData.objectID;

                if (imageUrl && imageUrl.startsWith('https://')) {
                    const artworkElement = document.createElement('div');
                    artworkElement.classList.add('artwork');
                    artworkElement.innerHTML = `
                        <a href="artdetails.php?id=${objectID}">
                            <img src="${imageUrl}" alt="${title}">
                        </a>
                        <h2>${title}</h2>
                        <p><strong>Artist:</strong> ${artist}</p>
                        <p><strong>Data creației:</strong> ${creationDate}</p>
                        <p><strong> ID: </strong> ${idart}</p>
                        <span class="favorite-heart" onclick="toggleFavorite(this, '${title}', '${artist}', '${creationDate}', '${imageUrl}', '${idart}')">&#10084;</span>
                    `;
                    artworksContainer.appendChild(artworkElement);

                }
            })
            .catch(error => {
                console.error('An error occurred:', error);
            });
    }

    currentIndex = endIndex; // Update current index
}

// Function to search for artworks
function searchArtworks() {
    const keyword = document.getElementById('artistName').value.trim(); // Get input text and trim whitespace
    if (keyword === '') {
        alert('Enter a keyword to search!');
        return; // Stop function if no keyword is entered
    }
    const apiUrl = `https://collectionapi.metmuseum.org/public/collection/v1/search?q=${keyword}`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            objectIDs = data.objectIDs;
            currentIndex = 0; // Reset current index
            document.getElementById('artworks').innerHTML = ''; // Clear artworks container
            displayArtworks(2); // Display first two artworks
            // If there are more artworks to display, show the "View More" button
            if (objectIDs.length > 2) {
                document.getElementById('viewMoreContainer').style.display = 'block';
            } else {
                document.getElementById('viewMoreContainer').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
}

// Function to load more artworks
function viewMoreArtworks() {
    displayArtworks(3); // Display next three artworks
    // Hide the "View More" button if all artworks have been displayed
    if (currentIndex >= objectIDs.length) {
        document.getElementById('viewMoreContainer').style.display = 'none';
    }
}

// Function to add/remove artwork to/from favorites
function toggleFavorite(heart, title, artist, creationDate, imageUrl, idart) {
    const isAdded = heart.classList.toggle('added');
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    if (isAdded) {
        favorites.push({ title, artist, creationDate, imageUrl, idart});
        localStorage.setItem('favorites', JSON.stringify(favorites));
    } else {
        favorites = favorites.filter(artwork => !(artwork.idart == idart && artwork.title === title && artwork.artist === artist && artwork.creationDate === creationDate && artwork.imageUrl === imageUrl));
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }
}
    </script>
</body>
</html>
