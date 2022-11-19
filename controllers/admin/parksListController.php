<?php
require_once __DIR__ . '/../../models/Parks.php';
require_once __DIR__ . '/../../helpers/session/SessionFlash.php';


// All parks
// ParksValidated



// -----------Variable de la balise head
// Script
$scriptLink = '
<script defer src="/public/assets/js/admin/parkList.js"></script>
';

$title = 'Liste des parcs | DiscoveryMagic';



// -----------Include
include __DIR__ . './../../views/admin/layout/header.php';
include __DIR__ . './../../views/admin/park/list.php';
include __DIR__ . './../../views/admin/layout/footer.php';
