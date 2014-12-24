<?php
	if(!isset($_GET['id'])) header('location:index.php');
	else
	{
		require_once("includes/connexion.php");
		$get=mysql_real_escape_string($_GET['id']);
		$ref=mysql_query("SELECT * FROM password WHERE alea='$get'");
		$don=mysql_fetch_assoc($ref);
		$mail_get=$don['mail_etudiant']; $get_get=$don['alea'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("includes/head.php");
		?>
		<script>
			function verif(mail, alea1, alea2)
			{
				if(document.forms['contact'].elements['mail'].value != mail)
				{
					alert('Vous n\'avez pas saisi votre adresse mail !');
					return false;
				}
				else if(alea1 != alea2)
				{
					alert('Vous essayez de me pirater vilain cochon !');
					return false;
				}			
				else return true;
			}
		</script>
	</head>
	<body class="label">
	<div id="global">
		<div id="middle">
			<h3>Renouvellement de mot de passe</h3>
			<form method="post" onsubmit="verif('<?php echo $mail_get; ?>', '<?php echo $get_get; ?>, '<?php echo $get; ?>')" action="new-pass2.php?id=<?php echo $get; ?>" name="contact">
				<table>
					<tr><td><label>Retapez votre e-mail :</label></td><td><input type="text" name="mail"></td></tr>
					<tr><td><label>Nouveau mot de passe :</label></td><td><input type="password" name="pass"></td></tr>
					<tr><td></td><td><input type="submit" value="Modifier"></td></tr>
				</table>
			</form>
			
			<?php
				if(isset($_POST['mail']) AND isset($_POST['pass']))
				{	$mai=htmlentities($_POST['mail'], ENT_QUOTES);
					$mail=strtolower($mai);
					$md=$_POST['pass'];
					$mdp=sha1($md);
					if($mail!=NULL AND $mdp!=NULL AND $get==$get_get AND $mail==$mail_get)
					{		
						require_once("includes/connexion.php");
						mysql_query("UPDATE compte_etudiant SET mdp='$mdp' WHERE mail='$mail_get'");
						mysql_query("DELETE FROM password WHERE mail_etudiant='$mail_get'");
						echo '<p style="color:red;font-size:1,1em;">Mot de passe bien modifié. Vous allez être redirigé dans 5 secondes.</p>';
						header('refresh: 5; url=connexion.php');
					}
					else
					{					
						echo 'PIRATE !';
					}
				}
			?>		
			<br><br><p class="centre"><a href="index.php" class="foo">Retour</a></p>
		</div>
		<?php require_once("includes/footer.php"); ?>
	</div>
	</body>
</html>