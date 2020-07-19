<?php

try{
    if(isset($_POST['LoginAdministrateur'])){
   
        $Ppr=htmlspecialchars($_POST['pprConn']);
        $Mdp= htmlspecialchars(hash("sha512",$_POST['mdpConn']));
        if(!empty($Ppr) AND !empty($Mdp)){
            $requser = $db->prepare("SELECT * FROM administrateur WHERE PPR_ADMINISTRATEUR =:PPR_ADMINISTRATEUR AND MOTDEPASSE =:MOTDEPASSE");
            $requser->bindParam(':PPR_ADMINISTRATEUR',$Ppr, PDO::PARAM_STR);
            $requser->bindParam(':MOTDEPASSE',$Mdp, PDO::PARAM_STR);
            $requser->execute();
            $userexist = $requser->RowCount();
            if($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['ID_ADMINISTRATEUR'] = $userinfo['ID_ADMINISTRATEUR'];
                $_SESSION['PPR_ADMINISTRATEUR'] = $userinfo['PPR_ADMINISTRATEUR']; 
                $_SESSION['NOM'] = $userinfo['NOM'];
                $_SESSION['PRENOM'] = $userinfo['PRENOM'];
                $_SESSION['DESCRIPTION'] = $userinfo['DESCRIPTION'];
                $_SESSION['EMAIL'] = $userinfo['EMAIL'];
                $_SESSION['TELEPHONE'] = $userinfo['TELEPHONE'];
                $_SESSION['MOTDEPASSE'] = $userinfo['MOTDEPASSE'];
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