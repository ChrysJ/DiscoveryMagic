<?php
// Config
require_once __DIR__ . '/../helpers/form/FormValidate.php';
require_once __DIR__ . '/../models/Users.php';


// ----------------------------------------------------------------------------------------------------
// ----------------------------------FORMULAIRE------------------------------------------------
// ----------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ---------------------------------------------
    // -------------------NETTOYAGE
    // ---------------------------------------------
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'] ?? '';

    // ---------------------------------------------
    // -------------------VALIDATION
    // ---------------------------------------------
    $error['mail'] = formValidate::validateMail($mail);
    if (!Users::elementExist(null, $mail)) {
        $error['mail'] = 'Aucun compte n\'est associé à cette email';
    }

    $error['password'] = formValidate::validatePassword($password);


    // ---------------------------------------------
    // -------------------ERROR CHECK
    // ---------------------------------------------
    $errorCheck = formValidate::errorChecks($error);


    if (!$errorCheck) {
        $user = Users::getByMail($mail);
        $password_hash = $user->password;
        $result = password_verify($password, $password_hash);

        if (!$result) {
            $errors['connexion'] = 'Les informations de connexion sont incorrect';
        }

        if (!$errors['connexion']) {
            $user->password = null;
            $_SESSION['user'] = $user;
            var_dump($_SESSION['user']);
        }
    }
}

// -----------Variable de la balise head

// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
';

// Metadescription
$metadescription = '<meta name="descripion" content="Accéder à votre compte DiscoveryMagic afin de pouvoir noter, ajouté des parcs d\'attractions au site et mettre vos parcs d\'attractions favoris en favoris">';

// Title
$title = 'Accéder a votre compte | DiscoveryMagic';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/user/signIn.php';
include __DIR__ . './../views/layout/footer.php';
