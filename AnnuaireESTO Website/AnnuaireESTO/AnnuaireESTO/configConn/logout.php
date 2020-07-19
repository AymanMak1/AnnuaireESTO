<?php
session_start();
// LES CONDITIONS: POUR BIEN REDIGER L'UTILISATEUR A SON ESPACE D'IDENTIFICATION
if(isset($_SESSION['ID_ETUDIANT'])){
    unset($_SESSION);
    session_destroy();
    header("Location:../../SignUpLogin/Etudiant/SignUpLogin.php");
}elseif ($_SESSION['ID_ENSEIGNANT']) {
    unset($_SESSION);
    session_destroy();
    header("Location:../../SignUpLogin/Enseignant/SignUpLogin.php");
}else{
    unset($_SESSION);
    session_destroy();
    header("Location:../../SignUpLogin/Administrateur/SignUpLogin.php");
}
