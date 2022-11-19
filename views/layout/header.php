<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="/public/assets/img/other/discoverymagic_favicon.png" />
    <?= $metadescription ?>
    <?= $scriptLink ?>
    <title><?= $title ?></title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <!-- Top nav -->
        <nav class="top-nav">
            <div class="nav-left">
                <a href="/">
                    <img src="/public/assets/img/other/discoverymagic_logo.svg" alt="logo DiscoveryMagic">
                </a>
            </div>
            <div class="nav-right">
                <!-- Utilisateur non connecté -->
                <a href="/connexion" class="user-not-connected user-menu-desktop">
                    <img src="/public/assets/img/icons/avatar_black.svg" alt="avatar utilisateur">
                    <span>Connectez-vous | S'inscrire</span>
                </a>
                <!-- Utilisateur connecté -->
                <div class="user-connected">
                    <img src="/public/assets/img/other/avatar.jpg" alt="avatar utilisateur">
                </div>
                <div class="menu-user-connected">
                    <ul>
                        <i class="fa-solid fa-caret-up arrow"></i>
                        <li>
                            <a href="/mon_compte">
                                <i class="fa-solid fa-user"></i>
                                <span>Compte</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span>Deconnexion</span>
                            </a>
                        </li>
                        <!-- If role 2 | 3 -->
                        <li>
                            <a href="/dashboard">
                                <i class="fa-solid fa-gears"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- --------------------------------------- -->
                <div class="burger-menu">
                    <span id="burger"></span>
                </div>
            </div>
        </nav>
        <!-- Bottom nav-->
        <nav>
            <ul class="bottom-nav">
                <li>
                    <a href="/">
                        <img src="/public/assets/img/icons/SearchPark.svg" alt="icône trouvée un parc d'attractions en France">
                        <span class="navigation-active-searchpark">trouver un parc</span>
                    </a>
                </li>
                <li>
                    <a href="/liste_favoris">
                        <img src="/public/assets/img/icons/favoritepark.svg" alt="icone mes parc d'attraction favoris">
                        <span class="navigation-active-favoritepark">mes favoris</span>
                    </a>
                </li>
                <li>
                    <a href="/ajouter_un_parc">
                        <img src="/public/assets/img/icons/addpark.svg" alt="icone faites une demade d'ajout d'un parc d'attraction">
                        <span class="navigation-active-addpark">ajouter un parc</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- NavMobile -->
    </header>
    <div class="box-nav-mobile open-nav-mobile">
        <!-- Utilisateur non connecté -->
        <!-- <a href="/connexion" class="user-not-connected">
            <img src="/public/assets/img/icons/avatar_white.svg" alt="avatar utilisateur">
            <span>Connectez-vous | S'inscrire</span>
        </a> -->
        <!-- Utilisateur connecté -->
        <div class="menu-user-connected menu-user-connected-mobile">
            <div class="user-connected">
                <img src="/public/assets/img/other/avatar.jpg" alt="avatar utilisateur">
            </div>
            <ul>
                <li>
                    <a href="/mon_compte">
                        <i class="fa-solid fa-user"></i>
                        <span>Compte</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Deconnexion</span>
                    </a>
                </li>
                <!-- If role 2 | 3 -->
                <li>
                    <a href="/dashboard">
                        <i class="fa-solid fa-gears"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- --------------------------------------- -->
        <nav class="nav-mobile">
            <ul>
                <li>
                    <img src="/public/assets/img/icons/SearchPark.svg" alt="icône trouvée un parc d'attractions en France">
                    <span class="navigation-active-searchpark">
                        <a href="/">Trouver un parc</a>
                    </span>
                </li>
                <li>
                    <img src="/public/assets/img/icons/favoritepark.svg" alt="icone mes parc d'attraction favoris">
                    <span class="navigation-active-favoritepark">
                        <a href="/liste_favoris">Mes favoris</a>
                    </span>
                </li>
                <li>
                    <img src="/public/assets/img/icons/addpark.svg" alt="icone faites une demade d'ajout d'un parc d'attraction">
                    <span class="navigation-active-addpark">
                        <a href="/ajouter_un_parc">Ajouter un parc</a>
                    </span>
                </li>
            </ul>
        </nav>
    </div>