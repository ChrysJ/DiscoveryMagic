<?php
// Config
require_once __DIR__ . '/../config/regex.php';

// --------------------------
// ----------------Formulaire
// --------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ----------------Mail
    // Nettoyage
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

    // Validation
    if (empty($mail)) {
        $error['mail'] = 'Veuillez renseigné votre e-mail';
    } else {
        $isOk = filter_var($mail, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_MAIL . '/')));
        if ($isOk == false) {
            $error['mail'] = 'L\'email n\'est pas valide';
        }
    }
    // Vérifié si présent en base
}

// -----------Variable de la balise head

// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer src="/public/assets/js/form.js"></script>
';

// Metadescription
$metadescription = '<meta name="descripion" content="Accéder à votre compte DiscoveryMagic afin de pouvoir noter, ajouté des parcs d\'attractions au site et mettre vos parcs d\'attractions favoris en favoris">';

// Title
$title = 'Mot de passe oublié | DiscoveryMagic';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/user/forgotpassword.php';
include __DIR__ . './../views/layout/footer.php';
