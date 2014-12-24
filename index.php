<?php
    session_start();
    $_SESSION = array();
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once("includes/head.php"); ?>
</head>
<body>
<div id="global">
    <div id="middle">
        <h3>Bienvenue sur l'interface de commande pour le Fournil d'Espelette</h3><br><br>
        <p class="centre"><a href="connexion-interface.bde" class="foo">Se connecter</a><br><br>
        <a href="enregistrement.bde" class="foo">S'enregistrer</a><br>
        <a href="new-pass.bde"><span style="font-size:0,9em;">Mot de passe perdu ?</span></a></p><br>
    </div>
<?php require_once("includes/footer.php"); ?>
</div>
</body>
</html>
