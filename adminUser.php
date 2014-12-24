<?php
	session_start();
	if(!isset($_SESSION['id'])) header('location:index.php');
	else
	{
		$id_etudiant=$_SESSION['id'];
		require_once("includes/connexion.php");
		$sql="SELECT * FROM compte_etudiant WHERE id='$id_etudiant'";
		$req=mysql_query($sql);
		$ligne=mysql_fetch_assoc($req);
		$prenom=$ligne['prenom'];
		$nom=$ligne['nom'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once("includes/head.php"); ?>
		<script src="js.js">
		</script>
	</head>
	<body>
		<div id="global">
<div id="middle">
			<h3>Supprimer son compte</h3>
			<?php
				$id=$_SESSION['id'];
				echo 'Connecté en tant que : '.$prenom.' '.$nom.'<br><br>';
				//echo '<a href="effUser.php?section='.$id.'" onclick="return valid()" class="foo2">Supprimer Profil</a>';
				echo '<br><br><a href="modifier-mot-de-passe-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde" class="foo">Changer de mot de passe</a>';
			?>
			<br><br><br>
			<p class="centre">
				<a href="<?php echo 'accueil-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde'; ?>" class="foo">Retour</a><br><br>
				<a href="deconnexion.php" class="foo2">Déconnexion</a>
			</p>
</div>
			<?php require_once("includes/footer.php"); ?>
		</div>
	</body>
</html>
