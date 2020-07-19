   // Get DOM Elements
   const modal = document.querySelector('#my-modal');
   const modalBtnEtud = document.querySelector('#modal-btn-etud');
   const modalBtnEns = document.querySelector('#modal-btn-ens');
   const closeBtn = document.querySelector('.close');



   // Events
   modalBtnEtud.addEventListener('click', openModalEtud);
   modalBtnEns.addEventListener('click', openModalEns);
   closeBtn.addEventListener('click', closeModal);
   window.addEventListener('click', outsideClick);

   // Open
   function openModalEtud() {
    // open modal
     modal.style.display = 'block';
        // changer le titre de pop up 
    document.getElementById("modalTitle").innerHTML="Ajouter Etudiant";
    // changement de champ d'etudiant cne à ppr pour les enseignants 
    var cneEtudiantInscription= document.getElementById("ppr");
    cneEtudiantInscription.setAttribute("id","cne");
    cneEtudiantInscription.setAttribute("placeholder","CNE");
    cneEtudiantInscription.setAttribute("name","cne");
    cneEtudiantInscription.setAttribute("title","EX: 10 caracteres H13*****");
    cneEtudiantInscription.setAttribute("pattern",".{10,}");
    cneEtudiantInscription.setAttribute("maxlength","10");
    // le choix unique de filiere pour les etudiant + changer le nom de champ de la selection 
    document.getElementById("filiere").setAttribute("name","filiere");
    document.getElementById('filiere').multiple=false;
    // la bouton de confirmation
    document.getElementById("ConfirmButton").setAttribute("name","CrudAddEtudiant");
   }
   function openModalEns() {
   // open modal
    modal.style.display = 'block';
   // changer le titre de pop up 
    document.getElementById("modalTitle").innerHTML="Ajouter Enseignant";
    // changement de champ d'etudiant cne à ppr pour les enseignants 
    var pprEnseignantInscription= document.getElementById("cne");
    pprEnseignantInscription.setAttribute("id","ppr");
    pprEnseignantInscription.setAttribute("placeholder","PPR");
    pprEnseignantInscription.setAttribute("name","ppr");
    pprEnseignantInscription.setAttribute("title","");
    pprEnseignantInscription.removeAttribute("pattern");
    pprEnseignantInscription.removeAttribute("maxlength");
    // le choix multiple des filieres pour les enseignants + changer le nom de champ de la selection 
    document.getElementById("filiere").setAttribute("name","filieres[]");
    document.getElementById('filiere').multiple=true;
    // la bouton de confirmation
    document.getElementById("ConfirmButton").setAttribute("name","CrudAddEnseignant");

  }


   // Close
   function closeModal() {
     modal.style.display = 'none';
   }

   // Close If Outside Click
   function outsideClick(e) {
     if (e.target == modal) {
       modal.style.display = 'none';
     }
   }