<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
</center>
<?php
$sumLigne = 0;

$sumDate = 0;
$enrDate = null;

$sumLettre = 0;
$enrLettre = null;

$sumType = 0;
$enrType = null;

foreach ($tarifParLiaison as $ligne)
{
    $sumLigne++;
    if (!($ligne->datedebut === $enrDate))
    {
        $sumDate++;
        $enrDate = $ligne->datedebut;
        $date[$sumDate] = $ligne->datedebut." / ".$ligne->datefin;
    }

    if (!isset($type[$ligne->lettre."".$ligne->type]))
    {
        if ($ligne->lettre != $enrLettre) 
        {
            $sumLettre++;
            $enrLettre = $ligne->lettre;

            $lettre[$sumLettre] = $ligne->lettre;
            $lettreLibelle[$sumLettre] = $ligne->lettreLibelle;

            $type[$enrLettre."1"] = 1;
            $typeLibelle[$enrLettre."1"] = $ligne->typeLibelle;
            $countType[$sumLettre] = 1;
        } else {
            $type[$enrLettre."".$ligne->type] = $ligne->type;
            $typeLibelle[$enrLettre."".$ligne->type] = $ligne->typeLibelle;
            $countType[$sumLettre] += 1;
        }

        $sumPeriode = 1;
        $tarif[$ligne->lettre."-".$ligne->type."-".$sumPeriode] = $ligne->tarif;
    } else {
        if (isset($tarif[$ligne->lettre."-".$ligne->type."-".$sumPeriode])) {
            $sumPeriode += 1;
        }
        $tarif[$ligne->lettre."-".$ligne->type."-".$sumPeriode] = $ligne->tarif;
    }
}


echo '
<table class="table table-bordered table-hover">
    <tr>
        <th rowspan="2">Catégorie(s)</th>
        <th rowspan="2">Type(s)</th>
        <th colspan="'.$sumDate.'">Période(s)</th>
    </tr>
    <tr>';

for ($i=1; $i<=$sumDate; $i++)
{
    echo '<td>'.$date[$i].'</td>';
}
echo '</tr>';

for ($i=1; $i<=$sumLettre; $i++)
{
    echo '<tr class>
    <th rowspan="'.($countType[$i] + 1).'">'.$lettre[$i].' - '.$lettreLibelle[$i].'</th>';
    for ($j=1; $j<=$countType[$i]; $j++)
    {
        echo '<tr><td>'.$lettre[$i].''.$type[$lettre[$i]."".$j].' - '.$typeLibelle[$lettre[$i]."".$j].'</td>';
        for ($k=1; $k<=$sumDate; $k++)
        {
            echo '<td>'.$tarif[$lettre[$i]."-".$type[$lettre[$i]."".$j]."-".$k].'</td>';
        }
        echo '</tr>';
    }
    echo '</tr>';
}


echo '</table>';

?>