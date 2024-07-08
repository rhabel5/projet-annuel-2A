<?php

//require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client();

try {
    $response = $client->request('GET', 'https://api.insee.fr/entreprises/sirene/V3.11/siret/90863660800014', [
        'headers' => [
            'Authorization' => 'Bearer 4a2eb9f4-5a2c-33cd-bf4b-f4807765bafc',
            'Accept'        => 'application/json',
        ],
    ]);
    $data = json_decode($response->getBody(), true);
} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo 'HTTP Request failed: ' . $e->getMessage();
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display API Response</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
<div class="container mx-auto">
    <?php if (isset($data)): ?>
        <!-- Header Information -->


    <!-- Establishment Information -->
    <div class="bg-white shadow-md rounded p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Establishment Information</h2>
        <p><strong>SIREN:</strong> <?= !empty($data['etablissement']['siren']) ? htmlspecialchars($data['etablissement']['siren']) : 'Non disponible' ?></p>
        <p><strong>NIC:</strong> <?= !empty($data['etablissement']['nic']) ? htmlspecialchars($data['etablissement']['nic']) : 'Non disponible' ?></p>
        <p><strong>SIRET:</strong> <?= !empty($data['etablissement']['siret']) ? htmlspecialchars($data['etablissement']['siret']) : 'Non disponible' ?></p>
        <p><strong>Statut Diffusion:</strong> <?= !empty($data['etablissement']['statutDiffusionEtablissement']) ? htmlspecialchars($data['etablissement']['statutDiffusionEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Date de Création:</strong> <?= !empty($data['etablissement']['dateCreationEtablissement']) ? htmlspecialchars($data['etablissement']['dateCreationEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Tranche Effectifs:</strong> <?= !empty($data['etablissement']['trancheEffectifsEtablissement']) ? htmlspecialchars($data['etablissement']['trancheEffectifsEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Année Effectifs:</strong> <?= !empty($data['etablissement']['anneeEffectifsEtablissement']) ? htmlspecialchars($data['etablissement']['anneeEffectifsEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Activité Principale (Registre des Métiers):</strong> <?= !empty($data['etablissement']['activitePrincipaleRegistreMetiersEtablissement']) ? htmlspecialchars($data['etablissement']['activitePrincipaleRegistreMetiersEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Date Dernier Traitement:</strong> <?= !empty($data['etablissement']['dateDernierTraitementEtablissement']) ? htmlspecialchars($data['etablissement']['dateDernierTraitementEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Établissement Siège:</strong> <?= !empty($data['etablissement']['etablissementSiege']) ? 'Oui' : 'Non' ?></p>
        <p><strong>Nombre de Périodes:</strong> <?= !empty($data['etablissement']['nombrePeriodesEtablissement']) ? htmlspecialchars($data['etablissement']['nombrePeriodesEtablissement']) : 'Non disponible' ?></p>
    </div>

    <!-- Legal Unit Information -->
    <div class="bg-white shadow-md rounded p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Legal Unit Information</h2>
        <p><strong>Statut Diffusion:</strong> <?= !empty($data['etablissement']['uniteLegale']['statutDiffusionUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['statutDiffusionUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Unité Purgée:</strong> <?= !empty($data['etablissement']['uniteLegale']['unitePurgeeUniteLegale']) ? 'Oui' : 'Non' ?></p>
        <p><strong>Date de Création:</strong> <?= !empty($data['etablissement']['uniteLegale']['dateCreationUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['dateCreationUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Identifiant Association:</strong> <?= !empty($data['etablissement']['uniteLegale']['identifiantAssociationUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['identifiantAssociationUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Tranche Effectifs:</strong> <?= !empty($data['etablissement']['uniteLegale']['trancheEffectifsUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['trancheEffectifsUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Année Effectifs:</strong> <?= !empty($data['etablissement']['uniteLegale']['anneeEffectifsUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['anneeEffectifsUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Date Dernier Traitement:</strong> <?= !empty($data['etablissement']['uniteLegale']['dateDernierTraitementUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['dateDernierTraitementUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Catégorie Entreprise:</strong> <?= !empty($data['etablissement']['uniteLegale']['categorieEntreprise']) ? htmlspecialchars($data['etablissement']['uniteLegale']['categorieEntreprise']) : 'Non disponible' ?></p>
        <p><strong>Année Catégorie Entreprise:</strong> <?= !empty($data['etablissement']['uniteLegale']['anneeCategorieEntreprise']) ? htmlspecialchars($data['etablissement']['uniteLegale']['anneeCategorieEntreprise']) : 'Non disponible' ?></p>
        <p><strong>Sigle:</strong> <?= !empty($data['etablissement']['uniteLegale']['sigleUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['sigleUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Sexe:</strong> <?= !empty($data['etablissement']['uniteLegale']['sexeUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['sexeUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Prénom 1:</strong> <?= !empty($data['etablissement']['uniteLegale']['prenom1UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['prenom1UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Prénom 2:</strong> <?= !empty($data['etablissement']['uniteLegale']['prenom2UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['prenom2UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Prénom 3:</strong> <?= !empty($data['etablissement']['uniteLegale']['prenom3UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['prenom3UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Prénom 4:</strong> <?= !empty($data['etablissement']['uniteLegale']['prenom4UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['prenom4UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Prénom Usuel:</strong> <?= !empty($data['etablissement']['uniteLegale']['prenomUsuelUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['prenomUsuelUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Pseudonyme:</strong> <?= !empty($data['etablissement']['uniteLegale']['pseudonymeUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['pseudonymeUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>État Administratif:</strong> <?= !empty($data['etablissement']['uniteLegale']['etatAdministratifUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['etatAdministratifUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Nom:</strong> <?= !empty($data['etablissement']['uniteLegale']['nomUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['nomUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Dénomination:</strong> <?= !empty($data['etablissement']['uniteLegale']['denominationUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['denominationUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Dénomination Usuelle 1:</strong> <?= !empty($data['etablissement']['uniteLegale']['denominationUsuelle1UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['denominationUsuelle1UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Dénomination Usuelle 2:</strong> <?= !empty($data['etablissement']['uniteLegale']['denominationUsuelle2UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['denominationUsuelle2UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Dénomination Usuelle 3:</strong> <?= !empty($data['etablissement']['uniteLegale']['denominationUsuelle3UniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['denominationUsuelle3UniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Activité Principale:</strong> <?= !empty($data['etablissement']['uniteLegale']['activitePrincipaleUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['activitePrincipaleUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Catégorie Juridique:</strong> <?= !empty($data['etablissement']['uniteLegale']['categorieJuridiqueUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['categorieJuridiqueUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>NIC Siège:</strong> <?= !empty($data['etablissement']['uniteLegale']['nicSiegeUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['nicSiegeUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Nomenclature Activité Principale:</strong> <?= !empty($data['etablissement']['uniteLegale']['nomenclatureActivitePrincipaleUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['nomenclatureActivitePrincipaleUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Nom Usage:</strong> <?= !empty($data['etablissement']['uniteLegale']['nomUsageUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['nomUsageUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Économie Sociale Solidaire:</strong> <?= !empty($data['etablissement']['uniteLegale']['economieSocialeSolidaireUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['economieSocialeSolidaireUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Société Mission:</strong> <?= !empty($data['etablissement']['uniteLegale']['societeMissionUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['societeMissionUniteLegale']) : 'Non disponible' ?></p>
        <p><strong>Caractère Employeur:</strong> <?= !empty($data['etablissement']['uniteLegale']['caractereEmployeurUniteLegale']) ? htmlspecialchars($data['etablissement']['uniteLegale']['caractereEmployeurUniteLegale']) : 'Non disponible' ?></p>
    </div>

    <!-- Address Information -->
    <div class="bg-white shadow-md rounded p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Address Information</h2>
        <p><strong>Indice Répétition Dernier Numéro Voie:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['indiceRepetitionDernierNumeroVoieEtablisssement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['indiceRepetitionDernierNumeroVoieEtablisssement']) : 'Non disponible' ?></p>
        <p><strong>Complément Adresse:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['complementAdresseEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['complementAdresseEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Numéro de Voie:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['numeroVoieEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['numeroVoieEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Indice Répétition:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['indiceRepetitionEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['indiceRepetitionEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Dernier Numéro de Voie:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['dernierNumeroVoieEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['dernierNumeroVoieEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Indice Répétition Dernier Numéro Voie:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['indiceRepetitionDernierNumeroVoieEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['indiceRepetitionDernierNumeroVoieEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Type de Voie:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['typeVoieEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['typeVoieEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Libellé de Voie:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['libelleVoieEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['libelleVoieEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Postal:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['codePostalEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['codePostalEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Commune:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['libelleCommuneEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['libelleCommuneEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Commune Étranger:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['libelleCommuneEtrangerEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['libelleCommuneEtrangerEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Distribution Spéciale:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['distributionSpecialeEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['distributionSpecialeEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Commune:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['codeCommuneEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['codeCommuneEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Cedex:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['codeCedexEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['codeCedexEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Libellé Cedex:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['libelleCedexEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['libelleCedexEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Pays Étranger:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['codePaysEtrangerEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['codePaysEtrangerEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Libellé Pays Étranger:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['libellePaysEtrangerEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['libellePaysEtrangerEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Identifiant Adresse:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['identifiantAdresseEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['identifiantAdresseEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Coordonnée Lambert Abscisse:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['coordonneeLambertAbscisseEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['coordonneeLambertAbscisseEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Coordonnée Lambert Ordonnée:</strong> <?= !empty($data['etablissement']['adresseEtablissement']['coordonneeLambertOrdonneeEtablissement']) ? htmlspecialchars($data['etablissement']['adresseEtablissement']['coordonneeLambertOrdonneeEtablissement']) : 'Non disponible' ?></p>
    </div>

    <!-- Secondary Address Information -->
    <div class="bg-white shadow-md rounded p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Secondary Address Information</h2>
        <p><strong>Complément Adresse 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['complementAdresse2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['complementAdresse2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Numéro de Voie 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['numeroVoie2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['numeroVoie2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Indice Répétition 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['indiceRepetition2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['indiceRepetition2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Type de Voie 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['typeVoie2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['typeVoie2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Libellé de Voie 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['libelleVoie2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['libelleVoie2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Postal 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['codePostal2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['codePostal2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Commune 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['libelleCommune2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['libelleCommune2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Commune Étranger 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['libelleCommune2EtrangerEtablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['libelleCommune2EtrangerEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Distribution Spéciale 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['distributionSpeciale2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['distributionSpeciale2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Commune 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['codeCommune2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['codeCommune2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Cedex 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['codeCedex2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['codeCedex2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Libellé Cedex 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['libelleCedex2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['libelleCedex2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Code Pays Étranger 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['codePaysEtranger2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['codePaysEtranger2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Libellé Pays Étranger 2:</strong> <?= !empty($data['etablissement']['adresse2Etablissement']['libellePaysEtranger2Etablissement']) ? htmlspecialchars($data['etablissement']['adresse2Etablissement']['libellePaysEtranger2Etablissement']) : 'Non disponible' ?></p>
    </div>

    <!-- Periods Information -->
        <?php foreach ($data['etablissement']['periodesEtablissement'] as $periode): ?>
    <div class="bg-white shadow-md rounded p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Periods Information</h2>
        <p><strong>Date de Début:</strong> <?= !empty($periode['dateDebut']) ? htmlspecialchars($periode['dateDebut']) : 'Non disponible' ?></p>
        <p><strong>Date de Fin:</strong> <?= !empty($periode['dateFin']) ? htmlspecialchars($periode['dateFin']) : 'Non disponible' ?></p>
        <p><strong>État Administratif:</strong> <?= !empty($periode['etatAdministratifEtablissement']) ? htmlspecialchars($periode['etatAdministratifEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Changement État Administratif:</strong> <?= !empty($periode['changementEtatAdministratifEtablissement']) ? 'Oui' : 'Non' ?></p>
        <p><strong>Enseigne 1:</strong> <?= !empty($periode['enseigne1Etablissement']) ? htmlspecialchars($periode['enseigne1Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Enseigne 2:</strong> <?= !empty($periode['enseigne2Etablissement']) ? htmlspecialchars($periode['enseigne2Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Enseigne 3:</strong> <?= !empty($periode['enseigne3Etablissement']) ? htmlspecialchars($periode['enseigne3Etablissement']) : 'Non disponible' ?></p>
        <p><strong>Changement Enseigne:</strong> <?= !empty($periode['changementEnseigneEtablissement']) ? 'Oui' : 'Non' ?></p>
        <p><strong>Dénomination Usuelle:</strong> <?= !empty($periode['denominationUsuelleEtablissement']) ? htmlspecialchars($periode['denominationUsuelleEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Changement Dénomination Usuelle:</strong> <?= !empty($periode['changementDenominationUsuelleEtablissement']) ? 'Oui' : 'Non' ?></p>
        <p><strong>Activité Principale:</strong> <?= !empty($periode['activitePrincipaleEtablissement']) ? htmlspecialchars($periode['activitePrincipaleEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Nomenclature Activité Principale:</strong> <?= !empty($periode['nomenclatureActivitePrincipaleEtablissement']) ? htmlspecialchars($periode['nomenclatureActivitePrincipaleEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Caractère Employeur:</strong> <?= !empty($periode['caractereEmployeurEtablissement']) ? htmlspecialchars($periode['caractereEmployeurEtablissement']) : 'Non disponible' ?></p>
        <p><strong>Changement Caractère Employeur:</strong> <?= !empty($periode['changementCaractereEmployeurEtablissement']) ? 'Oui' : 'Non' ?></p>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">Failed to retrieve data from the API.</span>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
