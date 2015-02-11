<?= $this->Html->script('dynamic_search'); ?>
<label for="ProfileId">Destinataire</label>
<input type="text" id="ProfileId">
<div id="results_search"></div>
<br>

<?php foreach ($messages as $message): ?>
    <?= $message['From']['firstname'] . ' ' . $message['From']['lastname'] . ' -> ' . $message['To']['firstname'] . ' ' . $message['To']['lastname']; ?>
    <li><?= $message['Message']['content']; ?></li>
   <?= $this->Html->link('Voir les messages', $message['Message']['url']); ?>
    <br><br>
<?php endforeach; ?>