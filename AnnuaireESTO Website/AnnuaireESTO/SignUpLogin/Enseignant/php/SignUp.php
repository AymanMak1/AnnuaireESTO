<?php
//require_once '../../configConn/conn.php';
try{
   
  
    if(isset($_POST['SignUpEnseignant'])) 
    {  
            $Ppr = htmlspecialchars($_POST['ppr']);
            $Nom = htmlspecialchars($_POST['nom']);    
            $Prenom = htmlspecialchars($_POST['prenom']);
            $Description="Enseignant";    
            $Email = htmlspecialchars($_POST['email']);
            $Tel = "0". htmlspecialchars($_POST['tel']);  
            $MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));
            $CMotDePasse= htmlspecialchars(hash("sha512",$_POST['Cmdp']));
            if(!empty($_POST['ppr']) OR !empty($_POST['nom']) OR !empty($_POST['prenom']) OR !empty($_POST['email']) OR !empty($_POST['tel'])
            OR !empty($_POST['mdp']) OR !empty($_POST['Cmdp']))
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
                            if(strlen($Nom) >= 4 && strlen($Prenom) >= 4 ){
                                if($MotDePasse == $CMotDePasse){
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
                                   $success="Votre Compte a été bien créé !";

                                }else{
                                    
                                   $erreur="Vos mots de passes ne correspondent pas !";
                                }
                            }else{
                                $erreur="Votre nom ou prenom sont trés court !";    
                            }
                          }else{
                            $erreur="Adress email deja existe !";
                          } 
                        }
                    else
                    {
                        $erreur="Ppr deja existe !"; 
                    }
                }else
                {
                    $erreur="Votre adresse mail n\'est pas valide !";
                }
                }else{

                }
            }else
            {
                $erreur="Tous les champs doivent être complétés !";
            }
    
    }
}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
}

?>
