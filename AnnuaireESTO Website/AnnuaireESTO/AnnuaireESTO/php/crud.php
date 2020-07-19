<?php

//Suppresion 

if(isset($_GET['deleteEtudiant'])){

    $ID_ETUDIANT = $_GET['deleteEtudiant'];
        $deleteQuery = "DELETE FROM etudiant WHERE ID_ETUDIANT=?";
        $resultdeleteQuery = $db->prepare($deleteQuery);
        $resultdeleteQuery->execute([$ID_ETUDIANT ]);
        $success= "l'etudiant a été bien supprimé";
        header("Location:CrudUsers.php?successMsg=".$success);



}
if(isset($_GET['deleteEnseignant'])){

    $ID_ENSEIGNANT = $_GET['deleteEnseignant'];

    $deleteQuery = "DELETE FROM enseignant WHERE ID_ENSEIGNANT=?";
    $resultdeleteQuery = $db->prepare($deleteQuery);
    $resultdeleteQuery->execute([$ID_ENSEIGNANT]);

    $count =   $resultdeleteQuery->rowCount();
    
    $deleteFiliereQuery = "DELETE FROM appartenir_enseignant WHERE ID_ENSEIGNANT=?";
    $resultdeleteFiliereQuery = $db->prepare($deleteFiliereQuery);
    $resultdeleteFiliereQuery->execute([$ID_ENSEIGNANT]);

    $success= "l'enseignant a été bien supprimé";
    header("Location:CrudUsers.php?successMsg=".$success);
}

// Confirm Inscription

if(isset($_GET['confirmEtudiant'])){   

    $Confirmed=1;
    $ID_ETUDIANT = $_GET['confirmEtudiant'];

    $confirmQuery = "UPDATE etudiant SET CONFIRMED=? WHERE ID_ETUDIANT=?";
    $resultConfirmQuery = $db->prepare($confirmQuery);
    $resultConfirmQuery->execute([$Confirmed,$ID_ETUDIANT]);

    $success= "vous avez confirmé l'inscription de l'étudiant";
    header("Location:CrudUsers.php?successMsg=".$success);
}
if(isset($_GET['confirmEnseignant'])){  

    $Confirmed=1;
    $ID_ENSEIGNANT = $_GET['confirmEnseignant'];
    
    $confirmQuery = "UPDATE enseignant SET CONFIRMED=? WHERE ID_ENSEIGNANT=?";
    $resultConfirmQuery = $db->prepare($confirmQuery);
    $resultConfirmQuery->execute([$Confirmed,$ID_ENSEIGNANT]);

    $success= "vous avez confirmé l'inscription de l'enseignant";
    header("Location:CrudUsers.php?successMsg=".$success);
}

/***************** l'ajout ***********************/ 

