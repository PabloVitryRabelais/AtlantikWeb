<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
<?php

$session = session();
echo "<br><h5> Traversée n°".$LaTraversee->NOTRAVERSEE." le ".explode(' ',$LaTraversee->DATEHEUREDEPART)[0]." a ".explode(' ',$LaTraversee->DATEHEUREDEPART)[1];
foreach ($PortsLiaison as $Ports) {
    echo "<br>Liaison entre ".$Ports->portDepart." et ".$Ports->portArrivee;
}
echo '</center>
<div class="container-fluid">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<br>
<br><br> Mr '.$session->get("nom").' '.$session->get("prenom").'
<br> habitant le '.$session->get("adresse").' a '.$session->get("ville").' '.$session->get("codepostal").'
<br><br> Pour la Traversée n°'.$LaTraversee->NOTRAVERSEE.' le '.$session->get('cmbPeriode').' a '.explode(' ',$LaTraversee->DATEHEUREDEPART->DATEHEUREDEPART)[1].'
<br> Réservation enregistrée sous le n°'.$noReservation.' :';

foreach($enregistrer as $lignes)
{
    
}
