<?php
// connexion à la base de données
include("fonction.php");
connect();

// Récupérer les données soumises 
$id = $_POST['id'];
$copies = $_POST['copies'];
$nb_partenaires = $_POST['nombrepartenaires'];
$date_debut = $_POST['début'];
$date_fin = $_POST['fin'];
$concurrence = $_POST['concurrence'];
$lois = $_POST['lois'];
$affirme = $_POST['affirmé'];
$avocat = $_POST['avocat'];

// Récupérer les partenaires
$partenaires = $_POST['partenaires'];
$nature = $_POST['nature'];
$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$contribution = $_POST['contribution'];
$partages = $_POST['partages'];

// Mettre à jour les informations
update_form($id, $copies, $nb_partenaires, $date_debut, $date_fin, $concurrence, $lois, $affirme, $avocat, $partenaires, $nature, $nom, $adresse, $contribution, $partages);

?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Confirmation de mise à jour</title>
    <link rel="stylesheet" href="update.css"> 
 </head>
 <body>

<div class="container">
    <h1>Formulaire mis à jour avec succès !</h1>
    <button onclick="window.location='selection.php'">Retour à la sélection</button>
</div>

</body>
</html>
