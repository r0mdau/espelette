<?php
/*///////////////////////////////////////////////////////////////////////////////////////////////
Page retravaillée le 04/05/2012
///////////////////////////////////////////////////////////////////////////////////////////////*/
	session_start(); 
	if(!isset($_SESSION['id'])) {header('location:index.php'); exit;}
	else
	{
		$id_etudiant=$_SESSION['id'];
		require_once('includes/class.db.php');
		$DB=new Database;
		$ligne=$DB->querySingle('SELECT * FROM compte_etudiant WHERE id='.$id_etudiant);
		$prenom=$ligne->prenom;$nom=$ligne->nom;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once("includes/head.php"); ?>
	</head>
	<body>
		<div id="global">
			<?php echo "Connecté en tant que : $prenom $nom";?>
			<div id="petit_recap">
				<table>
					<tr><td><strong>Date</strong></td><td><strong>Commande</strong></td><td><strong>Suppr</strong></td></tr>
					<?php
						$ligne=$DB->queryObject('SELECT quantite, nom_viande, nom_sauce, nom_sandwich, date, supp, commande_new.id_commande id_commande
									FROM commande_new, sandwich, sauce, viande, quantite
									WHERE commande_new.id_sandwich=sandwich.id_sandwich
									AND commande_new.id_viande=viande.id_viande
									AND commande_new.id_sauce=sauce.id_sauce
									AND commande_new.id_etudiant='.$ligne->id.' 
									GROUP BY id_commande ORDER BY id_commande DESC');
						foreach($ligne as $cas){
							$commande=$cas->quantite.' '.$cas->nom_sandwich.' '.$cas->nom_viande.' '.$cas->nom_sauce.' '.$cas->supp;
							echo '<tr id="d'.$cas->id_commande.'"><td><p>'.$cas->date.'</p></td><td><p>'.$commande.'</p></td><td><img style="cursor:pointer;" src="images/delete.png" onclick="supprim('.$cas->id_commande.');" /></td></tr>';
						}
					?>
				</table>
			</div>
			<p class="centre">
				<a href="accueil-<?php echo $_SESSION['prenomURL'].'-'.$_SESSION['nomURL']; ?>.bde" class="foo">Retour</a>
			</p>
			<?php require_once("includes/footer.php"); ?>
		</div>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script>
			function supprim(id){
				if(confirm('Confirmer la suppression de cette commande ?')){
					$('#d'+id).hide();
					$.ajax({
						type	:'POST',
						url	:'ajax/suppr_commande.php',
						data	:'id='+id,
						success	:resu
					});
				}
			}
			function resu(res){
				alert(res);
			}
		</script>
	</body>
</html>
