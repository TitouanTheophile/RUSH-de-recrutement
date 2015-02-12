<?= $this->Form->create('Login', array('novalidate')); ?>
<?= $this->Form->input('email', array('label' => 'Email', "placeholder" => "kod@social.mehh")); ?>
<?= $this->Form->input('password', array('label' => 'Mot De Passe')); ?>
<?= $this->Form->end("Ce connecter"); ?>