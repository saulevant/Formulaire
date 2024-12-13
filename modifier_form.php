<?php
include("fonction.php");
connect();

// Fonction pour récupérer les détails du formulaire par son ID
function getFormulaireById($id) {
    $conn = connect();
    $query = "SELECT * FROM formulaires WHERE Form_Num = '$id'";
    $result = mysqli_query($conn, $query);

    // Vérification 
    if (!$result) {
        die("Erreur de la requête : " . mysqli_error($conn));
    }

    // Retourner les données du formulaire
    return mysqli_fetch_assoc($result);
}

// Récupérer l'ID du formulaire 
$form_id = $_GET['id'] ?? null;
if ($form_id) {
    // Récupérer les données du formulaire pour pré-remplir les champs
    $formulaire = getFormulaireById($form_id);
} else {
    die("Aucun formulaire sélectionné.");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Formulaire</title>
    <link rel="stylesheet" type="text/css" href="style claire.css" media=" " id="theme"/>
</head>
<body>
    <h1 style="text-align: center;">MODIFICATION DU FORMULAIRE DE PARTENARIAT COMMERCIAL</h1>
    <button id="position" onclick="toggleTheme()">Changer de thème</button>
    <div id="form-container">
        <form action="update.php" method="post" id="Form">
            <input type="hidden" name="id" value="<?php echo $formulaire['Form_Num']; ?>">

            <label for="copies">Nombre de copies</label>
            <input name="copies" id="copies" type="number" min="1" value="<?php echo $formulaire['Copie']; ?>">

            <label>Nombre de partenaires :</label>
            <input type="number" name="nombrepartenaires" id="nombrepartenaires" min="1" value="<?php echo $formulaire['Nb_Partenaires']; ?>" readonly>

            <div id="partenaires">
                <?php
                // Récupérer les partenaires associés au formulaire
                $conn = connect();
                $query_part = "SELECT * FROM partenaires WHERE Form_Num = '".$formulaire['Form_Num']."'";
                $result_part = mysqli_query($conn, $query_part);
                $i = 0;
                while ($partenaire = mysqli_fetch_assoc($result_part)) {
                    ?>
                    <div class="partner-block" id="partner-<?php echo $i; ?>">
                        <input name="partenaires[]" id="partenaire-<?php echo $i; ?>" type="text" placeholder="Nom du partenaire" value="<?php echo htmlspecialchars($partenaire['Part_Nom']); ?>">
                        <input name="nature[]" id="nature-<?php echo $i; ?>" type="text" placeholder="Nature des activités" value="<?php echo htmlspecialchars($partenaire['Part_Type']); ?>">
                        <input name="nom[]" id="nom-<?php echo $i; ?>" type="text" placeholder="Nom des activités" value="<?php echo htmlspecialchars($partenaire['Part_Activité']); ?>">
                        <input name="adresse[]" id="adresse-<?php echo $i; ?>" type="text" placeholder="Adresse officielle" value="<?php echo htmlspecialchars($partenaire['Part_Adresse']); ?>">
                        <input name="contribution[]" id="contribution-<?php echo $i; ?>" type="text" placeholder="Contribution du partenaire" value="<?php echo htmlspecialchars($partenaire['Contribution']); ?>">
                        <input name="partages[]" id="partages-<?php echo $i; ?>" type="text" placeholder="Partages des bénéfices et pertes" value="<?php echo htmlspecialchars($partenaire['Partages']); ?>">
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>

            <div class="control">
                <input type="button" class="addPartner" id="plusPartner" value="Ajouter un partenaire" onclick="addPartner();">
                <input type="button" class="removePartner" id="delPartner" value="Supprimer un partenaire" onclick="removePartner()">
            </div>

            <h2>Termes</h2>
            <label>Date de début :</label>
            <input name="début" id="début" type="date" min="2024-11-08" value="<?php echo $formulaire['Date_Debut']; ?>">

            <label>Date de fin :</label>
            <input name="fin" id="fin" type="date" min="2024-11-08" value="<?php echo $formulaire['Date_Fin']; ?>">

            <h2>Modalités bancaires et termes financiers</h2>
            <label>Nombre de Partenaires devant signer les chèques</label>
            <input type="number" name="chèques" id="chèques" min="1" value="<?php echo $formulaire['Nb_Signatures']; ?>">

            <h2>Clause de concurrence</h2>
            <label>Durée durant laquelle les partenaires ne peuvent s'engager dans une entreprise concurrente</label>
            <input name="concurrence" id="concurrence" type="number" min="1" value="<?php echo $formulaire['Concurence']; ?>">

            <h2>Juridiction</h2>
            <label>Le contrat est régis par les lois de l'État de</label>
            <input type="text" name="lois" id="lois" value="<?php echo $formulaire['Etat']; ?>">

            <label>Solennellement affirmé à</label>
            <input type="text" name="affirmé" id="affirmé" value="<?php echo $formulaire['Affirme']; ?>">

            <label>Daté de ce jour : </label>
            <p id="auj"><?php echo date("d/m/Y"); ?></p>

            <label>Nom de l'avocat :</label>
            <input type="text" name="avocat" id="avocat" value="<?php echo $formulaire['Avocat']; ?>">

            <button type="submit">Terminer</button>
        </form>
    </div>
    <script src="formulaire.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
