<?php
include('fonction.php');
include('Formulaire.php');
// Vérification des données reçues
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $copie = $_POST['copies'];
    $nb_part = $_POST['nombrepartenaires'];
    $date_debut = $_POST['début'];
    $date_fin = $_POST['fin'];
    $concurrence = $_POST['concurrence'];
    $lois = $_POST['lois'];
    $affirmé = $_POST['affirmé'];
    $avocat = $_POST['avocat'];
    $contribution = $_POST['contribution'];
    $partages = $_POST['partages'];
    $chèques = $_POST['chèques'];

    // Récupérer les partenaires
    $partenaires = $_POST['partenaires'];
    $nature = $_POST['nature'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];

    // Appel à la fonction d'ajout
    add_form($copie, $nb_part, $date_debut, $date_fin, $contribution, $partages, $chèques, $concurrence, $lois, $affirmé, $date_debut, $avocat, $partenaires, $nature, $nom, $adresse);
}
?>
