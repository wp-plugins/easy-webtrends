<?php
	if( !class_exists( "\\Stripe\\Stripe" ) ){
	    require_once( "init.php" );
	}
	\Stripe\Stripe::setApiKey(STRIPE_SK);