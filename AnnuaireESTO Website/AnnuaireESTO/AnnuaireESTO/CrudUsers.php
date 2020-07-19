<?php
session_start();
// REDIRECTION 
if(empty($_SESSION)){
    header("Location:../SignUpLogin/Administrateur/SignUpLogin.php");
}
// CONNEXION
require_once('configConn/conn.php');
// l'obtention des information personnelles de tous les utilisateur
require_once('php/annuaire.php');
// Script de la gestion des utilisateur
require_once('php/crud.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Users</title>
    <link rel="stylesheet" href="css/styleCrud.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <style>
        body{
          height:auto;
        }
    </style>
</head>
<body>

<div class="logo">
  <img src="imgs/AnnuaireESTO.png" id="logo"  alt="AnnuaireESTO">
</div>
<div class="containerBtns">

<h1 style="text-align:center; font-size:2.4rem;padding:0; color:#f4f4f4; margin:0 0 0.67em 0;">Gestion des utilisateurs</h1>

      <div class="btns" id="btns">
                <button>Etudiants</button>
                <button>Enseignants</button>
      </div>
      <div class="infos btnAddUsers" style="margin-bottom:30px;color:white;text-align:center;">
        <img src="imgs/info.png" style="display:inline-block; width:40px;" alt=""><br>
        sur ce tableau de bord, vous pouvez faire la gestion des utilisateurs, ce qui vous donne la possibilité d'ajouter des utilisateurs (professeurs, étudiants),
         vous pouvez supprimer leur compte en plus de cela vous pouvez modifier certaines de leurs informations, et bien sûr vous avez toutes les informations 
         de cet utilisateur, afin que vous puissiez le contacter et lui faire part des changements, et s'il n'y a pas de problème avec ses comptes, 
         vous pouvez valider ses inscriptions.
         <div class="search-box">
             <input type="text" id="search-txt" style="margin-top:16px;" list="filiereDataList" class="light-table-filter"  name="valueToSearch" data-table="table-info" onkeyup="FilterEtudiant()" placeholder="Rechercher.."></input>
      </div> 
            <?php
              $consulter = "SELECT * FROM filiere";
              $resultatConsulter = $db->prepare($consulter);
              $resultatConsulter->execute();
              $data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);  
             ?>
            <datalist id="filiereDataList" style="display:flex;">
            <?php foreach ($data as $filiere){?>
            <option value="<?php echo $filiere['ABR_FILIERE']  ?>" > <!-- .' '. $filiere['LIBELLE'] --> 
            <?php } ?>
            </datalist>
      </div>
<!-----------------Les boutons d'ajout et un placeholder pour l'affichage des message d'erreur ou success------------------>
      <div class="btns btnsAddUsers"  style="margin-bottom:-30px;">
                <button id="modal-btn-etud" class="button">Ajouter Etudiant</button>
                <div><?php if(isset($_GET['successMsg'])){echo $_GET['successMsg']; }?></div>
                <button  id="modal-btn-ens" >Ajouter Enseignant</button>
      </div>

  </div>

<div class="container">

<main>
 <!-- Recherche par etudiants -->
    <table  style="overflow-x:auto;" class="table-info" id="tableEtudiants">
              
              <tr>
                  <th>Cne</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Filiere </th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Action</th>

                </tr>


              <?php foreach($annuaireEtudiant as $etudiant){ ?>

                      <tr>
                          <td style="display:none"><?php echo $etudiant['ID_ETUDIANT']?></td>
                          <td><?php echo $etudiant['CNE']?></td>
                          <td><?php echo $etudiant['NOM']?></td>
                          <td><?php echo $etudiant['PRENOM']?></td>
                          <td><?php echo $etudiant['ABR_FILIERE']?></td>
                          <td><?php echo $etudiant['EMAIL']?></td>
                          <td><?php echo "0".$etudiant['TELEPHONE']?></td>
                          <td class="">
                              <?php if($etudiant['CONFIRMED']== 0){ ?>
                              <a  onclick="return confirm('êtes-vous sûr de confirmer l\'inscription de cet étudiant ?');" href="CrudUsers.php?confirmEtudiant=<?php echo $etudiant['ID_ETUDIANT'] ?>">
                                  <img style="display:inline-block; width:40px; margin-right:16px;" src="imgs/confirm.png" alt="confirmBtn">
                              </a>
                              <?php } ?>
                              <!--a  href="" --> <?php //"CrudUsers.php?editEtudiant=<?php echo $etudiant['ID_ETUDIANT'] ?>
                                  <img class="editUser" onclick="openModalEditUser() " style="cursor:pointer; display:inline-block; width:40px; margin-right:16px;" src="imgs/edit.png" alt="editBtn">
                              </a>
                              <a  onclick="javascript: return confirm('êtes-vous sûr de supprimer cet étudiant ?');" href="CrudUsers.php?deleteEtudiant=<?php echo $etudiant['ID_ETUDIANT'] ?>" >
                                  <img style="display:inline-block; width:40px; margin-right:16px;" src="imgs/delete.svg" alt="deleteBtn">
                              </a>
                          </td>
                      </tr>

              <?php }?>
      </table>  
      <style>

      </style>
