<?php

//require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client();

try {
    $response = $client->request('GET', 'https://api.insee.fr/entreprises/sirene/V3.11/siren/005520135', [
        'headers' => [
            'Authorization' => 'Bearer 4a2eb9f4-5a2c-33cd-bf4b-f4807765bafc',
            'Accept'        => 'application/json',
        ],
    ]);

    $data = json_decode($response->getBody(), true);

    // Affichage des données
    echo '<h1>Informations sur l\'unité légale</h1>';
    echo '<ul>';
    echo '<li><strong>SIREN:</strong> ' . $data['uniteLegale']['siren'] . '</li>';
    echo '<li><strong>Date de création:</strong> ' . $data['uniteLegale']['dateCreationUniteLegale'] . '</li>';
    echo '<li><strong>Nom de l\'unité légale:</strong> ' . $data['uniteLegale']['periodesUniteLegale'][0]['denominationUniteLegale'] . '</li>';
    echo '<li><strong>Catégorie juridique:</strong> ' . $data['uniteLegale']['periodesUniteLegale'][0]['categorieJuridiqueUniteLegale'] . '</li>';
    echo '<li><strong>Activité principale:</strong> ' . $data['uniteLegale']['periodesUniteLegale'][0]['activitePrincipaleUniteLegale'] . '</li>';
    echo '<li><strong>État administratif:</strong> ' . $data['uniteLegale']['periodesUniteLegale'][0]['etatAdministratifUniteLegale'] . '</li>';
    echo '</ul>';

    echo '<h2>Périodes de l\'unité légale</h2>';
    foreach ($data['uniteLegale']['periodesUniteLegale'] as $periode) {
        echo '<h3>Période du ' . $periode['dateDebut'] . ' au ' . ($periode['dateFin'] ?? 'présent') . '</h3>';
        echo '<ul>';
        echo '<li><strong>Nom:</strong> ' . ($periode['denominationUniteLegale'] ?? 'N/A') . '</li>';
        echo '<li><strong>Catégorie juridique:</strong> ' . ($periode['categorieJuridiqueUniteLegale'] ?? 'N/A') . '</li>';
        echo '<li><strong>Activité principale:</strong> ' . ($periode['activitePrincipaleUniteLegale'] ?? 'N/A') . '</li>';
        echo '<li><strong>État administratif:</strong> ' . ($periode['etatAdministratifUniteLegale'] ?? 'N/A') . '</li>';
        echo '</ul>';
    }

} catch (RequestException $e) {
    if ($e->hasResponse()) {
        $response = $e->getResponse();
        echo 'Error: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase();
        echo "\n" . $response->getBody()->getContents();
    } else {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
