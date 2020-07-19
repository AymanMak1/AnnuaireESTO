const editModalEns = document.querySelector('#EditModalEns');
//modalBtnEditUser.addEventListener('click', openModalEditUser);
window.addEventListener('click', outsideClickEditModal);

function openModalEditEns() {
    // open modal
     editModalEns.style.display = 'block';
}
function closeEditModalEns() {
  editModalEns.style.display = 'none';
}
var tableEnseignantsToEdit= document.getElementById("tableEnseignants"),rIndex;
// recuperation de la ligne ou se trouve l'etudiant que l'administrateur le modifie
for (var i = 0; i < tableEnseignantsToEdit.rows.length; i++){
  tableEnseignantsToEdit.rows[i].onclick = function(){
    rIndex= this.rowIndex;
    //console.log(rIndex);
    // recuperation des cellules et le remplissage de formulaire de modification de profil d'etudiant
    document.getElementById("IDEnseignant").value=this.cells[0].innerHTML;
    document.getElementById("EditPpr").value=this.cells[1].innerHTML;
    document.getElementById("EditNomEns").value=this.cells[2].innerHTML;
    document.getElementById("EditPrenomEns").value=this.cells[3].innerHTML;

    var select=document.getElementById("EditFiliereEns");

    //selectionner les d'enseignant
    
    for(var j=0 ; j < 16 ; j++){
      console.log(j+ " = " + select.options[j].innerHTML);
      
      if(this.cells[4].innerHTML.includes(select.options[j].innerHTML) == true){
         select.options[j].selected = "selected";
        // arreter la recherche si les filiere sont trouve
      }
      
    }
  
    document.getElementById("EditEmailEns").value=this.cells[5].innerHTML;
    document.getElementById("EditTelEns").value=this.cells[6].innerHTML;
  };

}