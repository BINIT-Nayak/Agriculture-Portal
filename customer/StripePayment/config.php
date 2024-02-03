<?php
	require_once "stripe-php-master/init.php";
	require_once "products.php";

$stripeDetails = array(
		"secretKey" => "sk_test_51OEIDoSGKA3c3x4w0quuo6s0a2MnVMmrp5M7AML4U9jnNUDxOODKC6ELJaEISkU0ejvx9rry0r23EXnJDhCO8ZgY00SpFXeHcI",  //Your Stripe Secret key
		"publishableKey" => "pk_test_51OEIDoSGKA3c3x4wKCubJt2z82b8yfWmR5tQ9EByUGeFBSNoT9G6aD08h0mrVp5ng3O0kHtYYuMXCBCZWUs52O3D00Jfx3fyuT"  //Your Stripe Publishable key
	);

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);

	
?>
