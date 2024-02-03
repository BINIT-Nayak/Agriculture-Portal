<?php 

// include ('csession.php');
include ('../sql.php');


	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	// Check whether stripe token is not empty
	$ind_currency="Rupees";
	if(!empty($_POST['stripeToken'])){

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		$price=$_POST['amount'];

		

		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51OH06pFzrawjdg7jy2AeadjlYL5YDpolu3AzV1OsLZtPFvEFwZWZ7Eb8SOTxtA84kR1Uk0k6N07HdEEgK5374QzH00amVkx7j0",
		"PublishableKey"=>"pk_test_51OH06pFzrawjdg7jzQyJJt4olS7swCxUFfk0g2Pl71AfHfQ5P8rbBIEntR49bO3e3YMQtvEoPAjAFGwtbEej0dGy00a4gOSuCm"
		);

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>$price
	    ));

	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
		$convert= ceil($price/80);
	    $itemPrice = ($convert*100);
	    $currency = "usd";
	   

	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => $price, 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['id'];  
	        $paidAmount = ($chargeJson['amount']); 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');

	        // Insert tansaction data into the database

	        $sql = "INSERT INTO `payment` (`id`, `name`, `email`, `Amount`, `card_number`, `card_expm`, `card_expy`, `status`, `paymentid`, `added_date`) VALUES ('', '$name', '$email', '$price', '$card_no', '$card_exp_month', '$card_exp_year', '$payment_status', '$transactionID', '$payment_date')";
			
			// INSERT INTO `payment` values ('".$name."','".$email."','".$course."','".$price."','".$card_no."','".$card_exp_month."','".$card_exp_year."','".$payment_status."','".$transactionID."','".$dt_tm."')
			
			
	        mysqli_query($conn,$sql) or die("Mysql Error Stripe-Charge(SQL)".mysqli_error($con));
 
    		

	        // If the order is successful 
	        if($payment_status == 'succeeded'){ 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	        //print '<pre>';print_r($chargeJson); 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
	    $statusMsg = "Error on form submission."; 
	} 
	
?>

<!DOCTYPE html>
<html>
	<head>
        <title> Stripe Payment Gateway Integration in PHP </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
		<style>
			body{
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }
            .wrapper{
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .card{
                width: 400px;
                height: 500px;
                background: #fff;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
                border-radius: 3px;
                padding: 20px;
            }
			.form-control{
				width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
			}
			.heading{
				text-align: center;
				margin-bottom: 20px;
				font-size: 20px;
				font-weight: 600;
				color: #333;
			}
			.form-group{
                margin-bottom: 20px;
            }
			.container{
				width: 100%;
			}
			.status{
				text-align: center;
                margin-bottom: 20px;
                font-size: 20px;
                font-weight: 600;
                color: #333;
			}
			.status-msg{
				text-align: center;
                margin-bottom: 20px;
                font-size: 20px;
                font-weight: 600;
                color: #333;
			}
			.button{
				width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
                margin-top: 20px;
			}
			.button:hover{
                background: #333;
                color: #fff;
            }
			.button:active{
                background: #333;
                color: #fff;
            }
			.bold{
				font-weight: 600;
				color: #333;
				font-size: 20px;
				margin-bottom: 20px;
				margin-top: 20px;
				text-align: center;
				font-family: "Helvetica Neue"
			}
			.error{
                color: red;
            }
			.success{
                color: green;
            }
			.error-msg{
				text-align: center;
                margin-bottom: 20px;
                font-size: 20px;
                font-weight: 600;
                color: #333;
			}
			
		</style>
    </head>

    <div class="container">
        <br>
        <div class="row">
	        <div class="col-lg-12">
				<div class="status">
					<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
				
					<h4 class="heading">Payment Information - </h4>
					<br>
					
					<p><b class="bold">Transaction ID:</b> <?php echo $transactionID; ?></p>
					<p><b class="bold">Paid Amount:</b> <?php echo ($paidAmount*0.8).' '.$ind_currency; ?> ($<?php echo $convert;?>.00)</p>
					<p><b class="bold">Payment Status:</b> <?php echo $payment_status; ?></p>
					<!-- <h4 class="heading">Product Information - </h4> -->
					<br>
					<p><b class="bold">Name:</b> <?php echo $name; ?></p>
					<p><b class="bold">Price:</b> <?php echo ($paidAmount*0.8).' '.$ind_currency; ?> ($<?php echo $convert;?>.00)</p>
				</div>
				<a href="cprofile.php" class="btn btn-success">Back to Home</a>
			</div>
		</div>
	</div>
</html>