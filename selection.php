<?php
// connexion à la base de données
include("fonction.php");
connect();

// Fonction pour récupérer tous les formulaires depuis la base de données
function getAllFormulaires() {
    
    $conn = connect(); 
    $query = "SELECT * FROM formulaires"; 
    $result = mysqli_query($conn, $query);
    
    // Vérification 
    if (!$result) {
        die("Erreur de la requête : " . mysqli_error($conn));
    }

    // Récupérer les résultats sous forme de tableau associatif
    $formulaires = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $formulaires[] = $row;
    }

    // Retourner les formulaires récupérés
    return $formulaires;
}

// Récupérer tous les formulaires
$formulaires = getAllFormulaires();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection des Formulaires</title>
    <link rel="stylesheet" type="text/css" href="style form.css">
</head>
<body>

<h1>Sélection des Formulaires</h1>
<button id="createButton" onclick="window.location='creer_form.php';">Création</button>
<form action="infoform.php" method="GET">
    <label for="formulaire_id">Sélectionnez un formulaire :</label>
    <select name="id" id="formulaire_id" required>
        <option value="">Choisir un formulaire</option>
        <?php
        // Affichage de chaque formulaire dans la liste déroulante par ID
        foreach ($formulaires as $formulaire) {
            echo '<option value="' . $formulaire['Form_Num'] . '">' . htmlspecialchars($formulaire['Form_Num']) . '</option>';
        }
        ?>
    </select>
    <button type="submit">Voir les détails</button>
</form>
<!-- bouton pour supprimer un formulaire -->
<form action="supprimer_form.php" method="POST">
    <label for="formulaire_id_delete">Sélectionnez un formulaire à supprimer :</label>
    <select name="id" id="formulaire_id_delete" required>
        <option value="">Choisir un formulaire</option>
        <?php
        foreach ($formulaires as $formulaire) {
            echo '<option value="' . $formulaire['Form_Num'] . '">' . htmlspecialchars($formulaire['Form_Num']) . '</option>';
        }
        ?>
    </select>
    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce formulaire ?');">Supprimer</button>
</form>
<!-- modifier un formulaire -->
<form action="modifier_form.php" method="GET">
    <label for="formulaire_id_edit">Sélectionnez un formulaire à modifier :</label>
    <select name="id" id="formulaire_id_edit" required>
        <option value="">Choisir un formulaire</option>
        <?php
        foreach ($formulaires as $formulaire) {
            echo '<option value="' . $formulaire['Form_Num'] . '">' . htmlspecialchars($formulaire['Form_Num']) . '</option>';
        }
        ?>
    </select>
    <button type="submit">Modifier</button>
</form>
</body>
</html>
