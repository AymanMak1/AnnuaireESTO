<?php
	// Scripts de connexion
	session_start();
	require_once ('../Etudiant/php/Login.php');
	require_once ('../Administrateur/php/Login.php');
	require_once ('../Enseignant/php/Login.php');
?>
<div class="form-container sign-in-container">
		<form action="" method="POST">
			<h1 id="Description" style="margin-bottom:16px;">Chér étudiant</h1>
			<span id="error" style="color:#ed2d2d; margin-bottom:20px; font-size:25px;">
						<?php		
						if(isset($erreur))
						{
							echo $erreur;

							echo "<script>alert('".$erreur."')</script>";
						}
						?>			
			</span>
			<span id="success" style="color:#28a745; margin-bottom:20px; font-size:25px;">
			<?php		
						if(isset($success))
						{
							echo $success;
							echo "<script>alert('".$success."')</script>";
						}
						?>	
			</span>
			<input type="text" id="cneConn" name="cneConn" pattern=".{10,}" title="EX: 10 caracteres H13*****" placeholder="CNE" required />
			<input type="password" id="mdpConn" name="mdpConn" placeholder="Mot De Passe" required />		
			<button id="Login" name="LoginEtudiant">Se connecter</button>
		</form>
</div>