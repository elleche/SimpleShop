</h2><?= $title ?></h2>
<?php foreach ($orders as $order): ?>
    <div id="main">
		<?= 'Date: ' . $order->getOrderDate() ?>
		<?= 'Buyer details: ' . $order->getBuyerDetails() ?>
		<?= 'Buyer E-mail: ' . $order->getBuyerEmail() ?>
		<?= 'Product title: ' . $order->getProductTitle() ?>
		<?= 'Product quantity: ' . $order->getProductQuantity() ?>
		<?= 'Total amount: ' . $order->getOrderAmount() ?>
    </div>
<?php endforeach ?>