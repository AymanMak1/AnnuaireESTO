<?php  if(isset($success)) {  echo '<script type="text/javascript">alert("' . $success . '")</script>';}?>
<form action="" method="POST" name="editProfilForm" id="editProfilModal">
        <div class="modal" id="modal">
        <div class="modal__dialog">
          <section class="modal__content" style="width:450px;">
            <header class="modal__header">
              <h2 class="modal__title">Modification de profil</h2>
              <a href="#" class="modal__close" onclick="CloseModal()">  <i class="fas fa-times closemodal" style="margin-left:16px;"></i></a>
            </header>
            <div class="modal__body">

                <input type="text" id="cne" name="cne" 
                    value="<?php if($_SESSION['DESCRIPTION'] == 'Etudiant'){ echo $_SESSION['CNE']; }
                    elseif ($_SESSION['DESCRIPTION'] == 'Enseignant') { echo $_SESSION['PPR_ENSEIGNANT'];  }
                    else{echo $userinfos['PPR_ADMINISTRATEUR'];} ?>" 
                    pattern=".{10,}" title="EX: 10 caracteres H13*****" placeholder="CNE" required autocomplete="on"/>

                  <input type="text" id="nom" name="nom" value="<?php echo $userinfos['NOM'] ?>"  placeholder="Nom" required autocomplete="on" />

                  <input type="text" id="prenom" value="<?php echo $userinfos['PRENOM'] ?>" name="prenom" placeholder="Prénom" required autocomplete="on" />

                  <input type="email" id="email" value="<?php echo $userinfos['EMAIL'] ?>" name="email" placeholder="Email" required autocomplete="on" />

                  <input type="tel" id="tel" value="<?php echo  "0".$userinfos['TELEPHONE'] ?>" name="tel" pattern=".{10,}" placeholder="Numero de telephone" required />

                  <?php if($userDescriptionForFiliere == true) {    ?>

                    <?php
                      // LE TRAITEMENT DE SELECTION DE TOUS LES FILIERES QUE L'ENSEIGNANT A SELECTIONNE
                      $queryFilieres="SELECT ID_FILIERE FROM `appartenir_enseignant` WHERE ID_ENSEIGNANT = :ID_ENSEIGNANT";
                      $stmtFilieres= $db->prepare($queryFilieres);
                      $stmtFilieres->bindParam(":ID_ENSEIGNANT",$_SESSION['ID_ENSEIGNANT']);
                      $stmtFilieres->execute();
                      $filieresSelectedFetch=$stmtFilieres->fetchAll(PDO::FETCH_ASSOC);
                      $count = $stmtFilieres->rowCount();
                      $filieresSelected = Array($count);
                      $i=0;
                      foreach(  $filieresSelectedFetch as $filiereSelected){
                        $filieresSelected[$i]=$filiereSelected['ID_FILIERE'];
                        $i++;
                      } 
                    ?>

                  <label style="font-size:12px; color:black;" id="filiereLabel" for="filiere">utiliser CTRL pour choisir plusieur filieres</label> 

                  <select name="filiere" id="filiere" required>

                  <?php 	foreach($data as $filiere){ ?>
                    <!--Traitement de php pour "options selected"-->
                    <option value=<?php  echo $filiere['ID_FILIERE'] ?> id=<?php  echo $filiere['ID_FILIERE'] ?> 
                            <?php if(isset($_SESSION['ID_ETUDIANT'])) { if( $userinfos['ID_FILIERE'] ==  $filiere['ID_FILIERE']){ echo "selected";} }
                            if(isset($_SESSION['ID_ENSEIGNANT'])){ if(in_array($filiere['ID_FILIERE'],$filieresSelected)){ echo "selected"; } } ?>>
                          <?php echo $filiere['ABR_FILIERE'] ?>        
                    </option>

                  <?php }  } ?>

                  </select>	


                  <input type="password" name="mdp" id="mdp" placeholder="Champ vide = ancien mot de passe" pattern=".{5,}" title="5 caractere min" />

            </div>

            <footer class="modal__footer">
                <input type="submit" name="Confirmer" id="editProfilSubmit" value="Confirmer" class="update">
            </footer>
          </section>
        </div>
      </div>
</form>