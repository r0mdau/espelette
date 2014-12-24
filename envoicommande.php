<?php
session_start();

if(!isset($_SESSION['id'])) header('location:index.php');
require_once("includes/connexion.php");

$boole=true;
if($boole)
{
	if(isset($_POST['sandwich']) AND isset($_POST['quantite']) AND isset($_POST['viande']))
	{	
		$id_etudiant=$_SESSION['id'];
		//intval convertit une chaine en entier
		$id_viande=intval($_POST['viande']);
		$id_sandwich=intval($_POST['sandwich']);
		$quantite=intval($_POST['quantite']);
	
		//quand la quantité vaut 2, on choisis le nom du sandwich au pluriel dans la BDD
		if($id_sandwich==1 AND $quantite==2)
		{
			$id_sandwich=2;
		}	
		//idem
		if($id_sandwich==3 AND $quantite==2)
		{
			$id_sandwich=4;
		}
		//mise en page du supplément de la commande
		if(isset($_POST['supp']) AND !empty($_POST['supp']))
		{	
			$sup=mysql_real_escape_string($_POST['supp']);
			if($sup!=NULL) {$supp='+ '.$sup;}	
		}
		else {$supp="";}
		
		
		$id_sauce = 0;
		if (isset($_POST['ketchup']))
			$id_sauce += intval($_POST['ketchup']);
		if(isset($_POST['mayo']))
			$id_sauce += intval($_POST['mayo']);
		if(isset($_POST['moutarde']))
			$id_sauce  += intval($_POST['moutarde']);
		if($id_sauce == 0)
			$id_sauce = 1;
			
		mysql_query('INSERT INTO commande_new (id_etudiant, id_quantite, id_sandwich, id_viande, id_sauce, supp, ip) VALUES ('.$id_etudiant.', '.$quantite.', '.$id_sandwich.', '.$id_viande.', '.$id_sauce.', \''.$supp.'\', \''.$_SERVER["REMOTE_ADDR"].'\')');
		
		header('location:recapitulatif-commandes-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde');	
		exit;
	}
}
else{
	echo '<!DOCTYPE html><html><head>
	<meta charset="utf-8"></head><body>';
	echo'<script>alert("Les commandes seront de nouveau actives à la rentrée scolaire, merci de votre compréhension.")</script>';
	//echo '<script>alert("Votre commande ne sera pas prise en compte car vous n\'avez pas commandé entre 8h30 et 10h30 !")</script>';
	echo '</body></html>';
	header('refresh:0; url=commander-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde');
}
?>
