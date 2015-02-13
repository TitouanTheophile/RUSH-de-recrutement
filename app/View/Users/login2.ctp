<div id="signin_form">

<h3>Se connecter</h3>

<?= $this->Form->create('User', array('novalidate')); ?>
<?= $this->Form->input('username', array(
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
<?= $this->Form->end("Connexion"); ?>
<?

if($this->request->is('post') && $error == true )
{
	if ($errInfo == 'username')
	{
		echo "<p><font color=\"red\">Adresse électronique incorrecte<br />
		L’adresse électronique que vous avez saisie n’est associée à aucun compte.<br />
		Merci de bien vouloir rentrer de nouveau votre adresse électronique et votre mot de passe.<br />
		Assurez-vous qu’il/elle soit tapée correctement.</font>
		</p>";
	}
	else if ($errInfo == 'password')
	{
		echo "<p><font color=\"red\">Le mot de passe est incorrecte<br />
		Le mot de passe que vous avez saisie n’est pas associé à l'adresse électronique que vous avez saisie.
		<br />Merci de bien vouloir rentrer de nouveau votre mot de passe.<br />
		Assurez-vous qu’il soit tapé correctement.</font>
		</p>";
	}
}
?>

</div>