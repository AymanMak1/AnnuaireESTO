<?php
try{
    if(isset($_POST['LoginEtudiant'])){
        $Cne=htmlspecialchars($_POST['cneConn']);
        $Mdp= htmlspecialchars(hash("sha512",$_POST['mdpConn']));
        if(!empty($Cne) AND !empty($Mdp)){
            $requser = $db->prepare("SELECT * FROM etudiant WHERE CNE =:CNE AND MOTDEPASSE =:MOTDEPASSE");
            $requser->bindParam(':CNE',$Cne, PDO::PARAM_STR);
            $requser->bindParam(':MOTDEPASSE',$Mdp, PDO::PARAM_STR); ;
            $requser->execute();
            $userexist = $requser->RowCount();
            if($userexist == 1) {
                $userinfo = $requser->fetch();
                // LES VARIABLES DE SESSION
                $_SESSION['ID_ETUDIANT'] = $userinfo['ID_ETUDIANT'];
                $_SESSION['ID_FILIERE'] = $userinfo['ID_FILIERE'];
                $_SESSION['CNE'] = $userinfo['CNE']; 
                $_SESSION['NOM'] = $userinfo['NOM'];
                $_SESSION['PRENOM'] = $userinfo['PRENOM'];
                $_SESSION['DESCRIPTION'] = $userinfo['DESCRIPTION'];
                $_SESSION['EMAIL'] = $userinfo['EMAIL'];
                $_SESSION['TELEPHONE'] = $userinfo['TELEPHONE'];
                $_SESSION['MOTDEPASSE'] = $userinfo['MOTDEPASSE'];
                // Redirection vers l'espace d'annuaire
                header("Location:../../AnnuaireESTO/AnnuaireESTO.php");
            } else{                
                $erreur="Ce compte n'existe pas !";
            }
            
        }else
        {
            $erreur=" Tous les champs doivent etre remplir !";
        }
    }
}catch(PDOException $e){
    echo $e->getMessage();
}