<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("includes/head.php");
			function alea()
			{
			    return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
				mt_rand( 0, 0x0fff ) | 0x4000,
				mt_rand( 0, 0x3fff ) | 0x8000,
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
			}
		?>
		<script>
			function valid()
			{
				var reg = /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/ ;
				var mail = reg.test(document.forms['contact'].elements['mail'].value);
				if (!mail)
				{
					alert('L\'adresse mail saisie n\'est pas valide.');
					return false;
				}
				else return true;
			}
		</script>
	</head>
	<body class="label">
	<div id="global">
		<div id="middle">
		<h3>Envoi mot de passe</h3>
			<form method="post" name="contact" onsubmit="valid()">
				<table style="margin-left:70px;">
					<tr><td><label>E-mail :</label></td><td><input type="text" name="mail"></td></tr>
					<tr><td></td><td><input type="submit" value="Envoyer"></td></tr>
				</table>
			</form>
			
			<?php
				if(isset($_POST['mail']))
				{					
					require_once("includes/connexion.php");
					$mai=htmlentities($_POST['mail'], ENT_QUOTES);
					$mai=mysql_real_escape_string($mai);
					$mail=strtolower($mai);
					
					// update du 04/05/2012
					require_once('includes/class.db.php');
					$DB=new Database;
					$me=$DB->querySingle('SELECT COUNT(id) nb FROM compte_etudiant WHERE mail=\''.$mail.'\'');
					//
					if((int)$me->nb > 0)
					{							
						$get=alea();
						$from  = "From:bureau@bde-epsi-bdx.fr\n";
						$from .= "MIME-version: 1.0\n";
						$from .= "Content-type: text/html; charset= iso-8859-1\n";
						
						$rep=mysql_query("SELECT * FROM compte_etudiant WHERE mail='$mail'");
						$rep2=mysql_query("SELECT * FROM password WHERE mail_etudiant='$mail'");
						if(mysql_num_rows($rep2))
						{
							echo 'Vous avez déjà demandé un renouvellement de mot de passe.<br>Pour plus de renseignements, veuillez contacter rdauby@epsi.fr';
						}
						else if(mysql_num_rows($rep))
						{
							$don=mysql_fetch_assoc($rep);
							mysql_query("INSERT INTO password VALUES ('', '$mail', '$get')");						
							
							$nom=$don['nom'];
							$prenom=$don['prenom'];
							$nomCompose='<h3>Bonjour '.$prenom.' '.$nom.'</h3><br><br> Pour renouveler votre mot de passe cliquez sur le lien ci-dessous :<br><br>';
							$nomCompose.='<a href="http://espelette.bde-epsi-bdx.fr/nouveau-mot-de-passe.bde?id='.$get.'">Renouveler mot de passe</a><br><br> Merci de votre fidélité.<br> Cordialement, <u>Romain Dauby</u>.';
							mail($mail, "Nouveau mot de passe interface Espelette", $nomCompose, $from);
							echo 'Un mail de renouvellement de mot de passe vient de vous être envoyé';
						}
					}else
						echo 'Vous ne vous êtes jamais inscrit sur cette interface. <a href="enregistrement.php">Inscription ici</a>';
				}
			?>		
			<br><br><p class="centre"><a href="javascript:history.back()" class="foo">Retour</a></p>
		</div>
		<?php require_once("includes/footer.php"); ?>
	</div>
	
	</body>
</html>