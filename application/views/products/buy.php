<h2>Buy product: <?= $product->getTitle() ?></h2>
<h3>(available: <?= $product->getAvailability() ?>)</h3>

<?php echo form_open(base_url('products/buy/'. $product->getSlug())) ?>
	<label for="quantity">Desired quantity: </label> 
	<input type="input" name="quantity" value="<?= set_value('quantity', '1')?>" size="30" />
	<?= form_error('quantity','<span class="error">', '</span>'); ?>
	<br />
	<label for="details">Your details: </label> 
	<input type="input" name="details" value="<?= set_value('details') ?>" size="30" />
	<?= form_error('details','<span class="error">', '</span>'); ?>
	<br />
	<label for="email">Your e-mail: </label> 
	<input type="input" name="email" value="<?= set_value('email') ?>" size="30" />
	<?= form_error('email','<span class="error">', '</span>'); ?>
	<br />
	<input type="submit" name="submit" value="Buy this product" /> 
</form>