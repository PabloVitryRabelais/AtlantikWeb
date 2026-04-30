<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
<?php
$session = session();
echo "<br><h5> Traversée n°".$LaTraversee->NOTRAVERSEE." le ".explode(' ',$LaTraversee->DATEHEUREDEPART)[0]." a ".explode(' ',$LaTraversee->DATEHEUREDEPART)[1];
foreach ($PortsLiaison as $Ports) {
    echo "<br>Liaison entre ".$Ports->portDepart." et ".$Ports->portArrivee;
}
if(session()->get('profil')=='Client') 
{
    echo "<br><br> Mr ".$session->get('nom')." ".$session->get('prenom');
} else {
    echo "<br><br>! Il faut se connecter pour valider !";
}
echo '<br>Veuillez saisir les information relatives a la reservation : </h5>';

if ($TitrePage === "Saisie valeure incorrecte")
{
    echo '<h6 class="text-danger"> Veuillez saisir des valeures correctes </h6>';
}

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
$session->set('lettre', $lettre);
$session->set('countType', $countType);
$session->set('sumLettre', $sumLettre);

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

foreach ($Tarif as $ligne)
{
    if (!isset($tarif[$ligne->LETTRECATEGORIE."".$ligne->NOTYPE]))
    {
        $tarif[$ligne->LETTRECATEGORIE."".$ligne->NOTYPE] = $ligne->TARIF;
    }
}

$session->set('tarif', $tarif);

echo form_open('reservertraversee/1');
echo csrf_field();

echo '<div class="container-fluid">
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<br>
<table class="table table-bordered table-striped" name=>';

for ($i=1; $i<=$sumLettre; $i++)
{
    if ($maxPlaces[$lettre[$i]] <= 0 || isset($reservePlaces[$lettre[$i]]) && ($maxPlaces[$lettre[$i]] - $reservePlaces[$lettre[$i]]) <= 0)
    {
       echo '<tr> Aucunes places disponibles pour '.$lettreLibelle[$i].'</tr>'; 
    } else {
        for ($j=1; $j<=$countType[$lettre[$i]]; $j++)
        {
            echo '<tr>
            <td>'.$typeLibelle[$lettre[$i]."".$j].'</td>
            <td>'.$tarif[$lettre[$i]."".$j].'€</td>
            <td>';
            echo form_input('txt'.$lettre[$i].''.$j, set_value('txt'.$lettre[$i].''.$j), 'type="text" placeholder="quantité" size="6"');
            echo'</td></tr>';
        }
    }
}

echo '</table>';
echo '<center>';
if(session()->get('profil')=='Client')
{
    echo form_submit('btnValider','Valider / Acheter','class = "btn btn-primary btn-lg"');
} else {
    echo form_submit('btnValider','Valider / Acheter','class = "btn btn-primary btn-lg disabled"');
}
echo '</center>
</div>';
