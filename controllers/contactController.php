<?php
// Config
require_once __DIR__ . '/../config/helpers/regex.php';

// --------------------------
// ----------------Formulaire
// --------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // ----------------Message
    // Nettoyage
    $message = strip_tags($_POST['message']) ?? '';

    //  Validation
    if (empty($message)) {
        $error['message'] = 'Ce champ est obligatoire';
    } else if (strlen($message) >= 250) {
        $error['message'] = 'Votre message est trop long';
    }
}

// -----------Variable de la balise head

// Script
$scriptLink = '
<script defer src="/public/assets/js/script.js"></script>
<script defer scr="/public/assets/js/form.js"></script>
';

// Metadescription
$metadescription = '<meta name="descripion" content="Vous avez une question, une demande, n\'hésitez pas à nous contacter.">';

// Title
$title = 'Vous avez une question ? Contactez-nous  | DiscoveryMagic';

// -----------Include
include __DIR__ . './../views/layout/header.php';
include __DIR__ . './../views/user/contact.php';
include __DIR__ . './../views/layout/footer.php';
