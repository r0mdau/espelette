<?php
    session_start();
    if(!isset($_SESSION['id'])) {header('location:index.php'); exit;}
    if(!isset($_POST['id']) OR empty($_POST['id'])) {header('location:index.php'); exit;}
    
    $id=(int)$_POST['id'];
    require_once('../includes/class.db.php');
    $DB = new Database;
    if($DB->query('DELETE FROM commande_new WHERE id_commande='.$id))
        echo 'La commande sélectionnée a bien été supprimée.';
    else echo 'La commande sélectionnée n\'a PAS été supprimée.';
?>