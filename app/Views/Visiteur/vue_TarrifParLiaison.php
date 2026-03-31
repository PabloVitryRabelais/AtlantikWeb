<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
</center>
<?php
$sumLigne = 0;

$sumDate = 0;
$enrDate = null;

$sumLettre = 0;
$enrLettre = null;

foreach ($tarifParLiaison as $ligne)
{
    $sumLigne += 1;
    if (!($ligne->datedebut === $enrDate))
    {
        $sumDate += 1;
        $enrDate = $ligne->datedebut;
        $date[$sumDate] = $ligne->datedebut." / ".$ligne->datefin;
    }

    if (!($ligne->lettre === $enrLettre))
    {
        $sumLettre += 1;
        $enrLettre = $ligne->lettre;
        $lettre[$sumLettre] = $ligne->lettre." / ".$ligne->lettreLibelle;
        $type[$ligne->lettre."".$ligne->type] = $ligne->lettre."".$ligne->type." - ".$ligne->typeLibelle;
    } else {
        $type[$ligne->lettre."".$ligne->type] = $ligne->lettre."".$ligne->type." - ".$ligne->typeLibelle;
    }
}
echo $sumLettre;

echo '
<table class="table table-striped">
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
    echo '<tr>
    <th rowspan="'.$sumLettre.'">'.$lettre[$i].'</th>';

    echo '</tr>';
}


echo '</table>';

?>