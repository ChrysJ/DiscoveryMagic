<?php
// Config


// -----------Variable de la balise head

// Script
$scriptLink = '
<script defer src="../../public/assets/js/script.js"></script>
<script src="../../public/assets/js/favoritespark.js"></script>
';

// Title
$title = 'Vos parc d\'attraction favoris | DiscoveryMagic';
$titleSection = 'Vous avez récemment consulté';

// Metadescription
$metadescription = '<meta name="descripion" content="Ajoutez vos parcs en favoris pour les retrouve plus tard.">';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/park/favorites.php';
include __DIR__ . './../views/layout/footer.php';
