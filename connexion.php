<?php 
	session_start();
				if(isset($_POST['mail']) AND isset($_POST['pass']))
				{
					require_once("includes/connexion.php");
					$mai=mysql_real_escape_string($_POST['mail']);
					$mail=strtolower($mai);
					$md=$_POST['pass'];
					$mdp=sha1($md);
					if($mail!=NULL AND $mdp!=NULL)
					{								
						$sql="SELECT id, mail, mdp, active FROM compte_etudiant WHERE mail='$mail'";
						$req=mysql_query($sql);				
						$ligne=mysql_fetch_assoc($req);
						
						$mail2=$ligne['mail'];
						$mdp2=$ligne['mdp']; 
						$id=$ligne['id'];						
						if($mail == $mail2 AND $mdp == $mdp2 AND $ligne['active']==1)
						{
							$_SESSION['mail']=$mail;
							$_SESSION['id']=$id;
								
							$reqv=mysql_query('SELECT nom, prenom FROM compte_etudiant WHERE id='.$_SESSION['id']);
							$donv=mysql_fetch_assoc($reqv);
							$_SESSION['nomURL'] = $donv['nom'];
							$_SESSION['prenomURL'] = $donv['prenom'];
							header('Location:accueil-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde');
							exit;
						}else if($mail == $mail2 AND $mdp == $mdp2 AND $ligne['active']==0){
							echo 'Vous n\'avez pas validé votre inscription par mail.
							Allez sur votre adresse : '.$mail;
							require_once('includes/confirm_inscription.php');
							mail_confirmation($mail);
						}else{
							echo "Mauvaise adresse mail ou mot de passe !<br>";
							echo '<a href="new-pass.bde">Mot de passe perdu ?</a>';
						}
					}
				}
				if(isset($_GET['t']) AND !empty($_GET['t']) AND (int)$_GET['t']===1)
					echo 'Votre inscription a bien été validée. Vous pouvez vous connecter.';
 ?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("includes/head.php");			
		?>
	</head>
	<body class="label">
	<div id="global">
		<div id="middle">
		<h3>Connexion</h3>
			<form method="post" action="connexion.php" name="contact">
				<table>
					<tr><td><label>E-mail :</label></td><td><input type="text" name="mail"></td></tr>
					<tr><td><label>Mot de passe :</label></td><td><input type="password" name="pass"></td></tr>
					<tr><td></td><td><input type="submit" value="Connexion"></td></tr>				
				</table>
			</form>
			<br><br><p class="centre"><a href="index.php" class="foo">Retour</a></p><br><br><br>
		</div>	
		<?php require_once("includes/footer.php"); ?>
		</div>
	</body>
</html>
