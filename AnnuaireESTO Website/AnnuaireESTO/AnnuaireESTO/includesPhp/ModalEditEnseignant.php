<form action="" method="POST">
<div id="EditModalEns" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close" onclick="closeEditModalEns()">&times;</span>
          <h2 id="modalTitle">Modifier Enseignant</h2>
        </div>
            <div class="modal-body">

                <input style="display:none" type="text" id="IDEnseignant" name="IDEnseignant">
                <input type="text" id="EditPpr" name="EditPpr" placeholder="PPR" required autocomplete="on"/><br>
                <input type="text" id="EditNomEns" name="EditNomEns" placeholder="Nom" required autocomplete="on" /><br>
                <input type="text" id="EditPrenomEns"  name="EditPrenomEns" placeholder="Prénom" required autocomplete="on" /><br>
                <input type="email" id="EditEmailEns" name="EditEmailEns" placeholder="Email" required autocomplete="on" /><br>
                <input type="tel" id="EditTelEns"  name="EditTelEns" maxlength="10" pattern=".{10,}" placeholder="Numero de telephone" required /><br> 

                <select name="EditFiliereEns[]" id="EditFiliereEns" multiple>
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

                <input type="password" name="EditMdpEns" id="EditMdpEns" placeholder="Champ vide = Ancien mot de passe" pattern=".{5,}" title="5 caractere min" />
            </div>
            <div class="modal-footer">
            
              <button name="CrudEditEnseignant" id="ConfirmEditButton" style="background:transparent; border-radius:16px;color:white; width:150px; padding:8px;" >Confirmer</button>
            </div>
        </div>
      </div>
</form>