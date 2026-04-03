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
foreach ($LesPeriode as $UnePeriode)
{
    echo '<option value='.$UnePeriode->DATEDEBUT.'>'.$UnePeriode->DATEDEBUT.'</option>';
}
echo '</select>
<br>
<br>
<br>';
echo form_submit('btnAfficher', 'Afficher les trasversées', 'class="btn btn-dark btn-lg"');
echo '
</div>
<div class="col-sm-6">';




?>
</div>
</div>