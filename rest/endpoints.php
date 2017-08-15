<?php

// REST API endpoints
add_action('rest_api_init',function(){
	register_rest_route('myplugin/v2','/mpesa/',array(
		'methods'=>'POST',
		'callback'=>'create_Mpesa',
		
		)
	);
});

function create_Mpesa($data)
{
  $my_post = array(
  		'post_title' => $data['first_name'].' '.$data['last_name'],  		  		
  		'post_type'  => 'pk_mpesa',
  		'post_status' => 'publish',
      'amount'=>$data['amount'],
  		'service_name' => $data['service_name'],
      'first_name'=>$data['first_name'],
      'business_number'=>$data['business_number'],
      'transaction_reference'=>$data['transaction_reference'],
      'internal_transaction_id'=>$data['internal_transaction_id'],
      'transaction_timestamp'=>$data['transaction_timestamp'],
      'transaction_type'=>$data['transaction_type'],
      'account_number'=>$data['account_number'],
      'sender_phone'=>$data['sender_phone'],
      'middle_name'=>$data['middle_name'],
      'last_name'=>$data['last_name'],      
      'currency'=>$data['currency'],
      'signature'=>$data['signature'],
      

  	);	

  // insert the post into the database
  $post_id = wp_insert_post($my_post);
  if(!is_wp_error($post_id)){
  	//the post is validd
  	echo 'Post saved successfully<br>';
 }else{
  	echo $post_id->get_error_message();
  }
}