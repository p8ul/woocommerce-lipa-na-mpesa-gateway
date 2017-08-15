<?php 

add_filter('manage_pk_mpesa_posts_columns','filter_cpt_columns');
function filter_cpt_columns($columns)
{
	unset( $columns['date'] );
	$custom = array(	
	        'title'  => 'Sender Name',
	        'sender_phone'=>'Sender Phone',
	        'used'=>'Used',
	        'amount'=>'Amount',		
			'transaction_reference' => 'Reference',		
			'currency'=>'Currency',
			'internal_transaction_id'=>'Transaction Id',
			'date'=>'Date'	
		);
	
	//add more columns as needed

	return wp_parse_args( $custom, $columns );
	
}

add_action('manage_pk_mpesa_posts_custom_column','action_custom_column_content',0,2);

function action_custom_column_content($column_id,$post_id)
{
	//run a switch statement for all of the custom columns created
	switch ($column_id) {
		case 'amount':
		    echo($value=get_post_meta($post_id,'amount',true)) ? $value:'<span class="na">&ndash;</span>';
			break;	
		case 'transaction_reference':
		    echo($value=get_post_meta($post_id,'transaction_reference',true)) ? $value:'<span class="na">&ndash;</span>';
			break;
		case 'currency':
		    echo($value=get_post_meta($post_id,'currency',true)) ? $value:'<span class="na">&ndash;</span>';
			break;
		case 'used':
		    echo($value=get_post_meta($post_id,'used',true)) ? $value:'<span class="na">&ndash;</span>';
			break;
		case 'internal_transaction_id':
		    echo($value=get_post_meta($post_id,'internal_transaction_id',true)) ? $value:'<span class="na">&ndash;</span>';
			break;			
		case 'sender_phone':
		    echo($value=get_post_meta($post_id,'sender_phone',true)) ? $value:'<span class="na">&ndash;</span>';
			break;
		case 'date':
		    echo($value=get_post_meta($post_id,'date',true)) ? $value:'';
			break;
		case 'transaction_reference':
		    echo($value=get_post_meta($post_id,'transaction_reference',true)) ? $value:'<span class="na">&ndash;</span>';
			break;
		
		default:
			# code...
			break;
	}
}