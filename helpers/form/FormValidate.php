<?php

require_once __DIR__ . '/../../config/regex.php';

class FormValidate
{
    // Verification des erreurs
    public static function errorChecks($error)
    {
        $errorCheck = false;
        foreach ($error as $err) {
            if ($err != NULL) {
                return $errorCheck =  true;
            }
        }
        return $errorCheck;
    }

    // ---------------------------------------------
    // -----------------Opinion
    // ---------------------------------------------
    // Validate title opinion
    public static function validateTitleOpinion($title, $opinion)
    {
        if (strlen($title) > 50) {
            return 'Votre titre est trop long';
        } else if ((empty($title)) && (!empty($opinion))) {
            return 'Associez un titre à votre avis';
        }
    }
    // validate opinion
    public static function validateOpinion($opinion, $title)
    {
        if (strlen($opinion) > 1000) {
            return 'Votre avis est trop long';
        } else if ((!empty($title)) && (empty($opinion))) {
            return 'Associez un titre à votre avis';
        }
    }

    // Validate rate
    public static function validateRate($rate)
    {
        if (empty($rate)) {
            return 'Ce champ est obligatoire';
        } else if ($rate > 5 || $rate <= 0) {
            return 'La note n\'est pas conforme';
        } else {
            if (!filter_var($rate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_ONLY_NUMBER_1_5 . '/')))) {
                return 'La note n\'est pas conforme';
            }
        }
    }

    // ---------------------------------------------
    // -----------------AddPark
    // ---------------------------------------------

    // parkName
    public static function validateName($name)
    {
        if (empty($name)) {
            return 'Ce champ est obligatoire';
        } else  if (!filter_var($name, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_NO_NUMBER . '/'))) || strlen($name) <= 5 || strlen($name) >= 100) {
            return 'Le parc n\'existe pas';
        }
    }

    // url
    public static function ValidateUrl($url)
    {
        if (empty($url)) {
            return 'Ce champ est obligatoire';
        } else if (!filter_var($url, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_URL_HTTPS . '/')))) {
            return 'L\'url n\'est pas conforme';
        }
    }

    // Region
    public static function validateRegion($idRegion)
    {
        if ($idRegion == false) {
            return 'Veuillez sélectionner la région du parc';
        }
    }

    // Theme
    public static function validateTheme($idTheme)
    {
        if ($idTheme == false) {
            return 'Veuillez sélectionner le thème du parc';
        }
    }

    // Description
    public static function validateDescription($description)
    {
        if (empty($description)) {
            return 'Ce champ est obligatoire';
        } else if (strlen($description) >= 1000) {
            return 'Votre description est trop longue';
        }
    }

    // Geolocalisation
    public static function validateGeolocalisation($coordinates, $secondCoordinates)
    {
        if (empty($coordinates)) {
            return 'Ce champ est obligatoire';
        } else {
            $isOk = filter_var($coordinates, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_COORDINATES . '/')));
            if (!$isOk) {
                return 'La coordonnée n\'est pas correcte';
            }
        }
        if ((empty($coordinates)) && (!empty($secondCoordinates))) {
            return 'Il manque une coordonnée';
        }
    }

    // PictureMainView
    public static function ValidatePictureMainView($PictureMainView)
    {

        if (!empty($PictureMainView['tmp_name'])) {
            if ($PictureMainView['error'] > 0) {
                return 'Erreur lors du transfert du fichier';
            } else {
                if (!in_array($PictureMainView['type'], AUTHORIZED_IMAGE_FORMAT)) {
                    return 'Le format du fichier n\'est pas accepté';
                }
                if ($PictureMainView['size'] > 3 * 1024 * 1024) {
                    return 'Votre image est supérieur a 3mo';
                }
            }
        }
    }

    // Picture
    public static function ValidatePicture($Picture)
    {
        if (!empty($Picture['tmp_name'])) {
            if ($Picture['error'] > 0) {
                return 'Erreur lors du transfert du fichier';
            } else {
                if (!in_array($Picture['type'], AUTHORIZED_IMAGE_FORMAT)) {
                    return 'Le format du fichier n\'est pas accepté';
                }
                if ($Picture['size'] > 3 * 1024 * 1024) {
                    return 'Votre image est supérieur a 3mo';
                }
            }
        }
    }

    // ---------------------------------------------
    // -----------------Create account User
    // ---------------------------------------------
    // Validate avatar
    public static function validateAvatar($ref_avatar, $avatars)
    {
        if ($ref_avatar < 0 || $ref_avatar > count($avatars)) {
            return 'L\'avatar n\'est pas conforme';
        } else if (!filter_var($ref_avatar, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_ONLY_NUMBER . '/')))) {
            return 'L\'avatar n\'est pas conforme';
        }
    }

    // Username
    public static function validateUsername($username)
    {
        if (empty($username)) {
            return 'Ce champ est obligatoire';
        } else if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_NO_NUMBER . '/')))) {
            return 'Votre nom d\'utilisateur doit être composé uniquement de lettres';
        } else {
            if (strlen($username) <= 3 || strlen($username) > 35) {
                return 'La longueur de votre pseudo n\'est pas bon';
            }
        }
    }

    // Mail
    public static function validateMail($mail)
    {
        if (empty($mail)) {
            return 'Ce champ est obligatoire';
        } else if (!filter_var($mail, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_MAIL . '/')))) {
            return 'L\'email n\'est pas valide';
        }
    }

    // Password
    public static function validatePassword($password)
    {
        if (empty($password)) {
            return 'Ce champ est obligatoire';
        } else if (!filter_var($password, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_PASSWORD . '/')))) {
            return 'Le mot de passe n\'est pas valide';
        }
    }

    //confirmPassword
    public static function validateConfirmPassword($confirmPassword, $password)
    {
        if (empty($confirmPassword)) {
            return 'Ce champ est obligatoire';
        } else if ($password != $confirmPassword) {
            return 'Les mots de passe ne sont pas identique';
        } else {
            if (!filter_var($confirmPassword, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_PASSWORD . '/')))) {
                return 'Le mot de passe n\'est pas valide';
            }
        }
    }
}
