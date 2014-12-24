<?php
	session_start(); 
	if(!isset($_SESSION['id'])) header('location:index.php');
	require_once("includes/connexion.php");
?>
<!DOCTYPE html>
<html>
<head>
<?php
	require_once("includes/head.php");
?>
</head>
<body>
<div id="global">
<div id="middle">
<p class="centre">
<?php
	echo '
	<a href="commander-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde" class="foo">Commander</a><br><br>
	<a href="recapitulatif-commandes-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde" class="foo">Récapitulatif</a><br><br>
	<a href="administration-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde" class="foo">Modifier profil</a><br><br>
	<a href="deconnexion.php" class="foo2">Déconnexion</a><br>';
?>
</p>
</div>
<?php require_once("includes/footer.php"); ?>
</div>
</body>
</html>
