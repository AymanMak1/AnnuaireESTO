<?php 
session_start();

//xxxxxxxxxxxxxxxxxxxxxxxxx REDIRECTION  EN CAS DE REVENIR A CETTE PAGE SANS FAIRE L'IDENTIFICATIONxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
/*
Ces deux methode ne fonctionne pas car annuaireESTO est un espace commun
if($_SESSION['ID_ETUDIANT']){
  header("Location:../SignUpLogin/Etudiant/SignUpLogin.php");
}
if($_SESSION['ID_ETUDIANT'] === null || $_SESSION['ID_ENSEIGNANT'] === null  || $_SESSION['ID_ADMINISTRATEUR'] === null ){
  header("Location:../SignUpLogin/Etudiant/SignUpLogin.php");
}

ALORS ON VA PAS FAIRE LA VERIFICATION PAR Les IDs des utilisateur mais par 
la fonction empty pour verifier est ce que le tableau de SESSION est vide de l'utilisateur authentifie

*/

if(empty($_SESSION)){
  header("Location:../index.html");
}

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
require_once('configConn/conn.php');

// AFFICHAGE DE CHAMP DE FILIERE DANS LE FORMULAIRE DE MODIFICATION DE PROFIL JUST POUR LES ENSEIGNANTS ET LES ETUDIANTS
$userDescriptionForFiliere = false;
if(isset($_SESSION['ID_ETUDIANT']) || isset($_SESSION['ID_ENSEIGNANT']))
{
  $userDescriptionForFiliere = true;
  $consulter = "SELECT * FROM filiere";
  $resultatConsulter = $db->prepare($consulter);
  $resultatConsulter->execute();
  $data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);  
    
}else{
  $userDescriptionForFiliere = false;
  $consulter = "SELECT * FROM filiere";
  $resultatConsulter = $db->prepare($consulter);
  $resultatConsulter->execute();
  $data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);  
}

