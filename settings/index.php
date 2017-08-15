<?php
/**
 * 
 * Description:  Plugin settings 
 * Version: 1.0
 * Author: P8ul K
 * Author URI: http://kampozone.com
 * License: GNU General Public License v3 or later
 */
class PK_Options{
	public $options;
	public function __construct()
	{
		$this->options = get_option('pk_plugin_options');
		$this->register_settings_and_fields();
	}

	public function add_menu_page()
	{
		add_options_page('Mpesa options','Mpesa Options','administrator',__FILE__,array('PK_Options','display_options_page'));
	}

	public function display_options_page()
	{
	  ?>
	  <div class="wrap">
	  	<?php screen_icon();?>
	  	<h2>My Theme Options</h2>
	  	<form method='post' action='options.php' enctype="multipart/form-data">
	  	<?php settings_fields('pk_plugin_options');?>
	  	<?php do_settings_sections(__FILE__);?>

	  	<p class="submit">
	  		<input type='submit' class="button-primary" value="Save changes">
	  	</p>
	  	</form>
	  </div>
	  <?php
	}
    public function register_settings_and_fields()
    {
    	register_setting('pk_plugin_options','pk_plugin_options');//3rd param optional
    	add_settings_section('pk_main_section','Main settings',array($this,'pk_main_section_cb'),__FILE__);//id,title of section,cb,
    	add_settings_field('banner_heading','Banner Heading',array($this,'pk_banner_heading_setting'),__FILE__,'pk_main_section');
    	add_settings_field('banner','Banner Image',array($this,'pk_banner'),__FILE__,'pk_main_section');
    }

    public function pk_main_section_cb()
    {
    	//optional
    }

    /*
     *
     *inputs
     */
    //banner heading
    public function pk_banner_heading_setting()
    {
    	echo "<input name='pk_plugin_options[banner_heading]' value='{$this->options['banner_heading']}' type='text'/>";
    }
    // banner file
    public function pk_banner()
    {
    	echo "<input name='pk_plugin_options['banner']' type='file'/>";
    }
}

add_action('admin_menu','init');
function init()
{
	PK_Options::add_menu_page();
}

add_action('admin_init',function(){
	new PK_Options();
});