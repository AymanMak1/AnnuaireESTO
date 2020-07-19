<?php   
try{
    $db->beginTransaction(); // la transaction
    if(isset($_POST['SignUpEtudiant'])) // IF THE BUTTON IS CLICKED
    {
            // Recuperation des champs de formulaire
            $Cne = htmlspecialchars($_POST['cne']);
            $Nom = htmlspecialchars($_POST['nom']);    
            $Prenom = htmlspecialchars($_POST['prenom']);
            $Description="Etudiant";    
            $Email = htmlspecialchars($_POST['email']);
            $Tel = "0".htmlspecialchars($_POST['tel']);  
            $ID_Filiere = htmlspecialchars($_POST['filiere']);
            $MotDePasse = htmlspecialchars(hash("sha512",$_POST['mdp']));
            $CMotDePasse= htmlspecialchars(hash("sha512",$_POST['Cmdp']));
            // CHECK IF THE FIELDS ARE EMPTY (Le cas de navigateur ne supporte pas l'attribut required)
            if(!empty($_POST['cne']) OR !empty($_POST['nom']) OR !empty($_POST['prenom']) OR !empty($_POST['email']) OR !empty($_POST['tel'])
            OR !empty($_POST['filiere']) OR !empty($_POST['mdp']) OR !empty($_POST['Cmdp']))
            {
                // CHECK IF THE FIELDS NOM & PRENOM ARE STRING
                if(filter_var($Nom, FILTER_SANITIZE_STRING) || filter_var($Prenom, FILTER_SANITIZE_STRING) ) 
                {
               // CHECK IF THE FIELD EMAIL IS AN ACTUAL EMAIL
                if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                    // Verification si le mail deja existe
                    $reqmail = $db->prepare("SELECT e.EMAIL,en.EMAIL,a.EMAIL FROM etudiant e ,enseignant en,administrateur a WHERE e.EMAIL = ?");
                    $reqmail->execute([$Email]);
                    $mailexist = $reqmail->rowCount();
   
                        if($mailexist == 0) {
                            // Verification si le CNE deja existe
                            $reqCne = $db->prepare("SELECT * FROM etudiant WHERE CNE = ?");
                            $reqCne->execute([$Cne]);
                            $Cneexist = $reqCne->rowCount();
                            if($Cneexist == 0) {
                            // Verification si les champs nom & prenom sont moins de 4 caracteres
                            if(strlen($Nom) >= 4 && strlen($Prenom) >= 4 ){
                                if($MotDePasse == $CMotDePasse){
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
                                   $success="Votre Compte a été bien créé !";

                                }else{
                                    
                                   $erreur="Vos mots de passes ne correspondent pas !";
                                }
                            }else{
                                $erreur="Votre nom ou prenom sont trés court !";    
                            }
                          }else{
                            $erreur="Cne deja existe !"; 
                          } 
                        }
                    else
                    {
                        echo "<h1>sdfasda</h1>";
                        $erreur="Adress email deja existe !";
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