// LES REQUETES PREPARES DE LA RECUPERATION DES INFORMATION PERSONELLES DE L'UTILISATEUR AUTHENTIFIE
require_once('php/userInfos.php');
require_once('php/updateProfil.php');
// LES REQUETES D'ANNUAIRE
require_once('php/annuaire.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleAnnuaire2.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <title>AnnuaireESTO</title>
    <style>

    /* UPDATED STYLE FOR THE EDIT PROFIL MODAL COLORS */

      .modal__header{
        background: linear-gradient(#143F66,#000);
        color:white;
      }
      .modal__footer{
        background: linear-gradient(#143F66,#000);
      }
      input{
        border:2px solid #143F66;
      }
      .update{
          background:transparent;
          width:150px;
          padding:8px;
          color:white;
          border-radius:12px;
          cursor:pointer;
          transition: .4s;
          border:2px solid white;
      }
        @media only screen and (max-width: 414px ) and (min-width:360px) {
        .content .logo{
          margin-top: 0px;
        }
      }

      /*************************************************/

    </style>
</head>
<body>
<!----------x----------Menu----------------------x-->

<?php  require_once('./includesPhp/menu.php');?>

<!----------x----------EDIT PROFIL MODAL----------------------x-->

<?php  require_once('./includesPhp/editProfilModal.php');?>

<!----------x----------SHOWCASE (Accueuil)----------------------x-->

<?php  require_once('./includesPhp/showcase.php');?>

<!----------x----------infos section----------------------x-->
<?php  require_once('./includesPhp/infos.php');?>

<!----------x----------Annuaire----------------------x-->

  <section class="about bg-light" id="Annuaire">

    <div class="container">
    <h1 style="text-align:center; font-size:2.4rem;">Faire la Recherche par</h1>
      <div id="btns">
                <button>Etudiants</button>
                <button>Enseignants</button>
                <button>Administrateurs</button>
      </div>

    <div class="search-box">
       <input type="text" id="search-txt" list="filiereDataList" class="light-table-filter"  name="valueToSearch" data-table="table-info" onkeyup="FilterEtudiant()" placeholder="Rechercher.."></input>
    </div>  
<datalist id="filiereDataList" style="display:flex;">
<?php foreach ($data as $filiere){?>
<option value="<?php echo $filiere['ABR_FILIERE']  ?>" > <!-- .' '. $filiere['LIBELLE'] --> 
<?php } ?>
</datalist>
  
    <main>

        <table  style="overflow-x:auto;" class="table-info" id="tableEtudiants">
   
                <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Filiere </th>
                <th>Email</th>
                <th>Telephone</th>
                </tr>
              
            <?php foreach($annuaireEtudiant as $etudiant){ ?>
                <tr>
                  <td><?php echo $etudiant['NOM']?></td>
                  <td><?php echo $etudiant['PRENOM']?></td>
                  <td><?php echo $etudiant['ABR_FILIERE']." "."<span style=\"display:none\">". $etudiant['LIBELLE'] . "</span>";?></td>
                  <td><?php echo $etudiant['EMAIL']?></td>
                  <td><?php echo "0".$etudiant['TELEPHONE']?></td>
                </tr>
              <?php }?>

  
        </table>


         <table style="display:none" id="tableEnseignants">

            <tr>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Filiere </th>
              <th>Email</th>
              <th>Telephone</th>
            </tr>
            <?php foreach($annuaireEnseignant as $enseignant){ ?>
              <tr>
                <td><?php echo $enseignant['NOM']?></td>
                <td><?php echo $enseignant['PRENOM']?></td> 
                <?php     
                  // REQUETE POUR OBTENIR LES FILIERES QUE L'ENSEIGNANT APPARTIENT A 
                  $queryAnnuaireEnseignantFiliere= "SELECT ABR_FILIERE,LIBELLE From enseignant e, appartenir_enseignant a, filiere f where e.ID_ENSEIGNANT = a.ID_ENSEIGNANT AND f.ID_FILIERE = a.ID_FILIERE AND e.ID_ENSEIGNANT=:ID_ENSEIGNANT;";
                  $resultatQueryAnnuaireEnseignantFiliere = $db->prepare($queryAnnuaireEnseignantFiliere);
                  $resultatQueryAnnuaireEnseignantFiliere->bindParam(":ID_ENSEIGNANT",$enseignant['ID_ENSEIGNANT'],PDO::PARAM_INT);
                  $resultatQueryAnnuaireEnseignantFiliere->execute();
                  $annuaireEnseignantFiliere=$resultatQueryAnnuaireEnseignantFiliere->fetchAll(PDO::FETCH_ASSOC); 
                ?>
                <td><?php foreach($annuaireEnseignantFiliere as $filiere) { echo $filiere['ABR_FILIERE']." "."<span style=\"display:none\">". $filiere['LIBELLE'] . "</span>";; }  ?></td>
                <td><?php echo $enseignant['EMAIL']?></td>
                <td><?php echo "0".$enseignant['TELEPHONE']?></td>
              </tr>
            <?php }?>

        </table>
        <table style="display:none" id="tableAdministrateurs">

            <tr>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Email</th>
              <th>Telephone</th>
            </tr>

            <?php foreach($annuaireAdministrateur as $administrateur){ ?>
              <tr>
                <td><?php echo $administrateur['NOM']?></td>
                <td><?php echo $administrateur['PRENOM']?></td>
                <td><?php echo $administrateur['EMAIL']?></td>
                <td><?php echo "0".$administrateur['TELEPHONE']?></td>
              </tr>
            <?php }?>

        </table>

  </main>

 </div>

</section>

<!----------x----------FOOTER----------------------x-->
<?php  require_once('./includesPhp/footer.php');?>

<script>
  // recuperation de la description de l'utilisateur authentifie pour faire le changement de champ d'étudiant cne à ppr pour les enseignants et les professeurs
  var userDescription = "<?php echo $_SESSION['DESCRIPTION']?>";
  // **********************************************************************************************************************************************************//
</script>
<!-- External JS -->
<script src="js/AnnuaireMain.js"></script>
<script src="js/AnnuaireSearch2.js"></script>
<script src="js/SearchKeyUpFuncs.js"></script>

<style>

table{
  font-weight:bold;
}

</style>

</body>
</html>