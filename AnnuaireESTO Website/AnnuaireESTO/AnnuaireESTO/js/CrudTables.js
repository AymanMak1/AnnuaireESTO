let btnEtudiants= document.getElementById('btns').getElementsByTagName('button')[0];
let btnEnseignants= document.getElementById('btns').getElementsByTagName('button')[1];
let tableEtudiants = document.getElementById('tableEtudiants');
let tableEnseignants = document.getElementById('tableEnseignants');
let searchBar = document.getElementById('search-txt');
btnEnseignants.addEventListener('click', () => {
  tableEtudiants.style.display='none';
  tableEnseignants.style.display="flex";
  searchBar.setAttribute("onkeyup", "FilterEnseignant()");
});

btnEtudiants.addEventListener('click', () => {
    tableEnseignants.style.display="none";
    tableEtudiants.style.display='flex';
    searchBar.setAttribute("onkeyup", "FilterEtudiant()");
});