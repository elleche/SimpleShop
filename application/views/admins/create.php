<?php echo form_open(base_url( isset($admin) ? 'admins/edit/'.$admin->getId() : 'admins/create/')) ?>
	<label for="name">User name: </label> 
	<input type="input" name="name" value="<?= set_value('name', (isset($admin) ? $admin->getUsername() : ''))?>" size="30" />
	<?= form_error('name','<span class="error">', '</span>'); ?>
	<br />
	<label for="password">Password: </label> 
	<input type="password" name="password" value="<?= set_value('password') ?>" size="30" />
	<?= form_error('password','<span class="error">', '</span>'); ?>
	<br />
	<label for="email">E-mail: </label> 
	<input type="input" name="email" value="<?= set_value('email', (isset($admin) ? $admin->getEmail() : '')) ?>" size="30" />
	<?= form_error('email','<span class="error">', '</span>'); ?>
	<br />
	<input type="submit" name="submit" value="Save" /> 
</form>