<?php 
$prefix = '';

$meta_box = array(
    'id' => 'transaction_info',
    'title' => 'Transaction Details',
    'page' => 'pk_mpesa',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'Service Name',
            'desc' => 'Enter service name ',
            'id' => $prefix . 'service_name',
            'type' => 'text',
        ),
        array(
            'name' => 'Business Number',
            'desc' => 'Enter bussiness name ',
            'id' => $prefix . 'business_number',
            'type' => 'text',
        ),
        array(
            'name' => 'Transaction Referenct',
            'desc' => 'Enter transaction reference',
            'id' => $prefix . 'transaction_reference',
            'type' => 'text',
        ),
        array(
            'name' => 'Transcation Id',
            'desc' => 'Enter transcation Id ',
            'id' => $prefix . 'internal_transaction_id',
            'type' => 'text',
        ),
        array(
            'name' => 'Time stamp',
            'desc' => 'Enter timestamp',
            'id' => $prefix . 'transaction_timestamp',
            'type' => 'text',
        ),
        array(
            'name' => 'Transaction Type',
            'desc' => 'Enter transaction type ',
            'id' => $prefix . 'transaction_type',
            'type' => 'text',
        ),
        array(
            'name' => 'Account Number',
            'desc' => 'Enter  ',
            'id' => $prefix . 'account_number',
            'type' => 'text',
        ),
        array(
            'name' => 'Sender Phone',
            'desc' => 'Enter sender phone number  ',
            'id' => $prefix . 'sender_phone',
            'type' => 'text',
        ),
        array(
            'name' => 'First Name',
            'desc' => 'Enter middle name ',
            'id' => $prefix . 'first_name',
            'type' => 'text',
        ),
        array(
            'name' => 'Middle Name',
            'desc' => 'Enter middle name ',
            'id' => $prefix . 'middle_name',
            'type' => 'text',
        ),
        array(
            'name' => 'Last Name',
            'desc' => 'Enter last name',
            'id' => $prefix . 'last_name',
            'type' => 'text',
        ),
        array(
            'name' => 'Amount',
            'desc' => 'Enter amount ',
            'id' => $prefix . 'amount',
            'type' => 'text',
        ),
        array(
            'name' => 'Currency',
            'desc' => 'Enter currency ',
            'id' => $prefix . 'currency',
            'type' => 'text',
        ),
        array(
            'name' => 'Signature',
            'desc' => 'Enter signature ',
            'id' => $prefix . 'signature',
            'type' => 'text',
        ),
        
       
	array(
            'name' => 'Used',
            'desc' => 'Transaction used ',
            'id' => $prefix . 'used',
            'type' => 'checkbox'
        ),	
    )
);

add_action('admin_menu', 'mpesa_transaction_add_box');

// Add meta box
function mpesa_transaction_add_box() {
	global $meta_box;

	add_meta_box($meta_box['id'], $meta_box['title'], 'mpesa_transaction_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mpesa_transaction_show_box() {
	global $meta_box, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="transaction_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '"><strong>', $field['name'], ':</strong></label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br /><small>', $field['desc'],'</small>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}

	echo '</table>';
}

add_action('save_post', 'transaction_save_data');

// Save data from meta box
function transaction_save_data($post_id) {
	global $meta_box;

	// verify nonce
	

	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}