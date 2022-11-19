<?php
// Config
require_once __DIR__ . '/../config/config.php';

// Helpers
require_once __DIR__ . '/../helpers/database/Connexion.php';
require_once __DIR__ . '/../helpers/form/formValidate.php';

// Models
require_once __DIR__ . '/../models/Parks.php';
require_once __DIR__ . '/../models/Regions.php';
require_once __DIR__ . '/../models/Themes.php';
require_once __DIR__ . '/../models/Users.php';
require_once __DIR__ . '/../models/Images.php';

// --------Get datas
// Des regions
$getRegions = Regions::readAll();

// Des themes
$getThemes = Themes::readAll();

// De l'utilisateur
$readUser = Users::read();

// --------------------------------------------------------------------------------------------------
// ----------------------------------FORMULAIRE------------------------------------------------
// --------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ---------------------------------------------
    // -------------------NETTOYAGE
    // ---------------------------------------------
    // Information park
    $url = trim(filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL));
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $region = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_NUMBER_INT);
    $theme = filter_input(INPUT_POST, 'theme', FILTER_SANITIZE_NUMBER_INT);
    $description = strip_tags($_POST['description']) ?? '';

    // Géolocalisation
    $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Image park
    $pictureMainView = $_FILES['pictureMainView'] ?? '';
    $picture1 = $_FILES['picture1'] ?? '';
    $picture2 = $_FILES['picture2'] ?? '';


    // ---------------------------------------------
    // -------------------VALIDATION
    // ---------------------------------------------
    // Information park
    $error['url'] = formValidate::ValidateUrl($url);
    // Si le parc existe déjà
    if (Parks::elementExist(null, null, $url)) {
        $error['url'] = 'Le parc existe déjà';
    }
    $error['name'] = formValidate::validateName($name);
    $error['region'] = formValidate::validateRegion(Regions::idExist($region));
    $error['theme'] = formValidate::validateTheme(Themes::idExist($theme));
    $error['description'] = formValidate::validateDescription($description);

    // Géolocalisation
    $error['latitude'] = formValidate::validateGeolocalisation($latitude, $longitude);
    $error['longitude'] = formValidate::validateGeolocalisation($longitude, $latitude);

    // Image park
    $error['pictureMainView'] = formValidate::ValidatePictureMainView($pictureMainView);

    if (empty($pictureMainView['tmp_name'])) {
        $error['pictureMainView'] = "Ce champ est obligatoire";
    }

    $error['picture1'] = formValidate::ValidatePicture($picture1);
    $error['picture2'] = formValidate::ValidatePicture($picture2);

    // ---------------------------------------------
    // -------------------ERROR CHECK
    // ---------------------------------------------
    $errorCheck = formValidate::errorChecks($error);

    if (!$errorCheck) {
        // Début transaction
        $pdo = Connexion::getInstance();
        $pdo->beginTransaction();

        // Slug lowercase
        $slug = strtolower(str_replace(' ', '', $name));

        // -----------------------------------------------------------------
        // Instanciation objet et insertion en base du park
        $park = new Parks(
            $name,
            $slug,
            $description,
            $url,
            $latitude,
            $longitude,
            $region,
            $theme,
            // Ajout de l'id USERS quand on saura connecté les utilisateurs
            $readUser->id
        );


        $parkIsCreated = $park->set();


        // Récupération de l'id du park instancié
        $idPark = $pdo->lastInsertId();

        // -----------------------------------------------------------------
        // Instanciation objet et insertion en base des images
        $images = new Images(
            $idPark
        );

        $imageIsCreated = $images->create();
        // -----------------------------------------------------------------

        // Images
        if ($imageIsCreated) {
            $imgsValid = [];
            array_push($imgsValid, $pictureMainView);
            if (!empty($picture1['name'])) {
                array_push($imgsValid, $picture1);
            }
            if (!empty($picture2['name'])) {
                array_push($imgsValid, $picture2);
            }
            if (!empty($imgsValid)) {
                mkdir("./public/upload/imgpark/$idPark");
                foreach ($imgsValid as $key => $imgValid) {
                    Images::moveRenameImg($imgValid, $key + 1, $park->getSlug(), $idPark);
                }
            }
        }

        // Reponse des requetes / true ou false
        if (!$parkIsCreated && !$imageIsCreated && empty($imgsValid)) {
            $eror['add'] = 'Le parc n\'a pas pus être ajouté';
            $pdo->rollback();
        } else {
            $error['add'] = 'Le parc a bien été ajouté, Merci pour votre contribution !';
            $pdo->commit();
        }
    }
}

// -----------Variable de la balise head
// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/imgForm.js"></script>
';

// Metadescription
$metadescription = '<meta name="descripion" content="Faites une demande d\'ajout de parc pour partager votre parc d\'attraction favoris.">';

// Title
$title = 'Ajoutez votre magie, faites une demande d\'ajout de parc | DiscoveryMagic';

// Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/user/addPark.php';
include __DIR__ . './../views/layout/footer.php';
