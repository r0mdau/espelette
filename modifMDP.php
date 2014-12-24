<?php
	session_start(); 
	if (!isset($_SESSION['id'])) header('location:index.php');
	else
	{
		require_once("includes/connexion.php");
		$req=mysql_query('SELECT * FROM compte_etudiant WHERE id='.$_SESSION['id']);
		$ligne=mysql_fetch_assoc($req);
		$prenom = $ligne['prenom'];
		$nom = $ligne['nom'];
	}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once("includes/head.php"); ?>
</script>
</head>
<body>
<div id="global">
<h3>Modifier mot de passe</h3>
<form method="post" action="modifMDP.php">
<table>
	<tr><td><p>Nouveau mot de passe</p></td><td>
		<input type="password" name="mdp" >
	</td></tr>
	<tr><td><p>Confirmation</p></td><td>
		<input type="password" name="mdp2" >
		<input type="submit" value="Changer" >
	</td></tr>
</table>
</form>
<?php
	if (!empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND isset($_POST['mdp']) AND isset($_POST['mdp2']))
	{
		if($_POST['mdp'] == $_POST['mdp2']){
			$newMDP = sha1($_POST['mdp']);
			mysql_query('UPDATE compte_etudiant SET mdp = \''.$newMDP.'\' WHERE id = '.$_SESSION['id']);
			header('location:accueil-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde');
			exit;
		}
		else{
			echo '<span style="font-size:0.7em;color:red;font-weight:bold;">Les deux mots de passe saisis ne sont pas identiques. Veuillez recommencer.</span>';
		}
	}
?>

<p class="centre">
	<a href="<?php echo 'administration-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde'; ?>" class="foo">Retour</a><br><br>
	<a href="deconnexion.php" class="foo2">Déconnexion</a>
</p><br>
<?php require_once("includes/footer.php"); ?>
</div>
<script src="js.js"></script>
</body>
</html>
