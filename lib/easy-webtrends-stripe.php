<?php
/**
 * Complete integration with Stripe
 */
class EasyWebtrendsStripe {
    var $customer_id = 0;
    var $period_end = 0;
    var $period_start = 0;
    var $email = "";
    var $subscriptions_id =  0;
    var $confirm_time = 0;
    var $namespace = "";
    var $message = array();
    
    /**
     * Constructor
     * @uses Stripe\Customer::retrive
     * @uses Stripe\Subsciprtion::update
     */
    function __construct( $namespace ){
        $this->namespace = $namespace;

        $this->message["expired"] = __( EASYWEBTRENDS_NAME . " was expired to use, please payment", $this->namespace );
        $this->message["warning"] = __( EASYWEBTRENDS_NAME . " will expire in %s day",  $this->namespace );
        $this->message["success"] = __( "You paid sucessful", $this->namespace );

        $stripe = $this->get();
        if( !empty( $stripe ) ) {
            $this->customer_id  = $stripe["id"];
            $this->period_end   = $stripe["period_end"];
            $this->period_start = $stripe["period_start"];
            $this->email 		= $stripe["email"];
            $this->subscriptions_id = $stripe["subscriptions_id"];
            $this->confirm_time = $stripe["confirm_time"];

            // update data if confirm_time < now;
            if ( $this->confirm_time < strtotime( "now" ) ){
                $customer = \Stripe\Customer::retrieve( $this->customer_id );
                $this->period_start = $customer->subscriptions->data[0]->current_period_start;
                $this->period_end   = $customer->subscriptions->data[0]->current_period_end;
                $this->email 		= $customer->email;
                $this->subscriptions_id = $customer->subscriptions->data[0]->id;
                $this->confirm_time = strtotime( "now" );
                // update option
                $this->update();
            }
        }
    }
    /**
     * Get remaining active days
     * @return Number days
     */
    public function rest_number_day(){
        $time =  $this->period_end - strtotime( "now" );
        if( $time > 0 ){
            return round( $time/86400 + 0.5 );
        }
        return 0;
    }
    /**
     * Determine valid active time
     * @return Bool True: out of date
     */
    public function out_of_date(){
        if( $this->rest_number_day() == 0 ){
            return true;
        }
        return false;
    }
    /**
    * Check customer exist follow email
    */
    public function customer_exist( $email ){
        echo $this->email == $email;
        return $this->email == $email;
    }
    /**
     * Create Stripe Customer
     * @param  StripeToken   $token submitted data
     * @param  StripePlan    $plan  plan defined from Stripe
     * @param  CustomerEmail $email customer email submitted
     * @uses   Customer::create
     */
    public function create_customer( $token, $plan, $email ){
        $customer = \Stripe\Customer::create(array(
          "source" => $token,
          "plan" => $plan,
          "email" => $email )
        );
        // get the latest customer id which return from Stripe
        $this->customer_id  = $customer->id;
        $this->period_end   = $customer->subscriptions->data[0]->current_period_end;
        $this->period_start = $customer->subscriptions->data[0]->current_period_start;
        $this->email 		= $customer->email;
        $this->subscriptions_id = $customer->subscriptions->data[0]->id;
        $this->confirm_time = strtotime( "now" );

        // update wp options
        $this->update();
    }

    /**
     * Create StripeSubscriptions
     * @param  StripeToken $token submitted data
     * @param  StripePlan $plan  defined plan from Stripe
     * @uses   Customer::retrieve
     * @uses   update_option
     */
    public function create_subscriptions( $token, $plan ){
        $data = array(
            "plan" => $plan,
            "source" => $token
        );
        try {
	        $customer = \Stripe\Customer::retrieve( $this->customer_id );
	        $subscriptions = $customer->subscriptions->create( $data );

	        $this->subscriptions_id = $subscriptions->id;
	        $this->period_start = $subscriptions->current_period_start;
	        $this->period_end   = $subscriptions->current_period_end;
	        $this->confirm_time = strtotime( "now" );
	        $this->update();
        } catch (Exception $e) {
        	// can't get customer
        	$this->subscriptions_id = 0;
	        $this->period_start = 0;
	        $this->period_end   = 0;
	        $this->confirm_time = strtotime( "-1 day" );
	        $this->update();
        }
    }
    /**
     * Get all WP Options
     * @return Wordpress Options
     */
    public function get(){
        return get_option( $this->namespace.'-stripe', array() );
    }

    /**
     * Update all option use for this plugin
     * @uses update_option
     */
    public function update(){
        update_option( $this->namespace.'-stripe', array(
            "id" => $this->customer_id,
            "period_end" => $this->period_end,
            "period_start" => $this->period_start,
            "email" => $this->email,
            "subscriptions_id" => $this->subscriptions_id,
            "confirm_time" => $this->confirm_time
        ) );
    }
}