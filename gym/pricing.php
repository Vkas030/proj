<?php include 'esewa/dbconfig.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vyayamlaya</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		</head>
	<body>
			<!-- Header Section -->
	<?php include 'pricing_header.php';?>
		<div class="container" >
			<div class="pt-md-5">
				<div class="row">
					
					<?php while( $product = mysqli_fetch_assoc($result)) {?>
					<div class="col-md-4">
						<div class="card mb-5" style="width: 18rem;">
							<div class="imagecontainer" style="height: 200px;">
								<img src="esewa/image/<?php echo $product['image']?>" class="card-img-top" alt="..." style="width: 100%; height: 100%;">
							</div>
							<div class="card-body">
								<h5 class="card-title"><?php echo $product['title'];?></h5>
								<p class="card-text">Rs. <?php echo $product['amount'];?></p>
								<p class="card-text"><?php echo $product['description'];?></p>

								<form method="post" action="esewa/checkout.php">
									<input type="hidden" name="product_id" value="<?php echo $product['id'];?>">
									<input type="submit" name="submit" value="Buy Now" class="btn btn-success" style="background-color: #428f9d; border:none;">
								</form>
							</div>
						</div>
					</div>
					<?php }?>
					
				</div>
			</div>
		</div>
		<!-- Footer Section -->

		<?php include 'include/footer.php'; ?>
	</body>
		
</html>