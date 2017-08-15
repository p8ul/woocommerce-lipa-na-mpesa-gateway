<?php

class PK_Mpesa_Post_Type{
	public function __construct(){
		$this->register_post_type();
		$this->taxonomies();		
	}

	public function register_post_type()
	{

		$args = array(
			'labels' => array(
				'name'=>'Mpesa',
				'singular_name'=>'Mpesa',
				'add_new'=>'Add New Mpesa',
				'add_new_item'=>'Add New Mpesa',
				'edit_item'=>'Edit item',
				'new_item'=>'Add New Item',
				'view_item'=>'View Mpesa',
				'search_item'=>'Search Mpesa ',
				'filter_items_list'=>'Filter Payments',
				'not_found'=>'No Mpesa found',
				'not_found_in_trash'=>'No Mpesa Found in Trash'
				),
			'query_var'=>'Mpesa',
			'rewrite'=> array(
				'slug'=> 'Mpesa',
				),
			'public' => true,
			'menu_icon'=>admin_url().'images/media-button-2x.png',
			'supports'=> array('title',),
			'show_in_rest'=>true,
			'rest_base' => 'Mpesa',
			'rest_controller_class'=>'WP_REST_Posts_Controller'


			);
		register_post_type('PK_Mpesa',$args);
	}

	public function taxonomies()
	{
		$taxonomies = array();
		$taxonomies['genre'] = array(
				'hierarchical'=>true,
				'query_var'=>'Mpesa_genre',
				'rewrite'=> array(
						'slug'=>'Mpesa/genre'
					),
				'labels'=>array(
						'name'=>'Genre',
						'singular_name'=>'Genre',
						'edit_item'=>'Edit Genre',
						'update_item'=>'Update Genre',
						'add_new_item'=>'Add Genre',
						'new_item_name'=>'Add New Genre',
						'all_items'=>'All Genres',
						'search_item'=>'Search Genre',
						'popular_items'=>'Popular Genres',
						'seperate_items_with_comments'=>'Seperate Genres with comments',
						'add_or_remove_items'=>'Add or Remove Genres',
						'choose_from_most_used'=>'Choose from most used Genres'
					),
			);
		$this->register_all_taxonomies($taxonomies);
	}

   public function register_all_taxonomies($taxonomies)
   {
   	 foreach ($taxonomies as $name => $arr) {
   	 	register_taxonomy($name, array('PK_Mpesa'),$arr);
   	 }
   }

}

add_action('init', 'mpesa_post_type');
function mpesa_post_type()
{
	new PK_Mpesa_Post_Type();
}