<?php
	// connecxion a la bd et la selection de tous les filieres pour permettre aux etudiants de choisir leurs filieres
	require_once('../configConn/conn.php');
    $consulter = "SELECT * FROM filiere";
    $resultatConsulter = $db->prepare($consulter);
    $resultatConsulter->execute();
	$data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);
	// Scripts d'inscription 
	
	require_once ('../Etudiant/php/SignUp.php');
	require_once ('../Enseignant/php/SignUp.php');
	require_once ('../Administrateur/php/SignUp.php');


?>

<h2 style="padding-top:50px;"> Annuaire ESTO </h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="" method="POST">
			<h1 style="margin-bottom:-40px;"> <pre> Créer un compte</pre></h1>
			<span id="error" style="color:#ed2d2d; margin-bottom:20px; font-size:25px;">
						<?php		
						if(isset($erreur))
						{
							echo $erreur;

							//echo "<script>alert('".$erreur."')</script>";
						}
						?>			
			</span>
			<span id="success" style="color:#28a745; margin-bottom:20px; font-size:25px;">
			<?php		
						if(isset($success))
						{
							echo $success;
							//echo "<script>alert('".$success."')</script>";
						}
						?>	
			</span>
			<input type="text" id="cne" name="cne" pattern=".{10,}" maxlength="10" title="EX: 10 caracteres H13*****" placeholder="CNE" required autocomplete="on"/>
			<input type="text" id="nom" name="nom"  placeholder="Nom" required autocomplete="on" />
			<input type="text" id="prenom" name="prenom" placeholder="Prénom" required autocomplete="on" />
			<input type="email" id="email" name="email" placeholder="Email" required autocomplete="on" />
			<input type="tel" id="tel" maxlength="10" name="tel" pattern=".{10,}" placeholder="Numero de telephone" required />
			<label style="font-size:12px; text-align:left;" id="filiereLabel" for="filiere">utiliser CTRL pour choisir plusieur filieres</label>
			<select name="filiere"id="filiere" required>
			<?php 	foreach($data as $filiere){ ?>
				<option value=<?php  echo $filiere['ID_FILIERE'] ?> id=<?php  echo $filiere['ID_FILIERE'] ?>><?php echo $filiere['ABR_FILIERE'] ?></option>
			<?php } ?>
			</select>	
		
			<input type="password" name="mdp" id="mdp" placeholder="Mot de passe" pattern=".{5,}" title="5 caractere min" required />
			<input type="password" id="Cmdp" name="Cmdp" placeholder="Confirmation de Mot de passe" pattern=".{5,}" title="5 caractere min" required />		
			<button id="SignUp" name="SignUpEtudiant">S'inscrire</button>
		</form>
</div>
