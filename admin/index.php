<?php
    require_once('../includes/class.db.php');
    $db = new Database;
    $commandes = $db->queryObject('SELECT compte_etudiant.nom nom, compte_etudiant.prenom, quantite.quantite quantite, sandwich.nom_sandwich sandwich, viande.nom_viande viande,
                                  sauce.nom_sauce sauce, commande_new.supp supp
                                  FROM commande_new
                                  INNER JOIN compte_etudiant ON commande_new.id_etudiant = compte_etudiant.id
                                  INNER JOIN quantite ON commande_new.id_quantite = quantite.id_quantite
                                  INNER JOIN sandwich ON commande_new.id_sandwich = sandwich.id_sandwich
                                  INNER JOIN viande ON commande_new.id_viande = viande.id_viande
                                  INNER JOIN sauce ON commande_new.id_sauce = sauce.id_sauce
                                  WHERE MONTH(commande_new.date) = MONTH(NOW())
                                  AND DAYOFMONTH(commande_new.date) = DAYOFMONTH(NOW())');
    $html = 'Bonjour, commandes du BDE pour 13h :<br>';
    if(isset($commandes[0]->nom)){
        foreach($commandes as $commande)
            $html .= $commande->nom.' '.$commande->prenom.' : '.$commande->quantite.' '.$commande->sandwich.' '.$commande->viande.' '.$commande->sauce.' '.$commande->supp.'<br>';
    }
    $html .= 'Merci.';
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Commandes Espelette</title>
            <meta charset="utf-8">
        </head>
        <body>
            <?=$html?>
        </body>
    </html>