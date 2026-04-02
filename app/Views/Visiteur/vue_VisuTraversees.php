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
?>
</div>
</div>