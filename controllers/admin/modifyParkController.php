<?php
// ------------------------------------------------------------------------------------------------------
// ----------------------------------REQUIRE ONCE-----------------------------------------------
// ------------------------------------------------------------------------------------------------------
// Config
require_once __DIR__ . '/../../config/config.php';

// Connexion
require_once __DIR__ . '/../../helpers/database/Connexion.php';

// Models
require_once __DIR__ . '/../../models/Parks.php';
require_once __DIR__ . '/../../models/Regions.php';
require_once __DIR__ . '/../../models/Themes.php';
require_once __DIR__ . '/../../models/Images.php';

// Validation form
require_once __DIR__ . '/../../helpers/form/FormValidate.php';

// Session flash
require_once __DIR__ . '/../../helpers/session/SessionFlash.php';

// --------------------------------------------------------------------------------------------------

// --------------------------------------------------------------------------------------------------
// ----------------------------------DATAS ------------------------------------------------------
// --------------------------------------------------------------------------------------------------
// Nettoyage de la variable créer avec la routes du router
$idPark = intval(filter_var($id, FILTER_SANITIZE_NUMBER_INT));

// Regions et theme
$getRegions = Regions::readAll();
$getThemes = Themes::readAll();

// Informations park
$readPark = Parks::read($idPark);

// Img park
if ($readPark->validated_at == NULL) {
    $imgsPark = Images::readAll("./public/upload/imgpark/$readPark->id");
} else {
    $imgsPark = Images::readAll("./public/upload/imgparkValidated/$readPark->id");
}
var_dump($_GET['action'] == 'validate');

// --------------------------------------------------------------------------------------------------
// ----------------------------------FORMULAIRE----------------------------------------------
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


    // ---------------------------------------------
    // -------------------VALIDATION
    // ---------------------------------------------
    // Information park
    $error['url'] = formValidate::ValidateUrl($url);
    $error['name'] = formValidate::validatename($name);
    $error['region'] = formValidate::validateregion(Regions::idExist($region));
    $error['theme'] = formValidate::validateTheme(Themes::idExist($theme));
    $error['description'] = formValidate::validateDescription($description);

    // Géolocalisation
    $error['latitude'] = formValidate::validateGeolocalisation($latitude, $longitude);
    $error['longitude'] = formValidate::validateGeolocalisation($longitude, $latitude);


    // ---------------------------------------------
    // -------------------ERROR CHECK
    // ---------------------------------------------
    $errorCheck = formValidate::errorChecks($error);

    if (!$errorCheck) {
        // Slug lowercase
        $slug = strtolower(str_replace(' ', '', $name));

        // Validated_at
        $validated_at = new DateTime();

        // Instanciation objet avec modification et insertion en base du park
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
            $readPark->idUsers,
        );
        if ($readPark->validated_at == NULL) {
            $park->setValidated_at($validated_at->format('Y-m-d H:i'));
        } else {
            $park->setValidated_at($readPark->validated_at);
        }

        $parkIsUpdated = $park->set($readPark->id);
        // Si le nom est different alors tu rename le dossier

        if ($parkIsUpdated == false) {
            $error['add'] = 'Les modifications n\'ont pas étais pris en compte';
        } else {
            $error['add'] = 'Les modifications ont étais pris en compte';
            $readPark = Parks::read($idPark);
            if (($readPark->validated_at != NULL) && (!(file_exists("./public/upload/imgparkValidated/$readPark->id")))) {
                rename("./public/upload/imgpark/$readPark->id", "./public/upload/imgparkValidated/$readPark->id");
            }
            if ($_GET['action'] == 'validate') {
                SessionFlash::set('Le parc a bien été validé');
                header('Location: /dashboard/liste_parcs');
                exit;
            }
        }
    }
}



// -----------Variable de la balise head
// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/imgForm.js"></script>
';

// Title
$title = 'Review park | DiscoveryMagic';

// -----------Include
include __DIR__ . '/../../views/admin/layout/header.php';
// Si le slug du park existe pas redirection vers la liste
if (!Parks::elementExist($idPark, null, null)) {
    header('Location: /dashboard/liste_parcs');
    exit;
} else {
    include __DIR__ . '/../../views/admin/park/modifyPark.php';
}

include __DIR__ . '/../../views/admin/layout/footer.php';
