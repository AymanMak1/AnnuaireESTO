<form action="" method="POST">
<div id="my-modal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">&times;</span>
          <h2 id="modalTitle">Ajouter Etudiant</h2>
        </div>
            <div class="modal-body">
                <input type="text" id="cne" name="cne" pattern=".{10,}" maxlength="10" title="EX: 10 caracteres H13*****" placeholder="CNE" required autocomplete="on"/><br>
                <input type="text" id="nom" name="nom" placeholder="Nom" required autocomplete="on" /><br>
                <input type="text" id="prenom"  name="prenom" placeholder="Prénom" required autocomplete="on" /><br>
                <input type="email" id="email" name="email" placeholder="Email" required autocomplete="on" /><br>
                <input type="tel" id="tel"  name="tel" maxlength="10" pattern=".{10,}" placeholder="Numero de telephone" required /><br> 

                <select name="filiere" id="filiere" required>
                        <?php 
                          $queryFetchFiliere = "SELECT * FROM filiere";
                          $stmtFetchFiliere = $db->prepare($queryFetchFiliere);
                          $stmtFetchFiliere->execute();
                          $filieres = $stmtFetchFiliere->fetchAll();
                          foreach($filieres as $filiere){
                        ?>
                        <option value="<?php echo $filiere['ID_FILIERE']; ?>"><?php echo $filiere['ABR_FILIERE'];?></option>
                        <?php } ?>
                </select><br>

                <input type="password" name="mdp" id="mdp" placeholder="Mot De Passe" pattern=".{5,}" title="5 caractere min" required />
            </div>
            <div class="modal-footer">
              <button name="CrudAddEtudiant" id="ConfirmButton" style="background:transparent; border-radius:16px;color:white; width:150px; padding:8px;" >Confirmer</button>
            </div>
        </div>
      </div>
</form>