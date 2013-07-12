</h2><?= $title ?></h2>
<?php foreach ($admins as $admin): ?>
    <div id="main">
		<?= 'Username: ' . $admin->getUsername() ?>
        <?= 'Email: ' . $admin->getEmail()?>
		<a href="<?= base_url('admins/edit/' . $admin->getId())?>">Edit details</a>
		<a href="<?= base_url('admins/delete/' . $admin->getId())?>">Delete</a>
    </div>
<?php endforeach ?>