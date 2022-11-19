<?php
$parkLocalisation = Parks::readElement(null, $slugPark);
// ----------------------------------------------------------------
// -------------------REVERSE GEOCODE ( get adress )
// ----------------------------------------------------------------
// Localisation parc
$localisation = [
    "latitude" => $parkLocalisation->latitude,
    "longitude" => $parkLocalisation->longitude
];

$url = 'https://api-adresse.data.gouv.fr/reverse/?lat=' .  $localisation["latitude"] . '&lon=' . $localisation["longitude"];
$ch = curl_init();

// Récupérer le contenu de la page
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Saisir l'URL et la transmettre à la variable.
curl_setopt($ch, CURLOPT_URL, $url);

//Désactiver la vérification du certificat puisque l'api utilise HTTPS
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//Exécutez la requête 
$result = curl_exec($ch);
$result = file_get_contents($url);

$localisationInfo = json_decode($result, true);

// Adress
$adress = $localisationInfo['features'][0]['properties']['label'] ?? '';
?>


<script>
    // ----------------------------------------------------------------
    // -------------------SCRIPT AFFICHAGE DE LA CARTE
    // ----------------------------------------------------------------
    function displayMap() {
        const parcThabor = {
            lat: <?= $localisation["latitude"] ?>,
            lgn: <?= $localisation["longitude"] ?>,
        };
        const zoomLevel = 14;

        const map = L.map("mapid").setView(
            [parcThabor.lat, parcThabor.lgn],
            zoomLevel
        );

        const mainLayer = L.tileLayer(
            "https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }
        ).addTo(map);

        const Marker = L.marker([parcThabor.lat, parcThabor.lgn])
            .addTo(map)
        // .bindPopup()
        // .openPopup();

        mainLayer.addTo(map, Marker);
    }
</script>