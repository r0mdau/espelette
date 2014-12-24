<?php
	session_start(); 
	if(!isset($_SESSION['id'])) header('location:index.php');
	require_once("includes/class.db.php");
    require_once("includes/connexion.php");
    $db = new Database;
?>
<!DOCTYPE html>
<html>
<head>
<?php    
	require_once("includes/head.php");
?>
	<link href="css/visualize.css" type="text/css" rel="stylesheet" />
    <link href="css/visualize-dark.css" type="text/css" rel="stylesheet" />
</head>
<body>
<table style="display: none;width:500px;">
	<caption>Top 4 des acheteurs</caption>
	<thead>
		<tr>
			<td></td>
			<th scope="col">Sandwichs achetés</th>
			<th scope="col">Mesages chat envoyés</th>
		</tr>
	</thead>
	<tbody>		
        <?php
            $res=$db->queryObject('SELECT COUNT(*) total, nom, prenom, id_etudiant FROM commande_new, compte_etudiant WHERE compte_etudiant.id=commande_new.id_etudiant GROUP BY id_etudiant ORDER BY total DESC LIMIT 4');
            foreach($res as $youpi){
		if($youpi->id_etudiant != $_SESSION['id']){
			$reg=$db->querySingle('SELECT COUNT(*) tot FROM chat WHERE id_etudiant=\''.$youpi->id_etudiant.'\'');
			echo '<tr>';
			echo '<th scope="row">'.$youpi->prenom.' '.$youpi->nom.'</th>';
			echo '<td>'.$youpi->total.'</td>';
			echo '<td>'.$reg->tot.'</td>';
			echo '</tr>';
		}
            }
        ?>
        <tr>
	<?php
		$ger=$db->querySingle('SELECT nom, prenom FROM compte_etudiant WHERE id=\''.$_SESSION['id'].'\'');
		$re=$db->querySingle('SELECT COUNT(*) total FROM commande_new WHERE id_etudiant=\''.$_SESSION['id'].'\'');
		$re=$db->querySingle('SELECT COUNT(*) tot FROM chat WHERE id_etudiant=\''.$_SESSION['id'].'\'');
		echo '<th scope="row">'.$ger->prenom.' '.$ger->nom.'</th>';
		echo '<td>'.$re->total.'</td>';
		echo '<td>'.$re->tot.'</td>';
	?>
		</tr>		
	</tbody>
</table>
<table style="display: none;width:500px;">
	<caption>Top 4 des consommateurs</caption>
	<thead>
		<tr>
			<th scope="col">Argent dépensé</th>
		</tr>
	</thead>
	<tbody>		
        <?php
            $res=$db->queryObject('SELECT compte_etudiant.prenom, compte_etudiant.nom, SUM(actions.valeur / 2) total FROM compte_etudiant, actions WHERE compte_etudiant.id = actions.id_etudiant GROUP BY actions.id_etudiant ORDER BY total DESC LIMIT 4');
            foreach($res as $youpi){
		echo '<tr>';
		echo '<th scope="row">'.$youpi->prenom.' '.$youpi->nom.'</th>';
		echo '<td>'.substr($youpi->total, 0, 2).'</td>';
		echo '</tr>';
            }
        ?>
        <tr>
	<?php
		$ger=$db->querySingle('SELECT compte_etudiant.prenom, compte_etudiant.nom, SUM(actions.valeur / 2) total FROM compte_etudiant, actions WHERE compte_etudiant.id=\''.$_SESSION['id'].'\' AND compte_etudiant.id = actions.id_etudiant GROUP BY actions.id_etudiant');
		echo '<th scope="row">'.$ger->prenom.' '.$ger->nom.'</th>';
		echo '<td>'.$ger->total.'</td>';
	?>
	</tr>		
	</tbody>
</table>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/visualize.jQuery.js"></script>    
<script>$('table').visualize();</script>
</body>
</html>
