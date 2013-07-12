</h2>Administrator's login:</h2>
<?php echo form_open(base_url('admins/login/')) ?>
	<label for="name">User name: </label> 
	<input type="input" name="name" value="<?= set_value('name')?>" size="30" />
	<?= form_error('name','<span class="error">', '</span>'); ?>
	<br />
	<label for="password">Password: </label> 
	<input type="password" name="password" value="<?= set_value('password') ?>" size="30" />
	<?= form_error('password','<span class="error">', '</span>'); ?>
	<br />
	<input type="submit" name="submit" value="Log in" /> 
</form>