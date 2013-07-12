</h2><?= 'Compose a mail to send to all subscribed contacts, (using the placeholders {} ??)' ?></h2>

<?php echo form_open(base_url( 'admins/newsletters')) ?>
	<label for="to">To: </label> 
	<input type="input" name="to" value="<?= set_value('to')?>" size="30" />
	<?= form_error('to','<span class="error">', '</span>'); ?>
	<br />
	<label for="from">From: </label> 
	<input type="input" name="from" value="<?= set_value('from'))?>" size="30" />
	<?= form_error('from','<span class="error">', '</span>'); ?>
	<br />
	<label for="subject">Subject: </label> 
	<input type="input" name="subject" value="<?= set_value('subject', 'subject here')?>" size="30" />
	<?= form_error('subject','<span class="error">', '</span>'); ?>
	<br />
	<label for="body">Body: </label> 
	<input type="input" name="body" value="<?= set_value('body')) ?>" size="30" />
	<?= form_error('body','<span class="error">', '</span>'); ?>
	<br />
	<input type="submit" name="submit" value="Send" /> 
</form>