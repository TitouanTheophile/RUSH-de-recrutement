<?= $this->Form->create('Login', array('novalidate')); ?>
<?= $this->Form->input('email', array(
									'label' => 'Email', 
									"placeholder" => "kod@social.mehh",
									'class' => "small_form_field")
						);
 ?>

 <?= $this->Form->input('password', array(
									'label' => 'Mot De Passe', 
									'class' => "small_form_field")
						);
 ?>
<?= $this->Form->end("Ce connecter"); 
?>
<?="<p><font color=\"red\">Adresse électronique incorrecte<br />
L’adresse électronique que vous avez saisie n’est associée à aucun compte.<br />
Merci de bien vouloir rentrer de nouveau votre adresse électronique et votre mot de passe.<br />
Assurez-vous qu’il/elle soit tapée correctement.</font>
</p>"
?>