<div>
	<h2><?= $product->getTitle()?></h2>
	Price: <?= $product->getPrice()?>
	<br>
	Availability: <?= $product->getAvailability()?>
	<br>	
    <p><a href="<?= base_url('products/buy/'. $product->getSlug()) ?>">Buy this product</a></p>
</div>