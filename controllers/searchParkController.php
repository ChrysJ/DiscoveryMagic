<?php
// RequireOnce
// Config
require_once __DIR__ . '/../config/config.php';
// Models
require_once __DIR__ . '/../models/Parks.php';
require_once __DIR__ . '/../models/Regions.php';
require_once __DIR__ . '/../models/Images.php';

// fermeture des ressources
$getRegions = Regions::readAll();

// -----------Variable de la balise head
// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/addFavoritePark.js"></script>
<script defer src="/public/assets/js/searchpark.js"></script>
';

// Title
$title = 'Trouvez votre futur parc d\'attraction | DiscoveryMagic';


// Metadescription
$metadescription = '<meta name="descripion" content="Sélectionnez une région de France pour définir vos futurs parcs d\'attractions à visiter, et retrouvez les parcs que vous avez récemment consultés">';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/park/search.php';
include __DIR__ . './../views/layout/listpark.php';
include __DIR__ . './../views/layout/addFavorite.php';
include __DIR__ . './../views/layout/footer.php';
