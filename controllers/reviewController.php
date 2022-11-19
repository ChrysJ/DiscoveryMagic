<?php
// ------------------------------------------------------------------------------------------------------
// ----------------------------------REQUIRE ONCE-----------------------------------------------
// ------------------------------------------------------------------------------------------------------

// Models
require_once __DIR__ . '/../models/Parks.php';
require_once __DIR__ . '/../models/Images.php';
require_once __DIR__ . '/../models/Opinions.php';

// Validation form
require_once __DIR__ . '/../helpers/form/formValidate.php';


// --------------------------------------------------------------------------------------------------
// ----------------------------------DATAS ------------------------------------------------------
// --------------------------------------------------------------------------------------------------
// Nettoyage de la variable créer avec la routes du router
$slugPark = trim(filter_var($slug, FILTER_SANITIZE_SPECIAL_CHARS));

// GetGeoLocalisation ( ici car besoin du slugpark )
require_once __DIR__ . '/../helpers/getGeolocalisation.php';

// Adress
$adress = $localisationInfo['features'][0]['properties']['label'] ?? '';

// id park
$idPark = Parks::readElement(null, $slugPark);
// Informations park
$park = Parks::read($idPark->id);

// Récupération des imgs caroussel
$imgsPark = Images::readAll("./public/upload/imgparkValidated/$park->idParks");


// --------------------------------------------------------------------------------------------------
// ----------------------------------FORMULAIRE----------------------------------------------
// --------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ---------------------------------------------
    // -------------------NETTOYAGE
    // ---------------------------------------------
    $titleOpinion = strip_tags($_POST['titleOpinion'] ?? '');
    $opinion = strip_tags($_POST['opinion']) ?? '';
    $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_INT);


    // ---------------------------------------------
    // -------------------VALIDATION
    // ---------------------------------------------
    $error['titleOpinion'] = formValidate::validateTitleOpinion($titleOpinion, $opinion);
    $error['opinion'] = formValidate::validateOpinion($opinion, $titleOpinion);
    $error['rate'] = formValidate::validateRate($rate);

    // Vérification des erreurs
    $errorCheck = formValidate::errorChecks($error);

    if (!$errorCheck) {
        // Création nouvelle instance opinion
    }
}

// --------------------------------------------------------------------------------------------------
// -----------------------------VARIABLE BALISE HEAD-------------------------------------
// --------------------------------------------------------------------------------------------------
// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/reviewPark.js"></script>
<script defer src="/public/assets/js/addFavoritePark.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" />
<script  src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"></script>
';

// Metadescription
$metadescription = '<meta name="descripion" content="">';

// Title
$title = "$park->name | DiscoveryMagic";


// --------------------------------------------------------------------------------------------------
// -------------------------------------INCLUDE-------------------------------------------------
// --------------------------------------------------------------------------------------------------
include __DIR__ . './../views/layout/header.php';

if (!Parks::elementExist(null, $slugPark, null)) {
    header('Location: /creation_compte');
    exit;
} else {
    include __DIR__ . './../views/park/review.php';
}
include __DIR__ . './../views/layout/listpark.php';
include __DIR__ . './../views/layout/addFavorite.php';
include __DIR__ . './../views/layout/footer.php';