const editModal = document.querySelector('#my-EditModal');
//modalBtnEditUser.addEventListener('click', openModalEditUser);
window.addEventListener('click', outsideClickEditModal);

function openModalEditUser() {
    // open modal
     editModal.style.display = 'block';
}
function closeEditModal() {
  editModal.style.display = 'none';
}
// Close If Outside Click
function outsideClickEditModal(e) {
     if (e.target == editModal) {
      editModal.style.display = 'none';
     }
  }

var tableEtudiantToEdit= document.getElementById("tableEtudiants"),rIndex;
// recuperation de la ligne ou se trouve l'etudiant que l'administrateur le modifie
for (var i = 0; i < tableEtudiantToEdit.rows.length; i++){
  tableEtudiantToEdit.rows[i].onclick = function(){
    rIndex= this.rowIndex;
    //console.log(rIndex);
    // recuperation des cellules et le remplissage de formulaire de modification de profil d'etudiant
    document.getElementById("IDEtudiant").value=this.cells[0].innerHTML;
    document.getElementById("EditCne").value=this.cells[1].innerHTML;
    document.getElementById("EditNom").value=this.cells[2].innerHTML;
    document.getElementById("EditPrenom").value=this.cells[3].innerHTML;

    var select=document.getElementById("EditFiliere");
    // selectionner la filiere de l'etudiant
    for(var j=0 ; j < 16 ; j++){
      console.log(j+ " = " + select.options[j].innerHTML);
      if(this.cells[4].innerHTML == select.options[j].innerHTML){
        select.options[j].selected = "selected";
        // arreter la recherche si la filiere est trouve
        break;
      }
    }
    console.log(this.cells[4].innerHTML);
    document.getElementById("EditEmail").value=this.cells[5].innerHTML;
    document.getElementById("EditTel").value=this.cells[6].innerHTML;
  };

}