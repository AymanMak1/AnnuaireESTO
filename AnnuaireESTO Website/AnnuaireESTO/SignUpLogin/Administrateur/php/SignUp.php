<?php
//require_once '../../configConn/conn.php';
try{
    //$db->beginTransaction();
    if(isset($_POST['SignUpAdministrateur'])) 
    {   
            $Ppr = htmlspecialchars($_POST['ppr']);
            $Nom = htmlspecialchars($_POST['nom']);    
            $Prenom = htmlspecialchars($_POST['prenom']);
            $Description="Administrateur";    
            $Email = htmlspecialchars($_POST['email']);
            $Tel = htmlspecialchars($_POST['tel']);  
            $MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));
            $CMotDePasse= htmlspecialchars(hash("sha512",$_POST['Cmdp']));
            if(!empty($_POST['ppr']) OR !empty($_POST['nom']) OR !empty($_POST['prenom']) OR !empty($_POST['email']) OR !empty($_POST['tel'])
            OR !empty($_POST['mdp']) OR !empty($_POST['Cmdp']))
            {
         
                if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ) 
                {
              
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                    $reqPpr = $db->prepare("SELECT * FROM administrateur a WHERE PPR_ADMINISTRATEUR = ?");
                    $reqPpr->execute([$Ppr]);
                    $Pprexist = $reqPpr->rowCount();
                    if($Pprexist == 0) {
                        $reqmail = $db->prepare("SELECT e.EMAIL,en.EMAIL,a.EMAIL FROM etudiant e ,enseignant en,administrateur a WHERE a.EMAIL = ?");
                        $reqmail->execute([$Email]);
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0) {

                         
                            if(strlen($Nom) >= 4 && strlen($Prenom) >= 4 ){
                                if($MotDePasse == $CMotDePasse){
                                    $stmt=$db->prepare("INSERT INTO administrateur(PPR_ADMINISTRATEUR,NOM,PRENOM,DESCRIPTION,EMAIL,TELEPHONE,MOTDEPASSE)
                                     values (:PPR_ADMINISTRATEUR,:NOM,:PRENOM,:DESCRIPTION,:EMAIL,:TELEPHONE,:MOTDEPASSE)");
                                    $stmt->bindParam(':PPR_ADMINISTRATEUR', $Ppr);
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
                                   $success="Votre Compte a été bien créé !";

                                }else{
                                    
                                   $erreur="Vos mots de passes ne correspondent pas !";
                                }
                            }else{
                                $erreur="Votre nom ou prenom sont trés court !";    
                            }
                          }else{
                            $erreur="Adress email déjà existe !";
                          } 
                        }
                    else
                    {
                        $erreur="Ppr déjà existe !"; 
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
