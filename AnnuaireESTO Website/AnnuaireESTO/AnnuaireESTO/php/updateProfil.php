<?php

if(isset($_POST['Confirmer'])){
//$db->beginTransaction();
$Nom = htmlspecialchars($_POST['nom']);    
$Prenom = htmlspecialchars($_POST['prenom']);
$Email = htmlspecialchars($_POST['email']);
$Tel = htmlspecialchars($_POST['tel']);  
$MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));

switch($_SESSION['DESCRIPTION']){

    case 'Etudiant':
        try{
            $Cne = htmlspecialchars($_POST['cne']);
            $ID_Filiere = htmlspecialchars($_POST['filiere']);
            if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ){
              
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                               if(!empty($_POST['mdp'])){
                                   $stmt=$db->prepare("UPDATE etudiant SET ID_FILIERE=?, CNE=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?, MOTDEPASSE=? where ID_ETUDIANT=?");
                                   $stmt->execute([$ID_Filiere,$Cne,$Nom,$Prenom,$Email,$Tel,$MotDePasse,$_SESSION['ID_ETUDIANT']]);
                                   $db->commit();
                                   //MESSAGE DE REUSSITE
                                  $success="Votre Compte a été bien modifie !";
                                  //echo "<script>window.location.replace(\"http://www.w3schools.com\");</script>";
                               }else{
                                   $stmt=$db->prepare("UPDATE etudiant SET ID_FILIERE=?, CNE=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=? where ID_ETUDIANT=?");
                                   $stmt->execute([$ID_Filiere,$Cne,$Nom,$Prenom,$Email,$Tel,$_SESSION['ID_ETUDIANT']]);
                                   $db->commit();
                                   //MESSAGE DE REUSSITE
                                   $success="Votre Compte a été bien modifie !";

                               }          
                       }else{
                           $erreur="Votre adresse mail n\'est pas valide !";
                       }
           }else{
               $erreur="Votre nom ou prenom sont pas valide !";
           }
         
}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
}     
break;

    case 'Enseignant':
        try{
            $Ppr = htmlspecialchars($_POST['ppr']);
            if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ){
              
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                       if(strlen($Nom) >= 4 && strlen($Prenom) >= 4 ){
                               if(!empty($_POST['mdp'])){
                                   $stmt=$db->prepare("UPDATE  enseignant  SET PPR_ENSEIGNANT=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?, MOTDEPASSE=? where ID_ENSEIGNANT=?");
                                   $stmt->execute([$Ppr,$Nom,$Prenom,$Email,$Tel,$MotDePasse,$_SESSION['ID_ENSEIGNANT']]);
                                   $db->commit();
                                   //MESSAGE DE REUSSITE
                                  $success="Votre Compte a été bien modifie !";

                               }else{
                                   $stmt=$db->prepare("UPDATE enseignant SET PPR_ENSEIGNANT=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?
                                   where ID_ENSEIGNANT=?");
                                   $stmt->execute([$Ppr,$Nom,$Prenom,$Email,$Tel,$_SESSION['ID_ENSEIGNANT']]);
                                   $db->commit();
                           
                                   //MESSAGE DE REUSSITE
                                   $success="Votre Compte a été bien modifie !";
                               }
                                
                                $queryIDFetch = $db->query("SELECT ID_ENSEIGNANT FROM enseignant WHERE PPR_ENSEIGNANT='$Ppr'");
                                $stmtIDFetch= $queryIDFetch->fetch();
                                $ID_ENSEIGNANT = $stmtIDFetch['ID_ENSEIGNANT'];
                                // BOUCLE POUR OBTENIR LES ID DE TOUS LES FILIERES SELECTIONES PAR L'ENSEIGNANT
                                $Filiere =$_POST['filieres'];
                                foreach($Filiere as $ID){
                                    $stmt2=$db->prepare("UPDATE appartenir_enseignant SET ID_FILIERE=?, ID_ENSEIGNANT=?");
                                    $stmt2->execute([$ID,$ID_ENSEIGNANT]);
                                    
                                }

                            }else{
                                $erreur="Votre nom ou prenom sont trés court !";    
                            }
                       }else{
                           $erreur="Votre adresse mail n\'est pas valide !";
                       }
           }else{
               $erreur="Votre nom ou prenom sont pas valide !";
           }
         
}catch(PDOException $e){
    echo $e->getMessage();
  //  $db->rollBack();
}     
break;

    case 'Administrateur':
        try{
                $Ppr = htmlspecialchars($_POST['ppr']);
                 $db->beginTransaction();
                 $Ppr = htmlspecialchars($_POST['ppr']);
                 $MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));
                 if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ){
                   
                     if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                     {
                            if(strlen($Nom) >= 4 && strlen($Prenom) >= 4 ){
                                    if(!empty($_POST['mdp'])){
                                        $stmt=$db->prepare("UPDATE administrateur SET PPR_ADMINISTRATEUR=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?, MOTDEPASSE=? where ID_ADMINISTRATEUR=?");
                                        $stmt->execute([$Ppr,$Nom,$Prenom,$Email,$Tel,$MotDePasse,$_SESSION['ID_ADMINISTRATEUR']]);
                                        $db->commit();
                                        //MESSAGE DE REUSSITE
                                       $success="Votre Compte a été bien modifie !";
                                    }else{
                                        $stmt=$db->prepare("UPDATE administrateur SET PPR_ADMINISTRATEUR=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?
                                        where ID_ADMINISTRATEUR=?");
                                        $stmt->execute([$Ppr,$Nom,$Prenom,$Email,$Tel,$_SESSION['ID_ADMINISTRATEUR']]);
                                        $db->commit();
                                
                                        //MESSAGE DE REUSSITE
                                        $success="Votre Compte a été bien modifie !";
                                    }
    
     
                                 }else{
                                     $erreur="Votre nom ou prenom sont trés court !";    
                                 }
                            }else{
                                $erreur="Votre adresse mail n\'est pas valide !";
                            }
                }else{
                    $erreur="Votre nom ou prenom sont pas valide !";
                }
              
     }catch(PDOException $e){
         echo $e->getMessage();
         $db->rollBack();
     }     
    break;
   }
}

?>