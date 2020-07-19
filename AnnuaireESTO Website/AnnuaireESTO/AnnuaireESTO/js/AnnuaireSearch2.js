// LES BOUTONS DE RECHERCHE PAR UTILISATEURS
let btnEtudiants= document.getElementById('btns').getElementsByTagName('button')[0];
let btnEnseignants= document.getElementById('btns').getElementsByTagName('button')[1];
let btnAdministrateurs= document.getElementById('btns').getElementsByTagName('button')[2];
// LES TABLES DES UTILISATEURS
let tableEtudiants = document.getElementById('tableEtudiants');
let tableEnseignants = document.getElementById('tableEnseignants');
let tableAdministrateurs = document.getElementById('tableAdministrateurs');

// La barre de recherche
let searchBar = document.getElementById('search-txt');

// changer la fonction de la recherche pour chaque utilisateur + la visibilite des tables
btnEnseignants.addEventListener('click', () => {
    tableEtudiants.style.display='none';
    tableAdministrateurs.style.display='none';
    tableEnseignants.style.display="flex";
    // changer la fonction de recherche
    searchBar.setAttribute("onkeyup", "FilterEnseignant()");
});
btnAdministrateurs.addEventListener('click', () => {
    tableEtudiants.style.display='none';
    tableEnseignants.style.display="none";
    tableAdministrateurs.style.display='flex';
    searchBar.setAttribute("onkeyup", "FilterAdministrateur()");
});
btnEtudiants.addEventListener('click', () => {
    tableEnseignants.style.display="none";
    tableAdministrateurs.style.display='none';
    tableEtudiants.style.display='flex';
    searchBar.setAttribute("onkeyup", "FilterEtudiant()");
});