<!DOCTYPE html>
<html>
	<head>
		<?php require_once("includes/head.php"); ?>
	</head>
<body class="label">
<div id="global"><br>
<div id="middle">
<form method="post" action="enregistrement.php" name="contact" onsubmit="return verif()" >
<table>
	<tr><td><label>Nom : </label></td><td><input type="text" name="nom" ></td></tr>
	<tr><td><label>Prénom : </label></td><td><input type="text" name="prenom" ></td></tr>
	<tr><td><label>Promo : </label></td><td><input type="text" name="promo" placeholder="2013 à 2017"></td></tr>
	<tr><td><label>Mail (epsi) : </label></td><td><input type="email" name="mail" placeholder="adresse@epsi.fr"></td></tr>
	<tr><td><label>Mot de passe :</label></td><td><input type="password" name="mdp"></td></tr>
	<tr><td></td><td><input type="submit" value="Inscription" ></td></tr>
</table>
</form><br>
<?php
function randy()
{
    return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	mt_rand( 0, 0x0fff ) | 0x4000,
	mt_rand( 0, 0x3fff ) | 0x8000,
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
}

if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['promo']) AND isset($_POST['mail']) AND isset($_POST['mdp']))
{
	include("includes/connexion.php");
	$nom=mysql_real_escape_string($_POST['nom']);
	$prenom=mysql_real_escape_string($_POST['prenom']);
	$promo=mysql_real_escape_string($_POST['promo']);
	$mail=mysql_real_escape_string($_POST['mail']);
	
	$mail=strtolower($mail);
	$mdp=sha1($_POST['mdp']);
	$ip=$_SERVER["REMOTE_ADDR"];
	
	if($mail!=NULL AND $prenom!=NULL AND $promo!=NULL AND $mail!=NULL AND $mdp!=NULL)
	{
		if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $_POST['mail']))
		{
			$req=mysql_query("SELECT mail FROM compte_etudiant where mail='$mail'");
			if(mysql_num_rows($req)){
				echo '<script>alert("L\'adresse mail saisie est déjà enregistrée dans la base de données.\nL\'administrateur du site a donc déjà associé ';
				echo 'un compte à votre adresse mail.\nPour obtenir vos identifiants, saisissez votre adresse e-mail à la page suivante.");</script>';
				header( "refresh:1;url=new-pass.bde" );
			}else{
				$sql="INSERT INTO compte_etudiant (id, promo, mail, nom, prenom, ip, date_inscription, mdp) 
				VALUES ('', '$promo', '$mail', '$nom', '$prenom', '$ip', NOW(), '$mdp')";
				mysql_query($sql);
	
				require_once('includes/confirm_inscription.php');
				mail_confirmation($mail, $prenom, $nom);
	
				header( "refresh:5;url=connexion-interface.bde" );
				echo '<h4 style="color:green;">Vous êtes bien inscrits, vous devez confirmer votre inscription en
				allant voir vos mails. Vous allez être redirigé vers la page de login dans 5 secondes. Si ce n\'est pas le cas,<a href="connexion-interface.bde">Cliquez ici</a>.</h4>';
			}
		}
		else
		{
			echo "L'adresse mail saisie n'est pas valide";
		}
	}
}
?>
<p class="centre"><a href="index.php" class="foo">Retour</a></p>
</div>
<?php require_once("includes/footer.php"); ?>
</div>
</body>
</html>
