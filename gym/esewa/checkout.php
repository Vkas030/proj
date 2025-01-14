<?php
include 'dbconfig.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$product_id = $_POST['product_id'];
	$sql = "SELECT * FROM products WHERE id='$product_id'";
	$result = mysqli_query($conn, $sql);
	if($result)
	{
		if ( mysqli_num_rows($result) == 1)
		{
			$product = mysqli_fetch_assoc($result);
			$invoice_no = $product['id'] . time();
			$total  = $product['amount'];
			$created_at = date('Y-m-d H:i:s');
			$query = "INSERT INTO orders(product_id,invoice_no, total,status, created_at )
					VALUES( '$product_id','$invoice_no', '$total',0, '$created_at')";
			if( !mysqli_query($conn, $query))
			{
				die('Error!');
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="container -center ">
        <div class="pt-md-5">
            <center>
            <div class="col-md-10">
                <h2>Order Details</h2>
                <div class="col">
                    <div class="col-md-4">
                        <div class="card" stylea="width: 18rem;">
                            <div class="imagecontainer" style="height: 150px;">
                                <img src="image/<?php echo $product['image']?>" class="card-img-top" alt="..."
                                    style="width: 100%; height: 100%;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['title'];?></h5>
                                <p class="card-text">Rs. <?php echo $product['amount'];?></p>
                                <p class="card-text"><?php echo $product['description'];?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3>Book With</h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                    <input value="<?php echo $total;?>" name="tAmt" type="hidden">
                                    <input value="<?php echo $total;?>" name="amt" type="hidden">
                                    <input value="0" name="txAmt" type="hidden">
                                    <input value="0" name="psc" type="hidden">
                                    <input value="0" name="pdc" type="hidden">
                                    <input value="epay_payment" name="scd" type="hidden">
                                    <input value="<?php echo $invoice_no;?>" name="pid" type="hidden">
                                    <input value="./esewa_payment_success.php" type="hidden"
                                        name="su">
                                    <input value="./esewa_payment_failed.php" type="hidden"
                                        name="fu">
                                    <input type="image" src="image/Esewa.png">
                                    </from>
                        </ul>

                    </div>

                </div>
            </div>
            </center>
        </div>
    </div>
</body>

</html>