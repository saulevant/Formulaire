<?php
// connexion à la base de données
include("fonction.php");

// Vérifier si l'ID du formulaire est passé en POST
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    del_form($id);

    // Rediriger vers la page d'affichage des formulaires avec un message de confirmation
    header('Location: selection.php?message=Formulaire supprimé avec succès');
    exit();
} else {
    // Si aucun formulaire n'est sélectionné
    echo 'Aucun formulaire sélectionné.';
}
?>
