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
<?="<p><font color=\"red\">Veuillez confirmer votre mot de passe.<br />
Le mot de passe que vous avez saisi est incorrect.<br />Veuillez réessayer (vérifiez que le verrouillage des 
majuscules est désactivé).<br /></font>
</p>"
?>