<?php
	session_start(); 
	if(isset($_SESSION['id']))
	{
		$zoubouboubou=$_SESSION['mail'];
		$id_etudiant=$_SESSION['id'];
		require_once("includes/connexion.php");
		$sql="SELECT id, mail FROM compte_etudiant WHERE id='$id_etudiant'";
		$req=mysql_query($sql);
		$ligne=mysql_fetch_assoc($req);
			
		
		if($id_etudiant==$ligne['id'])
		{
			if (isset($_GET['section']))
			{
				$sql="DELETE FROM compte_etudiant WHERE mail='$zoubouboubou'";
				mysql_query($sql);
				mysql_close($db);
				header('location:index.php');
				exit;
			}
			elseif (isset($_GET['numeri']))
			{
				$sql="DELETE FROM commande_new WHERE id_etudiant='$id_etudiant'";
				mysql_query($sql);
				mysql_close($db);
				header('location:accueilUtilisateur.php');
				exit;
			}
			else
			{
				header('location:connexion.php');
				exit;
			}
		}
	}
	else
	{
		header('location:index.php');
		exit;
	}
