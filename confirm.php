<?php
    //page de confirmation d'inscriprion, on modifie un champ dans la bdd
    if(isset($_GET['randy']) AND !empty($_GET['randy'])){
        include('includes/class.db.php');
        $db=new Database;
        $mail=$db->querySingle('SELECT mail_etudiant FROM password WHERE alea=\''.$_GET['randy'].'\'');
        $db->query('UPDATE compte_etudiant SET active=1 WHERE mail=\''.$mail->mail_etudiant.'\'');
        $db->query('DELETE FROM password WHERE mail_etudiant=\''.$mail->mail_etudiant.'\'');
        header('location:connexion.php?t=1');
    }else die;
?>