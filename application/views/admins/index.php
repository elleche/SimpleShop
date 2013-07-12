<h2><?= 'Welcome, ' . $admin->getUsername() . '!' ?></h2>
    <div>
        <p><a href="<?= base_url('admins/edit/' . $admin->getId() )?>">Your details</a></p>

    </div>