<?php
// Récupération des données du formulaire
$nombre_de_copies = $_POST['copies'] ?? null;
$nombre_de_partners = $_POST['nombrepartenaires'] ?? null;
$noms_partners = $_POST['partenaires'] ?? [];
$nature_activites = $_POST['nature'] ?? [];
$nom_activites = $_POST['nom'] ?? [];
$adresse_officielle = $_POST['adresse'] ?? [];
$date_debut = $_POST['début'] ?? null;
$date_fin = $_POST['fin'] ?? null;
$contribution_partenaire = $_POST['contribution'] ?? [];
$partage_benefices = $_POST['partages'] ?? [];
$nombre_participants_cheques = $_POST['chèques'] ?? null;
$duree_interdiction_concurrence = $_POST['concurrence'] ?? null;
$lois_etat = $_POST['lois'] ?? null;
$lieu_affirmation = $_POST['affirmé'] ?? null;
$nom_avocat = $_POST['avocat'] ?? null;
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

    <h1>CONTRAT DE PARTENARIAT COMMERCIAL</h1>
    <p>Ce contrat est fait ce jour <a id="auj"></a>, en <?php echo htmlspecialchars($nombre_de_copies); ?> copie(s) originales, entre :</p>
    
    <!-- Affichage des partenaires -->
    <?php
    if (!empty($noms_partners)) {
        // Si le tableau des partenaires n'est pas vide, afficher les partenaires
        foreach ($noms_partners as $index => $partenaire) {
            $nature = $nature_activites[$index] ?? '';
            $adresse = $adresse_officielle[$index] ?? '';
            echo "<p>Partenaire: " . htmlspecialchars($partenaire) . "<br>Adresse: " . htmlspecialchars($adresse) . "</p>";
        }
    } else {
        // Si le tableau est vide, afficher un message d'erreur
        echo "<p>Aucun partenaire ajouté.</p>";
    }
    ?>

    <h2>1. NOM DU PARTENARIAT ET ACTIVITE</h2>
    <h3>1.1 Nature des activités :</h3>
    <?php
    foreach ($noms_partners as $index => $partenaire) {
        $nature = $nature_activites[$index] ?? '';
        $nom=$nom_activites[$index] ?? '';
        echo "<p>Partenaire: " . htmlspecialchars($partenaire). "<br> Nature: " . htmlspecialchars($nature) . "<br> Nom de l'activité : ".htmlspecialchars($nom). "</p>";
    }
    ?>

    <h2>2. TERMES</h2>
    <h3>2.1 Le partenariat commence le <?php echo htmlspecialchars($date_debut); ?> et continue jusqu’à la fin de cet accord, le <?php echo htmlspecialchars($date_fin); ?>.</h3>

    <h2>3. CONTRIBUTION AU PARTENARIAT</h2>
    <p>La contribution de chaque partenaire au capital se compose des éléments suivants :</p>
    <?php
    foreach ($noms_partners as $index => $partenaire) {
    $contribution = $contribution_partenaire[$index] ?? '';
    $partage = $partage_benefices[$index] ?? '';
    echo "<p>Partenaire: " . htmlspecialchars($partenaire) . "<br>Contribution: " . htmlspecialchars($contribution) . "</p>";
}
?>

    <h2>4. RÉPARTITION DES BÉNÉFICES ET DES PERTES</h2>
    <p>Les Partenaires se partageront les profits et les pertes du partenariat commercial de la manière suivante :</p>
    <?php
    foreach ($noms_partners as $index => $partenaire) {
    $contribution = $contribution_partenaire[$index] ?? '';
    $partage = $partage_benefices[$index] ?? '';
    echo "<p>Partenaire: " . htmlspecialchars($partenaire) . "<br>Partages: " . htmlspecialchars($partage) . "</p>";
}
?>

    <h2>5. PARTENAIRES ADDITIONNELS</h2>
    <h3>5.1 Aucune personne ne peut être ajoutée en tant que partenaire sans le consentement écrit de tous les partenaires.</h3>

    <h2>6. MODALITÉS BANCAIRES ET TERMES FINANCIERS</h2>
    <h3>6.1 Les Partenaires doivent avoir un compte bancaire au nom du partenariat sur lequel les chèques doivent être signés par au moins <?php echo htmlspecialchars($nombre_participants_cheques); ?> des Partenaires.</h3>

    <h2>7. JURIDICTION</h2>
    <h3>7.1 Le présent contrat de partenariat commercial est régi par les lois de l’État de <?php echo htmlspecialchars($lois_etat); ?>.</h3>
    <p>Solennellement affirmé à <?php echo htmlspecialchars($lieu_affirmation); ?>.</p>

    <p>Signé, validé et livré en présence de :</p>
    <?php
    foreach ($noms_partners as $index => $partenaire) {
      $nature = $nature_activites[$index] ?? '';
      $nom=$nom_activites[$index] ?? '';
      echo "<p>" . htmlspecialchars($partenaire). "</p>";
  }
?>
    <p>Par l'avocat : <?php echo htmlspecialchars($nom_avocat); ?>.</p>

    <br>
   <button onclick="window.location='creer_form.php';">Page précédente</button>
   <button onclick="window.location='selection.php'">Retour à la sélection</button>
    <script src="formulairephp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php
// tester la récupération
//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';
?>