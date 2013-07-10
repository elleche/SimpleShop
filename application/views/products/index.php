<?php foreach ($products as $product): ?>

    <h2><?= 'Product name: ' . $product->getTitle() ?></h2>
    <div id="main">
        <?= 'Product price: ' . $product->getPrice()?> 
		</br>
        <?= 'Availability: ' . $product->getAvailability()?>
    </div>
    <p><a href="<?= base_url('products/' . $product->getSlug())?>">View product details</a></p>

<?php endforeach ?>


<!--htmlspecialchars(, ENT_QUOTES, 'UTF-8') -> getField_clean() -->