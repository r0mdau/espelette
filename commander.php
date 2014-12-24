<?php
	session_start(); 
	if(!isset($_SESSION['id'])) header('location:index.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php
	require_once("includes/head.php");
	require_once("includes/connexion.php");
?>
</head>
<body>
<div id="global">
<div id="middle">
<form method="post" action="envoicommande.php" name="contact" onsubmit="alert('Si vous souhaitez modifier/supprimer votre commande, allez dans la section récapitulatif.')" >
	<h3><label>Votre commande du <?=date('d').'/'.date('m').'/'.date('Y')?> :</label></h3>
	<select name="quantite" id="quantite">
	   <option value="1">1</option>
	   <option value="2">2</option>
	</select>
	
	<select name="sandwich" id="sandwich" onchange="bijour();">
	   <option value="1">Américain</option>
	   <option value="3">Panini</option>
	</select>
	
	<select id="viande" name="viande">
		<optgroup label="Americain">
			<option value="1">Steak</option>
			<option value="2">Poulet</option>
		</optgroup>
	</select>

	<p>
       <input type="checkbox" name="ketchup" value="2"> <label>Ketchup</label><br />
       <input type="checkbox" name="mayo" value="3"> <label>Mayo</label><br />
	   <input type="checkbox" name="moutarde" value="4"> <label>Moutarde</label><br />
   </p>
	
	<label>Supplément :</label>
	<input type="text" name="supp" placeholder="bacon chèvre salade"><br>
	<input type="submit" value="Envoyer" >
</form>

<h6>Le tarif est de 3€ par sandwich (panini/américain). Les commandes doivent être passées entre 8h30 et 10h30. Si tel n'est pas le cas, votre commande ne sera pas prise en compte, Merci.</h6>
<!--h3 style="color:red;">Service fermé pendant les vacances :) Rendez-vous à la rentrée !</h3-->
<p class="centre"><a href="<?php echo 'accueil-'.$_SESSION['prenomURL'].'-'.$_SESSION['nomURL'].'.bde'; ?>" class="foo">Retour</a></p>
</div>
<?php require_once("includes/footer.php"); ?>
</div>
<script>	
	function bijour(){
		if(document.getElementById('sandwich').value == 3)
		document.getElementById('viande').innerHTML = '<optgroup label="Panini"><option value="3">3 fromages</option><option value="4">Bayonne</option><option value="5">Biarritz</option><option value="6">Chorizo</option><option value="7">Espelette</option><option value="8">Hot-dog</option><option value="9">Jambon</option><option value="2">Poulet</option><option value="1">Steak</option></optgroup>';
		else
		document.getElementById('viande').innerHTML = '<optgroup label="Americain"><option value="1">Steak</option><option value="2">Poulet</option></optgroup>';
	}
</script>
<?php require_once("includes/javascriptNotification.php"); ?>
</body>
</html>