<!-- Recherche par enseignant -->
      <table style="display:none" id="tableEnseignants">

          <tr>
          <th>PPR</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Filiere </th>
          <th>Email</th>
          <th>Telephone</th>
          <th>Action</th>
          </tr>
          <?php foreach($annuaireEnseignant as $enseignant){ ?>

              <tr>
                  <td style="display:none"><?php echo $enseignant['ID_ENSEIGNANT']?></td>
                  <td><?php echo $enseignant['PPR_ENSEIGNANT']?></td>
                  <td><?php echo $enseignant['NOM']?></td>
                  <td><?php echo $enseignant['PRENOM']?></td> 
                  <?php     
                  // REQUETE POUR OBTENIR LES FILIERES QUE L'ENSEIGNANT APPARTIENT A 
                    $queryAnnuaireEnseignantFiliere= "SELECT ABR_FILIERE From enseignant e, appartenir_enseignant a, filiere f where e.ID_ENSEIGNANT = a.ID_ENSEIGNANT AND f.ID_FILIERE = a.ID_FILIERE AND e.ID_ENSEIGNANT=:ID_ENSEIGNANT;";
                    $resultatQueryAnnuaireEnseignantFiliere = $db->prepare($queryAnnuaireEnseignantFiliere);
                    $resultatQueryAnnuaireEnseignantFiliere->bindParam(":ID_ENSEIGNANT",$enseignant['ID_ENSEIGNANT'],PDO::PARAM_INT);
                    $resultatQueryAnnuaireEnseignantFiliere->execute();
                    $annuaireEnseignantFiliere=$resultatQueryAnnuaireEnseignantFiliere->fetchAll(PDO::FETCH_ASSOC); 
                  ?>
                  <td><?php foreach($annuaireEnseignantFiliere as $filiere) { echo $filiere['ABR_FILIERE']." "; }  ?></td>
                  <td><?php echo $enseignant['EMAIL']?></td>
                  <td><?php echo "0".$enseignant['TELEPHONE']?></td>
                  <td class="">

                         <?php if($enseignant['CONFIRMED']== 0){ ?>
                              <a   onclick="return confirm('êtes-vous sûr de confirmer l\'inscription de cet enseignant ?');" href="CrudUsers.php?confirmEnseignant=<?php echo $enseignant['ID_ENSEIGNANT'] ?>">
                                      <img style="display:inline-block; width:40px; margin-right:16px;" src="imgs/confirm.png" alt="confirmBtn">
                              </a>
                              <?php } ?>

                              <img class="editUser" onclick="openModalEditEns()" style="cursor:pointer; display:inline-block; width:40px; margin-right:16px;" src="imgs/edit.png" alt="editBtn">

                                <a   onclick="javascript: return confirm('êtes-vous sûr de supprimer cet enseignant ?');" href="CrudUsers.php?deleteEnseignant=<?php echo $enseignant['ID_ENSEIGNANT'] ?>">
                                      <img style="display:inline-block; width:40px; margin-right:16px;" src="imgs/delete.svg" alt="deleteBtn">
                                </a>                               
                  </td>

              </tr>

          <?php }?>

      </table>
</main>

</div>

<!--MODAL (Pop up Formulaire)  Ajouter Utilisateur (etudiant ou enseignant)-->

<?php require_once('includesPhp/ModalAddUser.php') ?>

<!--MODAL (Pop up Formulaire) MODIFIER ETUDIANT-->

<?php require_once('includesPhp/ModalEditEtudiant.php') ?>

<!--MODAL (Pop up Formulaire) MODIFIER ENSEIGNANT-->

<?php require_once('includesPhp/ModalEditEnseignant.php') ?>

<!-- external JS-->
<script src="js/CrudTables.js"></script>
<script src="js/modal.js"></script>
<script src="js/ModalEditEtud.js"></script>
<script src="js/ModalEditEns.js"></script>
<script src="js/SearchKeyUpFuncs.js"></script>


</body>
</html>