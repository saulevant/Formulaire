<!-- Ensemble des fonctions de connection, création, lecture, ajout, modification et supression de formulaire (CRUD) -->
<?php
  function connect() {
     $connexion = mysqli_connect('localhost','root','');
     if ($connexion) {
      //echo 'Connexion au serveur réussie<br>';
      $ok = mysqli_select_db($connexion,'formulaire');
      if ($ok) {
        //echo 'Base de données sélectionnée<br>';
        return $connexion;
      } else{
        echo 'Echec de la sélection de la base<br>';
      }
     } else {
        echo 'Erreur lors de la connexion<br>';
     }
  }
  function read_form($id=False) {
    if($id){
      $requete = 'SELECT * 
      FROM formulaires f, partenaires p
      WHERE f.Form_Num=p.Form_Num
      AND f.Form_Num="'.$id.'"';
    } else {
      $requete = 'SELECT * 
      FROM formulaires f, partenaires p
      WHERE f.Form_Num=p.Form_Num';
    }
    $resultat = mysqli_query(connect(),$requete);
    if ($resultat == FALSE) {
       echo 'Echec de l\'exécution de la requête<br>';
     } else{
       //echo 'Exécution réussie<br>';
       $tableau = null;
       while ($ligne = mysqli_fetch_assoc($resultat)){
         $tableau[] = $ligne;
        }
      return $tableau;
     }
  }
  function add_form($Copie, $Nb_Partenaires, $Date_Debut, $Date_Fin, $contribution, $partages, $Nb_Signatures, $Concurence, $Etat, $Affirme, $Date, $Avocat, $partenaires, $nature, $nom, $adresse) {
    $connexion = connect();
    $requete_formulaire = "INSERT INTO formulaires (Copie, Nb_Partenaires, Date_Debut, Date_Fin, Nb_Signatures, Concurence, Etat, Affirme, Date, Avocat) 
    VALUES ('$Copie', '$Nb_Partenaires', '$Date_Debut', '$Date_Fin', '$Nb_Signatures', '$Concurence', '$Etat', '$Affirme', '$Date', '$Avocat')";
        mysqli_query($connexion, $requete_formulaire);
    $form_id = mysqli_insert_id($connexion);  // Récupérer l'ID du formulaire inséré

    // Insérer chaque partenaire
    foreach ($partenaires as $index => $partenaire) {
        $Part_Nom = mysqli_real_escape_string($connexion, $partenaire);
        $Part_Type = mysqli_real_escape_string($connexion, $nature[$index]);
        $Contribution=mysqli_real_escape_string($connexion, $contribution[$index]);
        $Partages=mysqli_real_escape_string($connexion, $partages[$index]);
        $Part_Activité = mysqli_real_escape_string($connexion, $nom[$index]);
        $Part_Adresse = mysqli_real_escape_string($connexion, $adresse[$index]);

        $requete_partenaire = "INSERT INTO partenaires (Part_Nom, Part_Activité, Part_Adresse, Part_Type, Contribution, Partages, Form_Num) 
        VALUES ('$Part_Nom', '$Part_Type', '$Part_Adresse', '$Part_Activité','$Contribution' , '$Partages' , '$form_id')";
                mysqli_query($connexion, $requete_partenaire);
    }
}
function update_form($id, $copies, $nb_partenaires, $date_debut, $date_fin, $concurrence, $lois, $affirme, $avocat, $partenaires, $nature, $nom, $adresse, $contribution, $partages) {
  $connexion = connect();

  // Mettre à jour le formulaire
  $query = "UPDATE formulaires SET
              Copie = '$copies',
              Nb_Partenaires = '$nb_partenaires',
              Date_Debut = '$date_debut',
              Date_Fin = '$date_fin',
              Concurence = '$concurrence',
              Etat = '$lois',
              Affirme = '$affirme',
              Avocat = '$avocat'
            WHERE Form_Num = '$id'";
  mysqli_query($connexion, $query);

  // Supprimer les anciens partenaires
  $query_suppr = "DELETE FROM partenaires WHERE Form_Num = '$id'";
  mysqli_query($connexion, $query_suppr);

  // Ajouter les nouveaux partenaires
  foreach ($partenaires as $index => $partenaire) {
      $Part_Nom = mysqli_real_escape_string($connexion, $partenaire);
      $Part_Type = mysqli_real_escape_string($connexion, $nature[$index]);
      $Part_Activité = mysqli_real_escape_string($connexion, $nom[$index]);
      $Part_Adresse = mysqli_real_escape_string($connexion, $adresse[$index]);
      $Part_Contribution = mysqli_real_escape_string($connexion, $contribution[$index]);
      $Part_Partages = mysqli_real_escape_string($connexion, $partages[$index]);

      // Insertion des partenaires
      $query_partenaire = "INSERT INTO partenaires (Part_Nom, Part_Type, Part_Activité, Part_Adresse, Contribution, Partages, Form_Num) 
                           VALUES ('$Part_Nom', '$Part_Type', '$Part_Activité', '$Part_Adresse', '$Part_Contribution', '$Part_Partages', '$id')";
      mysqli_query($connexion, $query_partenaire);
  }
}


  function del_form($id) {
    $connexion = connect();
    
    // Supprimer d'abord les partenaires liés au formulaire
    $requete_partenaires = "DELETE FROM partenaires WHERE Form_Num = '$id'";
    mysqli_query($connexion, $requete_partenaires);

    // Supprimer ensuite le formulaire
    $requete_formulaire = "DELETE FROM formulaires WHERE Form_Num = '$id'";
    mysqli_query($connexion, $requete_formulaire);
  }
?>