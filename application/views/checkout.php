<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	.img-style{
		height: 50px;
		width: 50px;
	}
	</style>

	<script>
		function updateCartItem(obj,rowid) {
			$.get("<?php echo base_url('welcome/updateCartItem') ?>",
				{
					rowid : rowid,
					qty : obj.value
				},
				function(resp){
					if(resp == 'ok'){
						location.reload();
					}else{
						alert('cart update fail. Please try again!');
					}
				});
		}

	</script>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<div id="body">
	<div class="row">
		<div class="col-sm-8">
			<h4>Order ID : 
				<?php 
				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$order_id = 'ORD'.substr(str_shuffle($permitted_chars), 0, 8);
 				echo $order_id;
				?>
			</h4>
		</div>
		<div class="col-sm-3">
			<a href="<?= base_url('welcome/cart') ?>" class="pull-right btn btn-primary">> Back To Cart</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<table class="table table-borderd">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($cartItems as $data) { ?>
					<tr>
						<td><img src="<?= base_url('assets/images/').$data['image']; ?>" class="img-style"></td>
						<td><?= $data['name']; ?></td>
						<td><?= $data['price']; ?></td>
						<td><?= $data['qty']; ?></td>
						<td><?= $data['subtotal']; ?></td>
						
					</tr>
				<?php } ?>
				<tr>
					<td colspan="3"></td>
					<td><h4><b>Total : <?= $this->cart->total(); ?></b></h4></td>
					<td></td>
				</tr>
			</tbody>
			</table>
		</div>
		<div class="col-sm-3">
			<form action="<?= base_url('welcome/order') ?>" method="post">
			<input type="hidden" name="orderid" value="<?= $order_id; ?>">
			<input type="hidden" name="total" value="<?= $this->cart->total(); ?>">
				<div class="form-group">
					<label>Name : </label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label>Email : </label>
					<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile Number : </label>
					<input type="text" name="mobile_number" class="form-control">
				</div>
				<div class="form-group">
					<label>Address : </label>
					<input type="text" name="address" class="form-control">
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<button class="btn btn-primary">Pay With InstaMojo</button>
			<button class="btn btn-success">Pay With PayUMoney</button>
			<button class="btn btn-warning">Pay With PayTM</button>
			<button class="btn btn-danger">Pay With Stripe</button>
		</div>
	</div>
	</div>
</div>
</body>
</html>