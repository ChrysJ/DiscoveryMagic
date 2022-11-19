<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/admin/indexAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="/public/assets/img/other/discoverymagic_favicon.png" />
    <?= $scriptLink ?>
    <title><?= $title ?></title>
</head>

<body>
    <nav class="side-nav">
        <a href="/"> <img src="/public/assets/img/other/discoverymagic_logo.svg" alt="logo discoverymagic"></a>

        <ul>
            <a href="/dashboard">
                <li><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></li>
            </a>
            <a href="/dashboard/liste_parcs">
                <li><i class="fa-solid fa-map-location-dot"></i><span>Parcs</span></li>
            </a>
            <a href="/dashboard/liste_utilisateurs">
                <li><i class="fa-solid fa-user"></i><span>Utilisateurs</span></li>
            </a>
            <a href="/dashboard/liste_avis">
                <li><i class="fa-solid fa-star"></i><span>Avis</span></li>
            </a>
        </ul>
    </nav>