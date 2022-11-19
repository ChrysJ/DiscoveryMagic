<?php
// Require Once
// Models
require_once __DIR__ . '/../models/Users.php';
require_once __DIR__ . '/../models/Images.php';

// Helpers
require_once __DIR__ .  '/../helpers/form/formValidate.php';

// Récupération img avatar
$avatars = Images::readAll('./public/assets/img/userAvatar');


// --------------------------------------------------------------------------------------------------
// ----------------------------------FORMULAIRE------------------------------------------------
// --------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ---------------------------------------------
    // -------------------NETTOYAGE
    // ---------------------------------------------
    $ref_avatar = filter_input(INPUT_POST, 'ref_avatar', FILTER_SANITIZE_NUMBER_INT);
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS)) ?? '';
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL)) ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // ---------------------------------------------
    // -------------------VALIDATION
    // ---------------------------------------------
    $error['ref_avatar'] = formValidate::validateAvatar($ref_avatar, $avatars);
    $error['username'] = formValidate::validateUsername($username);
    $error['mail'] = formValidate::validateMail($mail);
    if (Users::elementExist(null, $mail)) {
        $error['mail'] = 'Un compte est déjà associé à l\'email';
    }

    $error['password'] = formValidate::validatePassword($password);
    $error['confirmPassword'] = formValidate::validateConfirmPassword($confirmPassword, $password);

    // ErrorCheck
    $errorCheck = formValidate::errorChecks($error);

    // Si pas d'erreur
    if (!$errorCheck) {
        // Hash du password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Role par défault
        $role = 3;

        $user = new Users(
            $username,
            $mail,
            $passwordHash,
            $ref_avatar,
            $role
        );

        $userCreated = $user->create();

        if ($userCreated == false) {
            $error['add'] = 'Vous n\'avez pas pus être inscrit';
        } else {
            $error['add'] = 'Votre inscription c\'est passé avec succés, vous allez recevoir un mail de comfirmation';
        }
    }
}

// -----------Variable de la balise head
// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/form.js"></script>
<script defer src="/public/assets/js/avatar.js"></script>
';

// Metadescription
$metadescription = '<meta name="descripion" content="Créer un compte pour avoir accès aux fonctionnalités de DiscoveryMagic, ajoutées des parcs, mettre vos parcs en favoris ainsi que donner votre avis a propos des différents parcs.">';

// Title
$title = 'Créer votre compte | DiscoveryMagic';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/user/signUp.php';
include __DIR__ . './../views/layout/footer.php';
