<center>
<h2><?php echo " - ".$TitrePage." - " ?></h2>
<?php
if ($TitrePage == 'Saisie formulaire incorrecte')
{
    echo service('validation')->listErrors(); 
    echo form_open('creercompte');
} 
echo form_open('creercompte');
echo csrf_field();

echo '</br>';
echo '</br>';

echo '<div class="row">';
echo '<div class="col-sm-4">';

echo '<h4> Informations personelles </h4>';

echo '</br>';
echo form_input('txtNom', set_value('txtNom'), 'placeholder="Nom"');
echo '</br>';
echo '</br>';
echo form_input('txtPrenom', set_value('txtPrenom'), 'placeholder="Prenom"');
echo '</br>';
echo '</br>';
echo form_input('txtAdresse', set_value('txtAdresse'), 'placeholder="Adresse"');
echo '</br>';
echo '</br>';
echo form_input('txtCodePostal', set_value('txtCodePostal'), 'placeholder="Code Postal"');
echo '</br>';
echo '</br>';
echo form_input('txtVille', set_value('txtVille'), 'placeholder="Ville"');

echo '</div>';

echo '<div class="col-sm-4">';

echo '<h4> Moyens de vous joindre </h4>';

echo '</br>';
echo form_input('txtTelFixe', set_value('txtTelFixe'), 'placeholder="Tel fixe (06.06.06.06.06)"');
echo '</br>';
echo '</br>';
echo form_input('txtTelMobile', set_value('txtTelMobile'), 'placeholder="Tel mobile (06.06.06.06.06)"');
echo '</br>';
echo '</br>';
echo form_input('txtMel', set_value('txtMel'), 'placeholder="Mail (qlq@antlantik.dot)"');

echo '</div>';

echo '<div class="col-sm-4">';

echo "<h4> Finnaliser l'inscription </h4>";

echo '</br>';
echo form_input('txtMDP', set_value('txtMDP'), 'placeholder="Mot de passe"');
echo '</br>';
echo '</br>';
echo form_input('txtConfMDP', set_value('txtConfMDP'), 'placeholder="Confirmez votre mdp"');

echo '</br>';
echo '</br>';

echo form_submit('btnOK',"S'inscrire", 'class = "btn btn-warning"');
echo '</br>';
echo anchor('/seconnecter',"j'ai deja un compte");

echo form_close();
echo '</center>';
?>