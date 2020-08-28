<?php
/*
Plugin Name: isItOpen
Plugin URI: https://github.com/Skwangles/WordpressPlugin-IsItOpen
Description: Indicator for if the shop is open
Author: Tree_house
Author URI: https://github.com/Skwangles
Version: 2.0
*/
function my_enqueue($hook) {

wp_enqueue_script( 'ajax-script', plugins_url("/js/my-jquery.js",__FILE__), array('jquery'));

	
wp_localize_script( 'ajax-script', 'my_ajax_object', array(
'ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action('admin_enqueue_scripts', 'my_enqueue');

//
//Gets the bool from the SQL table, and checks if it exists otherwise it creates it.
//
$default_value = FALSE;
if (FALSE === get_option('my_option') && FALSE === update_option('my_option',FALSE)) add_option('my_option',$default_value);

$isOpen = get_option('my_option'); //sets the $isOpen variable to the sql version of the item;

function setIsOpen($isOpen){
	update_option('my_option', $isOpen);	
}//after each set of $isOpen, it updates the database version.

add_action("admin_menu", "addMenu");
function addMenu()
{
	add_menu_page("Shop Open Indicator", "Shop Open Indicator", 4, "ShopIndicator", "SettingOpenMenu" );
  
}
function OpenText(){
if(get_option('my_option'))	
	echo '<script>setTrue(true);</script>';
else{	
	echo '<script>setTrue(false)</script>';
}}


function SettingOpenMenu()
{
echo <<< 'EOD'
	<p name="statusDisplay" id="status"></p>
	<br>
	<button name="openShopBtn" onclick='openShop()'>Indicate Open</button>
	<button name="closeShopBtn" onclick="closeShop()">Indicate Closed</button>

EOD;
	OpenText();
}


function open_pressed(){
	
	update_option('my_option', TRUE); 
	
	wp_send_json("Shop Opened");
}

function close_pressed(){
	
	update_option('my_option', FALSE); 
	
	wp_send_json("Shop Closed");
    
	
}

add_action("wp_ajax_open_pressed","open_pressed");
add_action("wp_ajax_close_pressed","close_pressed");
//add_action("wp_ajax_no_priv_open_pressed","open_pressed");
//add_action("wp_ajax_no_priv_close_pressed","close_pressed"); 
//Done to prevent unlogged in users 


//
//
//function that runs when shortcode is called
//
function wpb_OpenClosed_Shortcode() 
{ 
								
	
if(get_option('my_option') == TRUE){
					$string .= '<div id="demobox">
						Our shop is OPEN right now!
						</div>						
						<style>
						#demobox {
   						background-color: #cfc ;
  						margin:auto;
						font-size: 20px;
						text-align: center;
  						border: 1px solid green ;
						width: 40%;
						height: 60px;
						font-weight: bold;
						}
						</style>'; 
}
elseif (get_option('my_option') == FALSE)
{
	$string .= "";
}
else
{
$string .= "";
}
					// Output needs to be return
						//return $string;
			
	
	return $string;
} 
		// register shortcode
		add_shortcode('OpenClosed', 'wpb_OpenClosed_Shortcode');
?>
