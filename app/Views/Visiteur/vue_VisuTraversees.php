<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
</center>
<div class="container-fluid row">
    <div class="col-sm-3">
<?php

$attributsTableau = ["table_open" => "<table class='table table-hover table-bordered'>",]; 
$table = new \CodeIgniter\View\Table($attributsTableau);
$table->setHeading('Secteurs');
foreach ($LesSecteurs as $UnSecteur)
{
    $table->addRow(anchor("visutraversees/".$UnSecteur->NOSECTEUR,$UnSecteur->NOM, 'class="btn"'));
}
echo $table->generate();

echo form_open('visutraversees');
echo '</div>
<div class="col-sm-3">
<br>
<h4>Liaisons :</h4>
<select name="cmbLiaisons" class="btn">';
if (!isset($LesLiaisons) || $LesLiaisons == null)
{
    echo '<option>Aucunes Liaisons</option>';
} else {
    foreach ($LesLiaisons as $UneLiaison)
    {
        echo '<option value='.$UneLiaison->noLiaison.'>'.$UneLiaison->portDepart.' - '.$UneLiaison->portArrivee.'</option>';
    }
}
echo '</select>
<br>
<br>
<h4>Date :</h4>
<select name="cmbPeriode" class="btn">';
$enrDate = null;
foreach ($LesDates as $UneDate)
{
    if ($UneDate->DATEDEBUT != $enrDate) {
        $enrDate = $UneDate->DATEDEBUT;
        echo '<option value='.$UneDate->DATEDEBUT.'>'.$UneDate->DATEDEBUT.'</option>';
    }
}
echo '</select>
<br>
<br>
<br>';
echo form_submit('btnAfficher', 'Afficher les trasversées', 'class="btn btn-dark btn-lg"');
echo '
</div>
<div class="col-sm-6">
<br>
<br>';

echo '';

if (!isset($TitrePorts) || count($TitrePorts) === 0) 
{
    echo '
    <table class="table table-bordered table-stripped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Heure</th>
            <th>Bateau</th>
            <th>Catégorie(s)</th>
    </thead>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <center>
    <h1 class="text-secondary">Aucunes traversées a afficher</h1>
    </center>';
} else {

    $enrLettre = null;
    $sumLettre = 0;

    $sumTraversee = 0;
    $enrTraversee = null;

    $trv = null;

    foreach ($LesTraversees as $ligne)
    {
        if ($trv === null) {
            $trv = $ligne->noTraversee;
        }

        if ($ligne->noTraversee > $enrTraversee) 
        {
            $sumTraversee++;
            $enrTraversee = $ligne->noTraversee;
            $noTraversee[$sumTraversee] = $ligne->noTraversee;
        }

        if ($ligne->lettre != $enrLettre && $ligne->noTraversee === $trv)
        {
            $sumLettre++;
            $enrLettre = $ligne->lettre;
            $lettre[$sumLettre] = $ligne->lettre;
            $libelle[$sumLettre] = $ligne->libelle;
        }

        $capacite[$ligne->noTraversee."".$ligne->lettre] = $ligne->capaciteMax;
        $bateau[$ligne->noTraversee] = $ligne->nomBateau;
        $heure[$ligne->noTraversee] = explode(' ', $ligne->dateheuredepart)[1];
    }

    foreach ($PlacesReservees as $ligne)
    {
        if (!isset($reserve[$ligne->noTraversee."".$ligne->lettreCategorie]))
        {
            $reserve[$ligne->noTraversee."".$ligne->lettreCategorie] = $ligne->quantReservee;
        } else {
            $reserve[$ligne->noTraversee."".$ligne->lettreCategorie] += $ligne->quantReservee;
        }
        
    }

    foreach($TitrePorts as $ligne) {
        echo ' <center><h4>'.$ligne->portDepart.' - '.$ligne->portArrivee.' pour le '.$TitrePeriode.'</h4></center>';
    }
    echo ' 
    <table class="table table-bordered table-stripped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Heure</th>
            <th>Bateau</th>';

    for ($i=1; $i<=$sumLettre; $i++)
    {
        echo '<th>'.$lettre[$i].' - '.$libelle[$i].'</th>';
    }
    echo '<th>Reserver</th>
    </tr>
    </thead>
    <tbody>';

    for($i=1; $i<=$sumTraversee; $i++)
    {
        echo '<tr>
        <td>'.$noTraversee[$i].'</td>
        <td>'.$heure[$noTraversee[$i]].'
        <td>'.$bateau[$noTraversee[$i]].'</td>';
        for($j=1; $j<=$sumLettre; $j++)
        {
            if (isset($reserve[$noTraversee[$i]."".$lettre[$j]]))
            {
                echo '<td>'.($capacite[$noTraversee[$i]."".$lettre[$j]] - $reserve[$noTraversee[$i]."".$lettre[$j]]).'</td>';
            } else {
                echo '<td>'.$capacite[$noTraversee[$i]."".$lettre[$j]].'</td>';
            }
        }
        echo '<td>'.anchor('reservertraversee/'.$noTraversee[$i],'reserver','class = "btn btn-success"').'</td>
        </tr>';
    }
    echo '</tbody>
    </table>';
}

?>
</div>
</div>