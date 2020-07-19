<div id="contents">
        <span class="slide">
          <a href="#" onclick="openSlideMenu()">
            <i class="fas fa-bars"></i>
          </a>
        </span>

        <div id="menu" class="nav">
          <div style="margin-top:16px;" class="close" onclick="closeSlideMenu()">
            <i class="fas fa-times"></i>
          </div>
          <a href="#title">Accueil</a>
          <a href="#Annuaire" >Annuaire</a>
          <?php if($_SESSION['DESCRIPTION']=="Administrateur"){?>
             <a href="CrudUsers.php">Gestion des utilisateurs</a>
          <?php } ?>
          <a href="#infos">A propos</a>
          <div class="profil" id="profil"><?php echo $_SESSION['NOM'] .' '.  $_SESSION['PRENOM'] ?>
              <div id="ProfilMenu">
                  <a href="#" onclick="EditProfil()">Modification de profil</a>
                  <a href="#" onclick="logoutPrompt()">Se deconnecter</a>
              </div>
          </div>   
        </div>
    </div>