<?= $this->Form->create('Login'); ?>

<?= $this->Form->input('email', array(
									'label' => 'Email', 
									'placeholder' => 'kod@social.mehh'
									)
						);
 ?>

 <?= $this->Form->input('password', array(
									'label' => 'Mot De Passe', 
									'class' => "small_form_field")
						);
 ?>
<?= $this->Form->end("Racourcir mon lien"); ?>
<?

if($error == true);
{
	echo "<p><font color=\"red\">Adresse électronique incorrecte<br />
L’adresse électronique que vous avez saisie n’est associée à aucun compte.<br />
Merci de bien vouloir rentrer de nouveau votre adresse électronique et votre mot de passe.<br />Assurez-vous
qu’il/elle soit tapée correctement.</font>
</p>";
}

?>