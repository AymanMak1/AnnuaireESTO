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
document.getElementById("Description").innerHTML="Votre honneur Administrateur";
// changement de champ cne à ppr pour les administrateurs (inscription)
var pprAdministrateurInscription= document.getElementById("cne");
pprAdministrateurInscription.setAttribute("id","ppr");
pprAdministrateurInscription.setAttribute("placeholder","PPR");
pprAdministrateurInscription.setAttribute("title","");
pprAdministrateurInscription.removeAttribute("pattern");
// changement de champ d'etudiant cne à ppr pour les enseignants (connexion)
var pprAdministrateurConnexion= document.getElementById("cneConn");
pprAdministrateurConnexion.setAttribute("id","pprConn");
pprAdministrateurConnexion.setAttribute("placeholder","PPR");
pprAdministrateurConnexion.setAttribute("title","");
// supprimer le champ de selection des filieres pour l'administrateur car il n'appartient a aucune filiere
document.getElementById("filiere").style.display="none";
document.getElementById('filiereLabel').style.display="none";

// changer le nom de champ cne a ppr (connexion & inscription)
document.getElementById("ppr").setAttribute("name","ppr");
document.getElementById('pprConn').setAttribute("name","pprConn");
document.getElementById('pprConn').removeAttribute("pattern");

// changer le nom de bouton d'inscription et la connexion pour il soit aux admins
document.getElementById('SignUp').name='SignUpAdministrateur';
document.getElementById('Login').name='LoginAdministrateur';
