document.getElementById("début").min = new Date().toISOString().split("T")[0]; // Met la date minimale à aujourd'hui
document.getElementById("fin").min = new Date().toISOString().split("T")[0];

let partnerIdCounter = 1;  // Le premier partenaire est déjà initialisé dans le php

// Fonction pour mettre à jour le nombre de partenaires
function updatePartnersCount() {
    var partnerBlocks = document.getElementsByClassName('partner-block');
    document.getElementById("nombrepartenaires").value = partnerBlocks.length;
}

// Fonction pour ajouter un nouveau partenaire
function addPartner() {
    var partnerBlock = document.createElement('div');
    partnerBlock.classList.add('partner-block');  // Ajout d'une classe pour identifier le bloc

    // Créer les champs pour ce partenaire
    var partnerInput = document.createElement('input');
    partnerInput.setAttribute('name', 'partenaires[]');
    partnerInput.setAttribute('type', 'text');
    partnerInput.setAttribute('placeholder', 'Nom du partenaire');
    partnerInput.setAttribute('id', 'partenaire-' + partnerIdCounter);

    var natureInput = document.createElement('input');
    natureInput.setAttribute('name', 'nature[]');
    natureInput.setAttribute('type', 'text');
    natureInput.setAttribute('placeholder', 'Nature des activités');
    natureInput.setAttribute('id', 'nature-' + partnerIdCounter);  

    var nomInput = document.createElement('input');
    nomInput.setAttribute('name', 'nom[]');
    nomInput.setAttribute('type', 'text');
    nomInput.setAttribute('placeholder', 'Nom des activités');
    nomInput.setAttribute('id', 'nom-' + partnerIdCounter);  

    var adresseInput = document.createElement('input');
    adresseInput.setAttribute('name', 'adresse[]');
    adresseInput.setAttribute('type', 'text');
    adresseInput.setAttribute('placeholder', 'Adresse officielle');
    adresseInput.setAttribute('id', 'adresse-' + partnerIdCounter);

    // Nouveaux champs ajoutés
    var contributionInput = document.createElement('input');
    contributionInput.setAttribute('name', 'contribution[]');
    contributionInput.setAttribute('type', 'text');
    contributionInput.setAttribute('placeholder', 'Contribution du partenaire');
    contributionInput.setAttribute('id', 'contribution-' + partnerIdCounter);

    var partagesInput = document.createElement('input');
    partagesInput.setAttribute('name', 'partages[]');
    partagesInput.setAttribute('type', 'text');
    partagesInput.setAttribute('placeholder', 'Partages des bénéfices et pertes');
    partagesInput.setAttribute('id', 'partages-' + partnerIdCounter);

    // Ajouter les champs au bloc
    partnerBlock.appendChild(partnerInput);
    partnerBlock.appendChild(natureInput);
    partnerBlock.appendChild(nomInput);
    partnerBlock.appendChild(adresseInput);
    partnerBlock.appendChild(contributionInput);  // Ajouter le champ de contribution
    partnerBlock.appendChild(partagesInput);  // Ajouter le champ des partages

    // Ajouter le bloc au conteneur
    document.getElementById('partenaires').appendChild(partnerBlock);

    // Incrémenter l'ID pour le prochain partenaire
    partnerIdCounter++;

    // Mettre à jour le nombre de partenaires
    updatePartnersCount();
}

// Fonction pour supprimer un partenaire
function removePartner() {
    var partnerBlocks = document.getElementsByClassName('partner-block');

    // Vérifie qu'il y a plus d'un bloc
    if (partnerBlocks.length > 1) {
        // Vérifier si le bloc à supprimer n'est pas le premier bloc
        var lastBlock = partnerBlocks[partnerBlocks.length - 1];
        
        // On s'assure de ne pas supprimer le premier bloc
        if (lastBlock.id !== 'partner-0') {
            lastBlock.remove();  // Supprimer le dernier bloc ajouté
            updatePartnersCount();  // Mettre à jour le nombre de partenaires
        }
    }
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; // Les mois commencent à 0
var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd;
} 
if (mm < 10) {
    mm = '0' + mm;
} 
today = dd + '/' + mm + '/' + yyyy;
document.getElementById("auj").innerHTML = today;

// Fonction pour basculer entre les thèmes clair et sombre
function toggleTheme() {
    let theme = document.getElementById('theme');

    if (theme.getAttribute('href') == 'style claire.css') {
        theme.setAttribute('href', 'style sombre.css');
    } else {
        theme.setAttribute('href', 'style claire.css');
    }
}

// Détecter le mode sombre ou clair
const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

const themeStylesheet = document.getElementById('theme');

// Changez la feuille de style en fonction du thème
if (isDarkMode) {
    themeStylesheet.setAttribute('href', 'style sombre.css');
} else {
    themeStylesheet.setAttribute('href', 'style claire.css');
}

// Écoutez les changements du thème
const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
mediaQuery.addEventListener('change', (event) => {
    if (event.matches) {
        themeStylesheet.setAttribute('href', 'style sombre.css');
    } else {
        themeStylesheet.setAttribute('href', 'style claire.css');
    }
});
