<?php
    function mail_confirmation($mail, $prenom='', $nom=''){
        $get=randy();
        require_once('includes/connexion.php');
        mysql_query('INSERT INTO password (alea, mail_etudiant) VALUES (\''.$get.'\', \''.$mail.'\')');
        
        $from  = "From:bureau@bde-epsi-bdx.fr\n";
        $from .= "MIME-version: 1.0\n";
        $from .= "Content-type: text/html; charset=utf-8\n";
        
        $nomCompose='<h3>Bonjour '.$prenom.' '.$nom.'</h3><br><br> Cliquez sur le lien ci-dessous pour activer votre compte  :<br><br>';
        $nomCompose.='<a href="http://espelette.romaindauby.fr/confirm.php?randy='.$get.'">Confirmation inscription Interface de commande du fournil d\'Espelette du BDE.</a><br><br> Cordialement,';
        $nomCompose.='&nbsp;<u><a href="http://bde-epsi-bdx.fr">Le BDE</a></u>.';
        
        mail($mail, 'Confirmation d\'inscription BDE Epsi', $nomCompose, $from);
    }