// l'ajout des etudiants
if(isset($_POST['CrudAddEtudiant'])){
    try{
  
                $Cne = htmlspecialchars($_POST['cne']);
                $Nom = htmlspecialchars($_POST['nom']);    
                $Prenom = htmlspecialchars($_POST['prenom']);
                $Description="Etudiant";    
                $Email = htmlspecialchars($_POST['email']);
                $Tel = "0".htmlspecialchars($_POST['tel']);  
                $ID_Filiere = htmlspecialchars($_POST['filiere']);
                $MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));
                if(!empty($_POST['cne']) OR !empty($_POST['nom']) OR !empty($_POST['prenom']) OR !empty($_POST['email']) OR !empty($_POST['tel'])
                OR !empty($_POST['filiere']) OR !empty($_POST['mdp']))
                {
             
                    if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ) 
                    {
                  
                    if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                    {
             
                        $reqmail = $db->prepare("SELECT e.EMAIL,en.EMAIL,a.EMAIL FROM etudiant e ,enseignant en,administrateur a WHERE e.EMAIL = ?");
                        $reqmail->execute([$Email]);
                        $mailexist = $reqmail->rowCount();
       
                            if($mailexist == 0) {
                                $reqCne = $db->prepare("SELECT * FROM etudiant WHERE CNE = ?");
                                $reqCne->execute([$Cne]);
                                $Cneexist = $reqCne->rowCount();
                                if($Cneexist == 0) {
                                
                                        $stmt=$db->prepare("insert into etudiant(ID_FILIERE,CNE,NOM,PRENOM,DESCRIPTION,EMAIL,TELEPHONE,MOTDEPASSE)
                                         values (:ID_FILIERE,:CNE,:NOM,:PRENOM,:DESCRIPTION,:EMAIL,:TELEPHONE,:MOTDEPASSE)");
                                        $stmt->bindParam(':ID_FILIERE',$ID_Filiere, PDO::PARAM_INT);
                                        $stmt->bindParam(':CNE', $Cne,PDO::PARAM_STR);
                                        $stmt->bindParam(':NOM',$Nom,PDO::PARAM_STR);
                                        $stmt->bindParam(':PRENOM',$Prenom,PDO::PARAM_STR);
                                        $stmt->bindParam(':DESCRIPTION',$Description,PDO::PARAM_STR);
                                        $stmt->bindParam(':EMAIL',$Email,PDO::PARAM_STR);
                                        $stmt->bindParam(':TELEPHONE',$Tel,PDO::PARAM_INT);
                                        $stmt->bindParam(':MOTDEPASSE',$MotDePasse,PDO::PARAM_STR);
                                        $stmt->execute();
                                        /*
                                        $stmt->execute(array(
                                            ':ID_FILIERE' =>$ID_Filiere,
                                            ':CNE' =>$Cne,	
                                            ':NOM' =>$Nom,
                                            ':PRENO,' =>$Prenom,	
                                            ':DESCRIPTION' =>$Description,
                                            ':EMAIL' =>$Email,	
                                            ':TELEPHONE' =>$Tel,
                                            ':MOTDEPASSE' =>$MotDePasse
                                            ));
                                        */
                                        $db->commit();
                                       $success="Le Compte a été bien créé !"; 
                                       echo "<script type='text/javascript'>alert('$success'); window.location.href='CrudUsers.php';</script>";
                                      // header('Location: '.$_SERVER['PHP_SELF']);
                                      //header("Location:CrudUsers.php");
                              
                             
                              }else{
                                $erreur="Cne deja existe !"; 
                                echo "<script type='text/javascript'>alert('$erreur');</script>";
                              } 
                            }
                        else
                        {
                            $erreur="Adress email deja existe !";
                            echo "<script type='text/javascript'>alert('$erreur');</script>";
                        }
                    }else
                    {
                        $erreur="Votre adresse mail n\'est pas valide !";
                        echo "<script type='text/javascript'>alert('$erreur');</script>";
                    }
                    }else{
    
                    }
                }else
                {
                    $erreur="Tous les champs doivent être complétés !";
                    echo "<script type='text/javascript'>alert('$erreur');</script>";
                }

    }catch(PDOException $e){
        echo $e->getMessage();
        $db->rollBack();
    }

}

// l'ajout des enseignant
if(isset($_POST['CrudAddEnseignant'])) 
{ 
    try{
            $Ppr = htmlspecialchars($_POST['ppr']);
            $Nom = htmlspecialchars($_POST['nom']);    
            $Prenom = htmlspecialchars($_POST['prenom']);
            $Description="Enseignant";    
            $Email = htmlspecialchars($_POST['email']);
            $Tel = "0". htmlspecialchars($_POST['tel']);  
            $MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));
            if(!empty($_POST['ppr']) OR !empty($_POST['nom']) OR !empty($_POST['prenom']) OR !empty($_POST['email']) OR !empty($_POST['tel'])
            OR !empty($_POST['mdp']))
            {
         
                if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ) 
                {
              
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                    $reqPpr = $db->prepare("SELECT * FROM enseignant WHERE PPR_ENSEIGNANT = ?");
                    $reqPpr->execute([$Ppr]);
                    $Pprexist = $reqPpr->rowCount();
                    if($Pprexist == 0) {
                        $reqmail = $db->prepare("SELECT e.EMAIL,en.EMAIL,a.EMAIL FROM etudiant e ,enseignant en,administrateur a WHERE en.EMAIL = ?");
                        $reqmail->execute([$Email]);
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0) {
                                    $stmt=$db->prepare("insert into enseignant(PPR_Enseignant,NOM,PRENOM,DESCRIPTION,EMAIL,TELEPHONE,MOTDEPASSE)
                                     values (:PPR_ENSEIGNANT,:NOM,:PRENOM,:DESCRIPTION,:EMAIL,:TELEPHONE,:MOTDEPASSE)");
                                    $stmt->bindParam(':PPR_ENSEIGNANT', $Ppr);
                                    $stmt->bindParam(':NOM',$Nom,PDO::PARAM_STR);
                                    $stmt->bindParam(':PRENOM',$Prenom,PDO::PARAM_STR);
                                    $stmt->bindParam(':DESCRIPTION',$Description,PDO::PARAM_STR);
                                    $stmt->bindParam(':EMAIL',$Email,PDO::PARAM_STR);
                                    $stmt->bindParam(':TELEPHONE',$Tel,PDO::PARAM_INT);
                                    $stmt->bindParam(':MOTDEPASSE',$MotDePasse,PDO::PARAM_STR);
                                    $stmt->execute();
                                    $db->commit();
                                    // TRAITEMENT DE LA SELECTION MULTIPLE (FILIERE)
                                    $queryIDFetch = $db->query("SELECT ID_ENSEIGNANT FROM enseignant WHERE PPR_ENSEIGNANT='$Ppr'");
                                    $stmtIDFetch= $queryIDFetch->fetch();
                                    $ID_ENSEIGNANT = $stmtIDFetch['ID_ENSEIGNANT'];
                                    $Filiere =$_POST['filieres'];
                                    // BOUCLE POUR OBTENIR LES ID DE TOUS LES FILIERES SELECTIONES PAR L'ENSEIGNANT
                                    foreach($Filiere as $ID){
                                        $stmt2=$db->prepare("INSERT INTO appartenir_enseignant(ID_FILIERE,ID_ENSEIGNANT)
                                        values (:ID_FILIERE, :ID_ENSEIGNANT)");
                                       $stmt2->bindParam(':ID_FILIERE', $ID,PDO::PARAM_INT);
                                       $stmt2->bindParam(':ID_ENSEIGNANT',$ID_ENSEIGNANT,PDO::PARAM_INT);
                                       $stmt2->execute();
                                      
                                    }
                                   // $db->commit();
                                    //MESSAGE DE REUSSITE
                                    $success="Le Compte a été bien créé !"; 
                                    echo "<script type='text/javascript'>alert('$success'); window.location.href='CrudUsers.php';</script>";
                          }else{
                            $erreur="Adress email deja existe !";
                           echo "<script type='text/javascript'>alert('$erreur');</script>";
                          } 
                    } 
                    else
                    {
                        $erreur="Ppr deja existe !"; 
                        echo "<script type='text/javascript'>alert('$erreur');</script>";
                    }
                }else
                {
                    $erreur="Votre adresse mail n\'est pas valide !";
                    echo "<script type='text/javascript'>alert('$erreur');</script>";
                }
                }else{

                }
            }else
            {
                $erreur="Tous les champs doivent être complétés !";
                echo "<script type='text/javascript'>alert('$erreur');</script>";
            }
    
    
 }catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
 }
}



