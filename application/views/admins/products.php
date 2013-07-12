</h2><?= $title ?></h2>
<?php foreach ($products as $product): ?>
    <div id="main">
		<?= 'Title: ' . $product->getTitle() ?>
        <?= 'Slug: ' . $product->getSlug()?>
        <?= 'Price: ' . $product->getPrice()?>
        <?= 'Availability: ' . $product->getAvailability()?>
		<a href="<?= base_url('admins/products/edit/' . $product->getId())?>">Edit details</a>
		<a href="<?= base_url('admins/products/delete/' . $product->getId())?>">Delete</a> <span style="color: red">Att! This will delete also all orders of this product. </span>
    </div>
<?php endforeach ?>
<a href="<?= base_url('admins/products/create')?>">Create new product</a>