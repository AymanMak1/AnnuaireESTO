<form action="" method="POST">
<div id="my-EditModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close" onclick="closeEditModal()">&times;</span>
          <h2 id="modalTitle">Modifier Etudiant</h2>
        </div>
            <div class="modal-body">

                <input style="display:none" type="text" id="IDEtudiant" name="IDEtudiant">
                <input type="text" id="EditCne" name="EditCne" pattern=".{10,}" maxlength="10" title="EX: 10 caracteres H13*****" placeholder="CNE" required autocomplete="on"/><br>
                <input type="text" id="EditNom" name="EditNom" placeholder="Nom" required autocomplete="on" /><br>
                <input type="text" id="EditPrenom"  name="EditPrenom" placeholder="Prénom" required autocomplete="on" /><br>
                <input type="email" id="EditEmail" name="EditEmail" placeholder="Email" required autocomplete="on" /><br>
                <input type="tel" id="EditTel"  name="EditTel" maxlength="10" pattern=".{10,}" placeholder="Numero de telephone" required /><br> 

                <select name="EditFiliere" id="EditFiliere" required>
                        <?php 
                          $queryFetchFiliere = "SELECT * FROM filiere";
                          $stmtFetchFiliere = $db->prepare($queryFetchFiliere);
                          $stmtFetchFiliere->execute();
                          $filieres = $stmtFetchFiliere->fetchAll();
                          foreach($filieres as $filiere){
                        ?>
                        <option value="<?php echo $filiere['ID_FILIERE']; ?>" class="<?php echo $filiere['ABR_FILIERE'];?>"><?php echo $filiere['ABR_FILIERE'];?></option>
                        <?php } ?>
                </select><br>

                <input type="password" name="EditMdp" id="EditMdp" placeholder="Champ vide = Ancien mot de passe" pattern=".{5,}" title="5 caractere min" />
            </div>
            <div class="modal-footer">
            
              <button name="CrudEditEtudiant" id="ConfirmEditButton" style="background:transparent; border-radius:16px;color:white; width:150px; padding:8px;" >Confirmer</button>
            </div>
        </div>
      </div>
</form>