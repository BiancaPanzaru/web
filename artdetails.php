<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artwork Details</title>
    <link rel="stylesheet" href="./styles/details.css">
    </style>
</head>
<body>
<?php
include "navbar.php";
?>

    <div class="container" id="artworkDetails">
        <div class="details" id="artworkText"></div>
        <div class="artwork" id="artworkImage"></div>
    </div>

    <footer>
        <p>&copy; 2024 Art Gallery. All rights reserved.</p>
    </footer>

    <script>
       window.onload = function() {
            // Obține ID-ul operei de artă din parametrii URL
            const urlParams = new URLSearchParams(window.location.search);
            const artworkId = urlParams.get('id');

            const artworkUrl = `https://collectionapi.metmuseum.org/public/collection/v1/objects/${artworkId}`;

            fetch(artworkUrl)
                .then(response => response.json())
                .then(artworkData => {
                    const artworkDetailsContainer = document.getElementById('artworkText');

                    const title = artworkData.title;
                    const artist = artworkData.artistDisplayName;
                    const creationDate = artworkData.objectDate;
                    const imageUrl = artworkData.primaryImage;
                    const culture = artworkData.culture;
                    const classification = artworkData.classification;
                    const department = artworkData.department;
                    const country = artworkData.country;

                    const artworkElement = document.createElement('div');
                    artworkElement.classList.add('artwork');
                    artworkElement.innerHTML = `
                    <h2>${title}</h2>
                    <ul>
                        <li><strong>Artist:</strong> ${artist}</li>
                        <li><strong>Data creației:</strong> ${creationDate}</li>
                        <li><strong>Country of origin:</strong> ${country}</li>
                        <li><strong>Cultură:</strong> ${culture}</li>
                        <li><strong>Clasificare:</strong> ${classification}</li>
                        <li><strong>Department:</strong> ${department}</li>

                    </ul>
                    `;
                    artworkDetailsContainer.appendChild(artworkElement);

                    const artworkImageContainer = document.getElementById('artworkImage');
                    artworkImageContainer.innerHTML = `
                        <img src="${imageUrl}" alt="${title}">
                    `;
                })
                .catch(error => {
                    console.error('A apărut o eroare:', error);
                });
        };
    </script>
</body>
</html>
