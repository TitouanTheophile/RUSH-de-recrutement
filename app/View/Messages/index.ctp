<?= $this->Html->script('dynamic_search', array('inline' => false)); ?>
<?= $this->Html->css('message', array('inline' => false)); ?>
<label for="ProfileId">Destinataire</label>
<input type="text" id="ProfileId">
<div id="results_search"></div>
<div id="messages">
<?php foreach ($messages as $message): ?>
    <?= $message['From']['firstname'] . ' ' . $message['From']['lastname'] . ' -> ' . $message['To']['firstname'] . ' ' . $message['To']['lastname']; ?>
    <li><?= $message['Message']['content']; ?></li>
   <?= $this->Html->link('Voir les messages', $message['Message']['url']); ?>
<?php endforeach; ?>
</div>

