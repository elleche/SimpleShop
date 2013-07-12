<?php echo form_open(base_url( isset($product) ? 'admins/products/edit/'.$product->getId() : 'admins/products/create')) ?>
	<label for="title">Title: </label> 
	<input type="input" name="title" value="<?= set_value('title', (isset($product) ? $product->getTitle() : ''))?>" size="30" />
	<?= form_error('title','<span class="error">', '</span>'); ?>
	<br />
	<label for="price">Price: </label> 
	<input type="input" name="price" value="<?= set_value('price', (isset($product) ? $product->getPrice() : '0')) ?>" size="30" />
	<?= form_error('price','<span class="error">', '</span>'); ?>
	<br />
	<label for="availability">Availability: </label> 
	<input type="input" name="availability" value="<?= set_value('availability', (isset($product) ? $product->getAvailability() : '0')) ?>" size="30" />
	<?= form_error('availability','<span class="error">', '</span>'); ?>
	<br />
	<input type="submit" name="submit" value="Save" /> 
</form>