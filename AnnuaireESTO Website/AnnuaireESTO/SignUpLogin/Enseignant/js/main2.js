const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

// Changement de description d'utilisateur
document.getElementById("Description").innerHTML="Votre honneur Enseignant";
// changement de champ d'etudiant cne à ppr pour les enseignants (inscription)
var pprEnseignantInscription= document.getElementById("cne");
pprEnseignantInscription.setAttribute("id","ppr");
pprEnseignantInscription.setAttribute("placeholder","PPR");
pprEnseignantInscription.setAttribute("title","");
pprEnseignantInscription.removeAttribute("pattern");
// changement de champ d'etudiant cne à ppr pour les enseignants (connexion)
var pprEnseignantConnexion= document.getElementById("cneConn");
pprEnseignantConnexion.setAttribute("id","pprConn");
pprEnseignantConnexion.setAttribute("placeholder","PPR");
pprEnseignantConnexion.setAttribute("title","");
// changement de nom de bouton d'inscription
document.getElementById('SignUp').name='SignUpEnseignant';
// le choix multiple des filieres pour les enseignants
document.getElementById('filiere').multiple=true;
// changer le nom de champ cne a ppr (connexion & inscription) 
document.getElementById("ppr").setAttribute("name","ppr");
document.getElementById("pprConn").setAttribute("name","pprConn");
document.getElementById("pprConn").removeAttribute("pattern");
// changer le nom de champ de la selection 
document.getElementById("filiere").setAttribute("name","filieres[]");
// changer le nom de bouton d'inscription et la connexion pour il soit aux professeurs
document.getElementById('SignUp').name='SignUpEnseignant';
document.getElementById('Login').name='LoginEnseignant';
