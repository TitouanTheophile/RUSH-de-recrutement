<?= $this->Html->script('dynamic_search'); ?>

<?= $this->Html->css('message_index'); ?>

<label for="ProfileId">Destinataire</label>
<input type="text" id="ProfileId">
<div id="results_search"></div>
<br>

<div id="messages" style="overflow-y:scroll; height:400px;">

<?php foreach ($messages as $message): ?>
    <?= $message['From']['firstname'] . ' ' . $message['From']['lastname'] . ' -> ' . $message['To']['firstname'] . ' ' . $message['To']['lastname']; ?>
    <li><?= $message['Message']['content']; ?></li>
   <?= $this->Html->link('Voir les messages', array('action' => 'send', $message['From']['id'])); ?>
    <br><br>
<?php endforeach; ?>
</div>

