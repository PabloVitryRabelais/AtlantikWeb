<br><br><br>
<center>
<?php
if ($compteAjoute) { 
    echo 'Création du compte client effectué, numero client : '.$compteAjoute;
    echo '<br><br><br>';
    echo '<p><a href="'.site_url('Atlantik').'">Retour vers acceuil</a></p>';
} else {
    echo 'Echec de la création du compte';
    echo '<br><br><br>';
    echo '<p><a href="'.site_url('creercompte').'">Retour au formulaire</a></p>';
}
?>
</center>