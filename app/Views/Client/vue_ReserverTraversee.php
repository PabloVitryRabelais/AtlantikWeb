<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
<?php
$session = session();
echo "<br><h5> Traversée n°".$LaTraversee->NOTRAVERSEE." le ".explode(' ',$LaTraversee->DATEHEUREDEPART)[0]." a ".explode(' ',$LaTraversee->DATEHEUREDEPART)[1];
foreach ($PortsLiaison as $Ports) {
    echo "<br>Liaison entre ".$Ports->portDepart." et ".$Ports->portArrivee;
}
echo "<br><br> Mr ".$session->get('nom')." ".$session->get('prenom')."<br>Veuillez saisir les information relatives a la reservation : </h5>";

$sumLettre = 0;
$enrLettre = null;

foreach ($Categories as $UneCategorie)
{
    if ($UneCategorie->lettre != $enrLettre) 
    {
        $sumLettre++;
        $enrLettre = $UneCategorie->lettre;
        $lettre[$sumLettre] = $UneCategorie->lettre;
        $lettreLibelle[$sumLettre] = $UneCategorie->lettreLibelle;
        $countType[$enrLettre] = 0;
    }

    $countType[$enrLettre] += 1;
    $typeLibelle[$enrLettre."".$UneCategorie->type] = $UneCategorie->typeLibelle;
}

foreach ($PlacesMax as $ligne)
{
    if ($ligne->lettre != $enrLettre)
    {
        $maxPlaces[$ligne->lettre] = $ligne->capaciteMax;
        $enrLettre = $ligne->lettre;
    }
}

foreach ($PlacesReservee as $ligne)
{
    if (!isset($reservePlaces[$ligne->lettreCategorie]))
    {
        $reservePlaces[$ligne->lettreCategorie] = 0;
    }
    $reservePlaces[$ligne->lettreCategorie] += $ligne->quantReservee;
    $enrLettre = $ligne->lettreCategorie;
}

echo '<div class="container-fluid">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<br>
<table class="table table-bordered">';

for ($i=1; $i<=$sumLettre; $i++)
{
    if (isset($reservePlaces[$lettre[$i]]) && ($maxPlaces[$lettre[$i]] - $reservePlaces[$lettre[$i]]) <= 0)
    {
       echo '<tr> Aucunes places disponibles pour '.$lettreLibelle[$i].'</tr>'; 
    } else {
        for ($j=1; $j<=$countType[$lettre[$i]]; $j++)
        {
            echo '<tr>
            <td>'.$typeLibelle[$lettre[$i]."".$j].'</td>
            </tr>';
        }
    }
}

echo '</div>
</table>';
