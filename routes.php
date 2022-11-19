<?php

require_once __DIR__ . '/router.php';

try {
    // home
    get('/', '/controllers/searchParkController.php');

    // addPark
    any('/ajouter_un_parc', '/controllers/addParkController.php');

    // Connexion
    any('/connexion', '/controllers/signInController.php');

    // CreateAccount
    any('/creation_compte', '/controllers/signUpController.php');

    // Description park
    any('/review/$slug', '/controllers/reviewController.php');

    // FavoritesPark
    get('/liste_favoris', '/controllers/favoritesController.php');

    // ForgotPassword
    get('/mot_de_passe_oublie', '/controllers/forgotPasswordController.php');

    // Information account
    get('/mon_compte', '/controllers/accountInformationController.php');

    // Contact
    get('/contact', '/controllers/contactController.php');

    // ajax
    any('/getGeolocalisation', '/helpers/ajax/getGeolocalisation.php');
    any('/getDataPark', '/helpers/ajax/getDataPark.php');


    // --------------------------------------------------------------------------------------------------------------
    // If usersRole != 2 | 3  a faire dans les controllers distinct
    // Dashboard
    any('/dashboard', '/controllers/admin/dashboardController.php');

    // Park
    any('/dashboard/liste_parcs', '/controllers/admin/parksListController.php');
    any('/dashboard/review/$id', '/controllers/admin/modifyParkController.php');
    any('/dashboard/suppresion_parc/$id', '/controllers/admin/deletedParkController.php');

    // Utilisateur
    any('/dashboard/liste_utilisateurs', '/controllers/admin/usersListController.php');

    // Opinion
    any('/dashboard/liste_avis', '/controllers/admin/opinionsListController.php');

    // Ajax admin
    any('/getParksList', '/helpers/ajax/getParkList');

    // 404
    get('/404', '/controllers/404Controller.php');
} catch (PDOException $ex) {
    var_dump($ex);
}
