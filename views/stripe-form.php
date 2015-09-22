<?php
	if( isset( $_POST['stripeToken'] ) ){
		$token  = $_POST['stripeToken'];
		$email  = $_POST['stripeEmail'];
		// create new customer.
		if( !$this->stripe->customer_exist( $email ) ){
			$this->stripe->create_customer( $token, STRIPE_PLAN, $email );
		}else{
			$this->stripe->create_subscriptions( $token, STRIPE_PLAN );
		}
?>
	<h2 class="header">
	    <?php echo $this->stripe->message["success"]; ?>
	</h2>
<?php 
	}
	if( $this->stripe->out_of_date() ){
?>
	<form action="" method="post">
	  	<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	          data-key="<?php echo STRIPE_PK; ?>"
	          data-name = "WP Cookies Premiums"
	          data-description="Pro Account 1 Month"
	          data-amount="5000"
	          data-locale="<?php echo ICL_LANGUAGE_CODE; ?>"></script>
	</form>
<?php 
	}
?>