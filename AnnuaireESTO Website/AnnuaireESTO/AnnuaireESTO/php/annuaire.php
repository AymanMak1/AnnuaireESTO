<?php 
    // Annuaire Etudiants
      if(isset($_SESSION['ID_ETUDIANT'])){
        $queryAnnuaireEtudiant= "SELECT * FROM etudiant e, filiere f where f.ID_FILIERE = e.ID_FILIERE AND ID_ETUDIANT !=".$_SESSION['ID_ETUDIANT'];
      }else{
        $queryAnnuaireEtudiant= "SELECT * FROM etudiant e, filiere f where f.ID_FILIERE = e.ID_FILIERE";
      }
    
      $resultatQueryAnnuaireEtudiant = $db->prepare($queryAnnuaireEtudiant);
      $resultatQueryAnnuaireEtudiant->execute();
      $annuaireEtudiant= $resultatQueryAnnuaireEtudiant->fetchAll(PDO::FETCH_ASSOC);  
    // Annuaire Administrateurs
    if(isset($_SESSION['ID_ADMINISTRATEUR'])){
      $queryAnnuaireAdministrateur= "SELECT * FROM administrateur WHERE ID_ADMINISTRATEUR !=".$_SESSION['ID_ADMINISTRATEUR'];
    }else{
      $queryAnnuaireAdministrateur= "SELECT * FROM administrateur";
    }
      $resultatQueryAnnuaireAdministrateur = $db->prepare($queryAnnuaireAdministrateur);
      $resultatQueryAnnuaireAdministrateur->execute();
      $annuaireAdministrateur= $resultatQueryAnnuaireAdministrateur->fetchAll(PDO::FETCH_ASSOC);  

   // Annuaire Enseignants

      /*$queryAnnuaireEnseignant= " select NOM,PRENOM,ABR_FILIERE,EMAIL,TELEPHONE From enseignant e, 
      appartenir_enseignant a, filiere f where e.ID_ENSEIGNANT = a.ID_ENSEIGNANT AND f.ID_FILIERE = a.ID_FILIERE;";*/
      if(isset($_SESSION['ID_ENSEIGNANT'])){
        $queryAnnuaireEnseignant= "SELECT * FROM enseignant WHERE ID_ENSEIGNANT !=".$_SESSION['ID_ENSEIGNANT'];
      }else{
        $queryAnnuaireEnseignant= "SELECT * FROM enseignant";
      }

      $resultatQueryAnnuaireEnseignant = $db->prepare($queryAnnuaireEnseignant);
      $resultatQueryAnnuaireEnseignant->execute();
      $annuaireEnseignant=$resultatQueryAnnuaireEnseignant->fetchAll(PDO::FETCH_ASSOC);  

      

?>