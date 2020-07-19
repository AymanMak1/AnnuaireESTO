  // POUR OUVRIR LE MENU
  function openSlideMenu(){
    document.getElementById('menu').style.width = '250px';
    document.getElementById('contents').style.marginLeft = '250px';
    document.getElementsByTagName('i')[0].style.visibility='hidden';
  }
    // POUR FERMER LE MENU
  function closeSlideMenu(){
      document.getElementById('menu').style.width = '0';
      document.getElementById('contents').style.marginLeft = '0';
      document.getElementsByTagName('i')[0].style.visibility='visible';
  }

  // POUR FAIRE APPARAITRE LE FORMULAIRE DE MODIFICATION DE PROFIL
  function EditProfil(){
    document.querySelector("#modal").style.display="flex";
    closeSlideMenu();
  }
  // POUR FERMER LE FORMULAIRE DE MODIFICATION DE PROFIL
  function CloseModal(){
    document.querySelector("#modal").style.transition=".4s";
    document.querySelector("#modal").style.display="none";
}
// POUR LA CONFIRMATION DE LA DECONNEXIONS
function logoutPrompt(){
  var logout = confirm("Vous etes sure de se deconnecter");
    if (logout == true) {
      window.location.href = "configConn/logout.php";  
    }
}

// changement de champ d'etudiant cne à ppr pour les enseignants et les professeurs
if(userDescription == 'Enseignant' || userDescription =='Administrateur'){
    var ppr= document.getElementById("cne");
    ppr.setAttribute("id","ppr");
    ppr.setAttribute("name","ppr");
    ppr.setAttribute("placeholder","PPR");
    ppr.setAttribute("title","");
    ppr.removeAttribute("pattern");
    // ACTIVATION DE LA CHOIX MULTIPLE
    document.getElementById("filiere").setAttribute("name","filieres[]");
    document.getElementById("filiere").multiple=true;
}

