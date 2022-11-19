<?php

require_once(__DIR__ . '/../../models/Parks.php');
require_once(__DIR__ . '/../../models/Images.php');
require_once(__DIR__ . '/../../helpers/session/SessionFlash.php');

//Récupération de l'ID du patient
// $idPark = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$idPark = intval(filter_var($id, FILTER_SANITIZE_NUMBER_INT));

//Supression du patient
$deletePark = Parks::delete($idPark);

$dirValidated = "./public/upload/imgparkValidated/$idPark";
$dirNotValidated = "./public/upload/imgpark/$idPark";

if ($deletePark) {
    SessionFlash::set('Le parc à bien été supprimé');
    if (file_exists($dirValidated)) {
        Images::delete($dirValidated);
    }
    if (file_exists($dirNotValidated)) {
        Images::delete($dirNotValidated);
    }
} else {
    SessionFlash::set('Une erreur est survenue');
};


header('location: /dashboard/liste_parcs');
exit;
