<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
<?php
if ($TitrePage == 'Saisie formulaire incorrecte')
{
    echo '</center>';
    echo service('validation')->listErrors(); 
    echo form_open('creercompte');
    echo '<center>';
} 
echo form_open('creercompte');
echo csrf_field();

echo '</br>';
echo '</br>';

echo '<div class="row">';
echo '<div class="col-sm-4">';
echo form_label('Nom : ', 'txtNom');
echo form_input('txtNom', set_value('txtNom'));
echo '</br>';
echo '</br>';
echo form_label('Prenom :  ', 'txtPrenom');
echo form_input('txtPrenom', set_value('txtPrenom'));
echo '</br>';
echo '</br>';
echo form_label('Mot de passe : ', 'txtMDP');
echo form_input('txtMDP', set_value('txtMDP'));
echo '</div>';

echo '<div class="col-sm-4">';
echo form_label('Adresse :', 'txtAdresse');
echo form_input('txtAdresse', set_value('txtAdresse'));
echo '</br>';
echo '</br>';
echo form_label('Code Postale : ', 'txtCodePostal');
echo form_input('txtCodePostal', set_value('txtCodePostal'));
echo '</br>';
echo '</br>';
echo form_label('Ville : ', 'txtVille');
echo form_input('txtVille', set_value('txtVille'));
echo '</div>';

echo '<div class="col-sm-4">';
echo form_label('Telephone fixe : ', 'txtTelFixe');
echo form_input('txtTelFixe', set_value('txtTelFixe'));
echo '</br>';
echo '</br>';
echo form_label('Telephone mobile : ', 'txtTelMobile');
echo form_input('txtTelMobile', set_value('txtTelMobile'));
echo '</br>';
echo '</br>';
echo form_label('Mel : ', 'txtMel');
echo form_input('txtMel', set_value('txtMel'));
echo '</div>';
echo '</div>';

echo '</br>';
echo '</br>';

echo form_label("conditions d'utilisation");
echo '</br>';
echo form_submit('btnOK',"S'inscrire");
echo form_close();
echo '</center>';
?>