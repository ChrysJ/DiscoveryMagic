<?php
// Config
require_once __DIR__ . '/../models/Images.php';
require_once __DIR__ . '/../config/regex.php';

// Récupération img avatar

$avatars = Images::readAll('./public/assets/img/userAvatar');
// --------------------------
// ----------------Formulaire
// --------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ----------------Avatar
    // Nettoyage
    $avatar = filter_input(INPUT_POST, 'avatar', FILTER_SANITIZE_NUMBER_INT);

    // Validation
    if ($avatar < 0 || $avatar > count($avatars) - 1) {
        $error['avatar'] = 'L\'avatar n\'est pas conforme';
    } else {
        $isOk = filter_var($avatar, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_ONLY_NUMBER . '/')));
    }
    if ($isOk == false) {
        $error['avatar'] = 'L\'avatar n\'est pas conforme';
    }

    // ----------------Lastname
    // Nettoyage
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));

    // Validation
    if (empty($lastname)) {
        $error['lastname'] = 'Ce champ est obligatoire';
    } else {
        $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_NO_NUMBER . '/')));
        if ($isOk == false) {
            $error['lastname'] = 'La donnée n\'est pas conforme';
        }
    }

    // ----------------Mail
    // Nettoyage
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

    // Validation
    if (empty($mail)) {
        $error['mail'] = 'Ce champ est obligatoire';
    } else {
        $isOk = filter_var($mail, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_MAIL . '/')));
        if ($isOk == false) {
            $error['mail'] = 'L\'email n\'est pas valide';
        }
    }

    // ----------------Password
    // Nettoyage
    $password = $_POST['password'] ?? '';

    // Validation
    if (empty($password)) {
        $error['password'] = 'Ce champ est obligatoire';
    } else {
        $isOk = filter_var($password, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_PASSWORD . '/')));
        if ($isOk == false) {
            $error['password'] = 'Le mot de passe n\'est pas valide';
        }
    }
}

// -----------Variable de la balise head
// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/avatar.js"></script>
';


// Title
$title = 'Informations de votre espace | DiscoveryMagic';

// Metadescription
$metadescription = '<meta name="descripion" content="Retrouvez vos informations de votre espace DiscoveryMagic, vos informations sont modifiables.">';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/user/accountInformation.php';
include __DIR__ . './../views/layout/footer.php';
