<!-- afichage des informations correspandantes pour le formulaires -->
<?php
// connexion à la base de données
include("fonction.php");
connect(); 

// Récupérer l'ID du formulaire 
if (isset($_GET['id'])) {
    $form_id = $_GET['id']; 
} else {
    die("ID du formulaire non spécifié.");
}

// Fonction pour récupérer un formulaire et ses partenaires par l'ID
function getFormulaireAndPartnersById($id) {
    $conn = connect(); 
    $query = "SELECT f.*, p.* FROM formulaires f 
              LEFT JOIN partenaires p ON f.Form_Num = p.Form_Num 
              WHERE f.Form_Num = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id); // Lier l'ID en tant qu'entier
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $formulaire = null;
    $partners = [];
    
    // Récupérer les résultats
    while ($row = mysqli_fetch_assoc($result)) {
        if (!$formulaire) {
            // Sauvegarder les données du formulaire si elles ne sont pas encore récupérées
            $formulaire = $row;
        }
        // Ajouter les partenaires associés
        if ($row['Part_Nom']) {
            $partners[] = [
                'part_num' => $row['Part_Num'],
                'name' => $row['Part_Nom'],
                'address' => $row['Part_Adresse'],
                'activity' => $row['Part_Activité'],
                'type' => $row['Part_Type'],
                'contribution' => $row['Contribution'],
                'shares' => $row['Partages'],
                'form_num' => $row['Form_Num']
            ];
        }
    }

    return ['formulaire' => $formulaire, 'partners' => $partners];
}

// Récupérer les détails du formulaire et des partenaires
$data = getFormulaireAndPartnersById($form_id);
$formulaire = $data['formulaire'];
$partners = $data['partners'];

// Si le formulaire existe, l'afficher
//if ($formulaire) {
//    echo "<h1>Détails du Formulaire</h1>";
//    echo "<p>Nom du formulaire : " . htmlspecialchars($formulaire['Form_Num']) . "</p>";
//    echo "<p>Description : " . htmlspecialchars($formulaire['Copie']) . "</p>";
//    echo "<p>Date de début : " . htmlspecialchars($formulaire['Date_Debut']) . "</p>";
//    echo "<p>Date de fin : " . htmlspecialchars($formulaire['Date_Fin']) . "</p>";
//    // Vous pouvez ajouter d'autres champs ici
//} else {
//    echo "<p>Formulaire non trouvé.</p>";
//}

// Afficher les partenaires associés
//if (!empty($partners)) {
//    echo "<h2>Partenaires associés :</h2>";
//    foreach ($partners as $partner) {
//        echo "<p>Partenaire: " . htmlspecialchars($partner['name']) . "<br>Adresse: " . htmlspecialchars($partner['address']) . "<br> Contribution: " . htmlspecialchars($partner['contribution']) . "</p>";
//    }
//} else {
//    echo "<p>Aucun partenaire associé à ce formulaire.</p>";
//}
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Partenariat Commercial</title>
    <link rel="stylesheet" type="text/css" href="style form.css" />
  </head>
  <body>
    <div id=divToPrint>

    <h1>CONTRAT DE PARTENARIAT COMMERCIAL</h1>
    <p>Ce contrat est fait ce jour <a id="auj"></a>, en <?php     echo "" . htmlspecialchars($formulaire['Copie']) . ""; ?> copie(s) originales, entre :</p>
    
    <?php
        // affichage des partenaires
        foreach ($partners as $partner) {

            echo "<p>Partenaire: " . htmlspecialchars($partner['name']) . "<br>Adresse: " . htmlspecialchars($partner['address']) . "</p>";
        }

    ?>

    <h2>1. NOM DU PARTENARIAT ET ACTIVITE</h2>
    <h3>1.1 Nature des activités :</h3>
    <?php
    foreach ($partners as $partner) {
        echo "<p>Partenaire: " . htmlspecialchars($partner['name']) . "<br> Nature: " . htmlspecialchars($partner['activity']) . "<br> Nom de l'activité : " . htmlspecialchars($partner['type']) . "</p>";
    }
    ?>

    <h2>2. TERMES</h2>
    <h3>2.1 Le partenariat commence le <?php echo htmlspecialchars($formulaire['Date_Fin']); ?> et continue jusqu’à la fin de cet accord, le <?php echo htmlspecialchars($formulaire['Date_Fin']); ?>.</h3>

    <h2>3. CONTRIBUTION AU PARTENARIAT</h2>
    <p>La contribution de chaque partenaire au capital se compose des éléments suivants :</p>
    <?php
    foreach ($partners as $partner) {
        echo "<p>Partenaire: " . htmlspecialchars($partner['name']) . "<br>Contribution: " . htmlspecialchars($partner['contribution']) . "</p>";
    }
    ?>

    <h2>4. RÉPARTITION DES BÉNÉFICES ET DES PERTES</h2>
    <p>Les Partenaires se partageront les profits et les pertes du partenariat commercial de la manière suivante :</p>
    <?php
    foreach ($partners as $partner) {

        echo "<p>Partenaire: " . htmlspecialchars($partner['name']) . "<br>Partages: " . htmlspecialchars($partner['shares']) . "</p>";
    }
    ?>

    <h2>5. PARTENAIRES ADDITIONNELS</h2>
    <h3>5.1 Aucune personne ne peut être ajoutée en tant que partenaire sans le consentement écrit de tous les partenaires.</h3>

    <h2>6. MODALITÉS BANCAIRES ET TERMES FINANCIERS</h2>
    <h3>6.1 Les Partenaires doivent avoir un compte bancaire au nom du partenariat sur lequel les chèques doivent être signés par au moins <?php echo htmlspecialchars($formulaire['Nb_Signatures']); ?> des Partenaires.</h3>

    <h2>7. JURIDICTION</h2>
    <h3>7.1 Le présent contrat de partenariat commercial est régi par les lois de l’État de <?php echo htmlspecialchars($formulaire['Etat']); ?>.</h3>
    <p>Solennellement affirmé à <?php echo htmlspecialchars($formulaire['Affirme']); ?>.</p>

    <p>Signé, validé et livré en présence de :</p>
    <?php
    foreach ($partners as $partner) {
        echo "<p>" . htmlspecialchars($partner['name']) . "</p>";
    }
    ?>
    <p>Par l'avocat : <?php echo htmlspecialchars($formulaire['Avocat']); ?>.</p>
    </div>
    <br>
    <button onclick="imprimerContrat()">Imprimer</button>
   <button onclick="window.location='selection.php'">Retour à la sélection</button>
    <script src="formulairephp.js"></script>
    <script src="print.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php
// Debug : Afficher les données POST pour tester la récupération
//echo '<pre>';
//var_dump($_GET);
//echo '</pre>';
?>