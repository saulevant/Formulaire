// Imprimer le contrat
function imprimerContrat() {
    let divToPrint = document.getElementById("divToPrint").innerHTML; // div du contrat pour impression du contrat seulement
   
    let originalContent = document.body.innerHTML; // Enregistrement du body par défaut dans une variable

    document.body.innerHTML = divToPrint; // Défini le body comme étant la div de contrat pour l'imprimer sans les autres élements
    window.print();
    document.body.innerHTML = originalContent; // Retourne sur le body par défaut
}