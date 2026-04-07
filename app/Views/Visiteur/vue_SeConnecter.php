<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
<?php
if ($TitrePage == 'Saisie incorrecte')
{
    echo service('validation')->listErrors(); 
    echo form_open('seconnecter');
}

echo form_open('seconnecter');
echo csrf_field();

echo '</br>';
echo '</br>';
echo form_input('txtID', set_value('txtID'), 'placeholder="Mel"');
echo '</br>';
echo '</br>';
echo form_input('txtMDP', set_value('txtMDP'), 'placeholder="Mot de passe"');
echo '</br>';
echo '</br>';
echo form_submit('btnConnecter','Se connecter','class = "btn btn-primary"');