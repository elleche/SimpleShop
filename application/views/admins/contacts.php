</h2><?= $title ?></h2>
<?php foreach ($contacts as $contact): ?>
    <div id="main">
		<?= 'Email: ' . $contact->getEmail() ?>
        <?= 'Is subscribed: ' . ($contact->isSubscribed() ? 'yes' : 'no')?>
    </div>
<?php endforeach ?>