<html>
<head>
	<title><?php echo $title ?> - My Webshop Admin Panel</title>
</head>
<body>
	<p>
		<a href="<?= base_url('admins/logout')?>">Admin logout</a>
		<a href="<?= base_url('admins/index')?>">My details</a>
		<a href="<?= base_url('admins/adminslist')?>">All users</a>
		<a href="<?= base_url('admins/create')?>">Create user</a>
        <a href="<?= base_url('admins/products')?>">Products</a>
        <a href="<?= base_url('admins/orders')?>">Orders</a>
        <a href="<?= base_url('admins/contacts')?>">Contacts</a>
  <!--      <a href="<?= base_url('admins/newsletters')?>">Newsletters</a>  -->
	</p>
	<h1>Admin Panel</h1>