// CRUD ADMIN : Modification DES PROFILS

if(isset($_POST['CrudEditEtudiant'])){
    $ID_ETUDIANT = htmlspecialchars($_POST['IDEtudiant']);  
    $Cne = htmlspecialchars($_POST['EditCne']);  
    $Nom = htmlspecialchars($_POST['EditNom']);    
    $Prenom = htmlspecialchars($_POST['EditPrenom']);
    $Email = htmlspecialchars($_POST['EditEmail']);
    $ID_Filiere = htmlspecialchars($_POST['EditFiliere']);
    $Tel = substr(htmlspecialchars($_POST['EditTel']), 1);  
    $MotDePasse = htmlspecialchars(hash("sha512",$_POST['EditMdp']));
    try{
        if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ){
          
            if(filter_var($Email, FILTER_VALIDATE_EMAIL))
            {
                           if(!empty($_POST['EditMdp'])){
                               $stmt=$db->prepare("UPDATE etudiant SET ID_FILIERE=?, CNE=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?, MOTDEPASSE=? where ID_ETUDIANT=?");
                               $stmt->execute([$ID_Filiere,$Cne,$Nom,$Prenom,$Email,$Tel,$MotDePasse,$ID_ETUDIANT]);
                               $db->commit();
                               //MESSAGE DE REUSSITE
                              $success="Le Compte a été bien modifie !";
                              echo "<script type='text/javascript'>alert('$success'); window.location.href='CrudUsers.php';</script>";
                       
                           }else{
                               $stmt=$db->prepare("UPDATE etudiant SET ID_FILIERE=?, CNE=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=? where ID_ETUDIANT=?");
                               $stmt->execute([$ID_Filiere,$Cne,$Nom,$Prenom,$Email,$Tel,$ID_ETUDIANT]);
                               $db->commit();
                               //MESSAGE DE REUSSITE
                               $success="Le Compte a été bien modifie !";
                               echo "<script type='text/javascript'>alert('$success'); window.location.href='CrudUsers.php';</script>";
                           }          
                   }else{
                       $erreur="Votre adresse mail n\'est pas valide !";
                       echo "<script type='text/javascript'>alert('$erreur'); window.location.href='CrudUsers.php';</script>";
                   }
       }else{
           $erreur="Votre nom ou prenom sont pas valide !";
           echo "<script type='text/javascript'>alert('$erreur'); window.location.href='CrudUsers.php';</script>";
       }
     
    }catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
    }   

}elseif(isset($_POST['CrudEditEnseignant'])){
    $ID_ENSEIGNANT = htmlspecialchars($_POST['IDEnseignant']);  
    $Ppr = htmlspecialchars($_POST['EditPpr']);  
    $Nom = htmlspecialchars($_POST['EditNomEns']);    
    $Prenom = htmlspecialchars($_POST['EditPrenomEns']);
    $Email = htmlspecialchars($_POST['EditEmailEns']);
    //$ID_Filiere = htmlspecialchars($_POST['EditFiliereEns']);
    $Tel = substr(htmlspecialchars($_POST['EditTelEns']), 1);  
    $MotDePasse = htmlspecialchars(hash("sha512",$_POST['EditMdpEns']));
    try{
        if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ){
          
            if(filter_var($Email, FILTER_VALIDATE_EMAIL))
            {
                           if(!empty($_POST['EditMdpEns'])){
                               $stmt=$db->prepare("UPDATE  enseignant  SET PPR_ENSEIGNANT=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?, MOTDEPASSE=? where ID_ENSEIGNANT=?");
                               $stmt->execute([$Ppr,$Nom,$Prenom,$Email,$Tel,$MotDePasse,$ID_ENSEIGNANT]);
                               $db->commit();
                               $deleteFiliereQuery = "DELETE FROM appartenir_enseignant WHERE ID_ENSEIGNANT=?";
                               $resultdeleteFiliereQuery = $db->prepare($deleteFiliereQuery);
                               $resultdeleteFiliereQuery->execute([$ID_ENSEIGNANT]);

                               $Filieres =$_POST['EditFiliereEns'];
   
                               // BOUCLE POUR OBTENIR LES ID DE TOUS LES FILIERES SELECTIONES PAR L'ENSEIGNANT
                               foreach($Filieres as $ID){
                                   $stmt=$db->prepare("INSERT INTO appartenir_enseignant(ID_FILIERE,ID_ENSEIGNANT)
                                   values (:ID_FILIERE, :ID_ENSEIGNANT)");
                                   $stmt->bindParam(':ID_FILIERE', $ID,PDO::PARAM_INT);
                                   $stmt->bindParam(':ID_ENSEIGNANT',$ID_ENSEIGNANT,PDO::PARAM_INT);
                                   $stmt->execute();
                               }
                               //MESSAGE DE REUSSITE
                               
                              $success="Votre Compte a été bien modifie !";
                             echo "<script type='text/javascript'>alert('$success'); window.location.href='CrudUsers.php';</script>";
                            
                           }else{
                               $stmt=$db->prepare("UPDATE enseignant SET PPR_ENSEIGNANT=?, NOM=?, PRENOM=?, EMAIL=?, TELEPHONE=?
                                where ID_ENSEIGNANT=?");
                               $stmt->execute([$Ppr,$Nom,$Prenom,$Email,$Tel,$ID_ENSEIGNANT]);
                               $db->commit();
                               $deleteFiliereQuery = "DELETE FROM appartenir_enseignant WHERE ID_ENSEIGNANT=?";
                               $resultdeleteFiliereQuery = $db->prepare($deleteFiliereQuery);
                               $resultdeleteFiliereQuery->execute([$ID_ENSEIGNANT]);

                               $Filieres =$_POST['EditFiliereEns'];
                    
                               // BOUCLE POUR OBTENIR LES ID DE TOUS LES FILIERES SELECTIONES PAR L'ENSEIGNANT
                               foreach($Filieres as $ID){
                                   $stmt=$db->prepare("INSERT INTO appartenir_enseignant(ID_FILIERE,ID_ENSEIGNANT)
                                   values (:ID_FILIERE, :ID_ENSEIGNANT)");
                                   $stmt->bindParam(':ID_FILIERE', $ID,PDO::PARAM_INT);
                                   $stmt->bindParam(':ID_ENSEIGNANT',$ID_ENSEIGNANT,PDO::PARAM_INT);
                                   $stmt->execute();
                               }
                               
                               //MESSAGE DE REUSSITE
                               $success="Le Compte a été bien modifie !";
                              echo "<script type='text/javascript'>alert('$success'); window.location.href='CrudUsers.php';</script>";
                           }  


    
                   }else{
                       $erreur="Votre adresse mail n\'est pas valide !";
                       echo "<script type='text/javascript'>alert('$erreur'); window.location.href='CrudUsers.php';</script>";
                   }
       }else{
           $erreur="Votre nom ou prenom sont pas valide !";
           echo "<script type='text/javascript'>alert('$erreur'); window.location.href='CrudUsers.php';</script>";
       }
     
    }catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
    }   
}

?>