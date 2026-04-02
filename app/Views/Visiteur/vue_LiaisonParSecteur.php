<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
</center>
<?php

$attributsTableau = ["table_open" => "<table class='table table-striped'>",]; 
$table = new \CodeIgniter\View\Table($attributsTableau);
$table->setHeading(['Secteur', 'n° Liaison', 'Port de départ', "Port d'arrivée",'distance (km)']);
$secteur = null;
foreach ($liaisonsParSecteur as $ligne)
{
    if ($ligne->nomSecteur === $secteur)
    {
        $table->addRow(" ", anchor('liaisonsparsecteur/'.$ligne->noLiaison, $ligne->noLiaison, 'class = "btn"'), $ligne->portDepart, $ligne->portArrivee, $ligne->distance);
    } else 
    {
        $secteur = $ligne->nomSecteur;
        $table->addRow($secteur, anchor('liaisonsparsecteur/'.$ligne->noLiaison, $ligne->noLiaison, 'class = "btn"'), $ligne->portDepart, $ligne->portArrivee, $ligne->distance);
    }
}

echo $table->generate();
?>