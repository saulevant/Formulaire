<!--Créé par Arthur Richert--Villain le 07/10/24
Modifié le 11/12/24-->
<!DOCTYPE html>
<html lang="fr">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Partenariat Commercial</title>
    <link rel="stylesheet" type="text/css" href="style claire.css" media=" " id="theme"/>
 </head>
 <body>
    <h1 style="text-align: center;">CONTRAT DE PARTENARIAT COMMERCIAL</h1>
    <button id="position" onclick="toggleTheme()">Changer de thème</button>
    <div id="form-container">
        <form action="Routeur.php" method="post" id="Form">
            <label for="copies">Nombre de copies</label>
            <input name="copies" id="copies" type="number" min="1" value="1">

            <label>Nombre de partenaires :</label>
            <input type="number" name="nombrepartenaires" id="nombrepartenaires" min="1" value="1" readonly>

            <div id="partenaires"> <!-- Création d'un bloc dynamique pour les parteniares   -->
                <div class="partner-block" id="partner-0">
                 <input name="partenaires[]" id="partenaire-0" type="text" placeholder="Nom du partenaire">
                 <input name="nature[]" id="nature-0" type="text" placeholder="Nature des activités">
                 <input name="nom[]" id="nom-0" type="text" placeholder="Nom des activités">
                 <input name="adresse[]" id="adresse-0" type="text" placeholder="Adresse officielle">
                 <input name="contribution[]" id="contribution-0" type="text" placeholder="Contribution du partenaire">
                 <input name="partages[]" id="partages-0" type="text" placeholder="Partages des bénéfices et pertes">
                </div>
            </div>


            <div class="control"> <!-- ajout et retrait des partenaires exepter le premier champs -->
                <input type="button" class="addPartner" id="plusPartner" value="Ajouter un partenaire" onclick="addPartner();">
                <input type="button" class="removePartner" id="delPartner" value="Supprimer un partenaire" onclick="removePartner()">
            </div>

            <h2>Termes</h2>
            <label>Date de début :</label>
            <input name="début" id="début" type="date" min="2024-11-08">

            <label>Date de fin :</label>
            <input name="fin" id="fin" type="date" min="2024-11-08">

            <h2>Modalités bancaires et termes financiers</h2>
            <label>Nombre de Partenaires devant signer les chèques</label>
            <input type="number" name="chèques" id="chèques" min="1">

            <h2>Clause de concurrence</h2>
            <label>Durée durant laquelle les partenaires ne peuvent s'engager dans une entreprise concurrente</label>
            <input name="concurrence" id="concurrence" type="number" min="1">

            <h2>Juridiction</h2>
            <label>Le contrat est régis par les lois de l'État de</label>
            <input type="text" name="lois" id="lois">

            <label>Solennellement affirmé à</label>
            <input type="text" name="affirmé" id="affirmé">

            <label>Daté de ce jour : </label>
            <p id="auj"></p>

            <label>Nom de l'avocat :</label>
            <input type="text" name="avocat" id="avocat">

            <button type="submit">Terminer</button>
        </form>
    </div>
    <script src="formulaire.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </body>
</html>
