<?php
switch($_SESSION['DESCRIPTION']){
    case 'Etudiant':
      $queryPersonalInfos= "SELECT * FROM etudiant e, filiere f where f.ID_FILIERE = e.ID_FILIERE and ID_ETUDIANT =:ID_ETUDIANT ";
      $resultatQueryPersonalInfos = $db->prepare($queryPersonalInfos);
      $resultatQueryPersonalInfos->bindParam(':ID_ETUDIANT',$_SESSION['ID_ETUDIANT']);
      $resultatQueryPersonalInfos->execute();
      $userinfos= $resultatQueryPersonalInfos->fetch(PDO::FETCH_ASSOC);
    break;
    case 'Enseignant':
      $queryPersonalInfos= "SELECT * FROM enseignant where ID_ENSEIGNANT =:ID_ENSEIGNANT";
      $resultatQueryPersonalInfos = $db->prepare($queryPersonalInfos);
      $resultatQueryPersonalInfos->bindParam(':ID_ENSEIGNANT',$_SESSION['ID_ENSEIGNANT']);
      $resultatQueryPersonalInfos->execute();
      $userinfos= $resultatQueryPersonalInfos->fetch(PDO::FETCH_ASSOC);  
    break;
    case 'Administrateur':
      $queryPersonalInfos= "SELECT * FROM administrateur where ID_ADMINISTRATEUR =:ID_ADMINISTRATEUR";
      $resultatQueryPersonalInfos = $db->prepare($queryPersonalInfos);
      $resultatQueryPersonalInfos->bindParam(':ID_ADMINISTRATEUR',$_SESSION['ID_ADMINISTRATEUR']);
      $resultatQueryPersonalInfos->execute();
      $userinfos= $resultatQueryPersonalInfos->fetch(PDO::FETCH_ASSOC);  
    break;
  }
?>