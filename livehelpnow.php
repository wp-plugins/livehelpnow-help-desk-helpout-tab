<?php
/**
 * @package LiveHelpNow Help Desk
 * @author LiveHelpNow
 * @version 1.0.1
 */
/*
Plugin Name: LiveHelpNow Help Desk -- HelpOutTabe
Plugin URI: http://www.livehelpnow.net
Description: live chat button plugin by LiveHelpNow
Author: LiveHelpNow
Version: 1.0.1
Author URI: http://www.livehelpnow.net
*/
 
/**
* Actions and Filters
*
* Register any and all actions here. Nothing should actually be called
* directly, the entire system will be based on these actions and hooks.
*/
add_action( 'widgets_init', create_function( '', 'register_widget("Livehelpnow_Widget");' ) );
add_action('admin_print_styles-widgets.php', 'lhn_widgets_styles');
 
/**
* This is the class that you'll be working with. Duplicate this class as many times as you want. Make sure
* to include an add_action call to each class, like the line above.
*
* @author byrd
*Empty
*/
require_once('widget.class.php');
class Livehelpnow_Widget extends Livehelpnow_Widget_Abstract
{
/**
* Widget settings
*
* Simply use the following field examples to create the WordPress Widget options that
* will display to administrators. These options can then be found in the $params
* variable within the widget method.
*
*
*/
protected $widget = array(
// you can give it a name here, otherwise it will default
// to the classes name. BTW, you should change the class
// name each time you create a new widget. Just use find
// and replace!
'name' => 'LiveHelpNow Help Desk -- HelpOut Tab',
 
// this description will display within the administrative widgets area
// when a user is deciding which widget to use.
'description' => 'Widget to add LiveHelpNow\'s HelpOut Tab to your Wordpress website.',
 
// determines whether or not to use the sidebar _before and _after html
'do_wrapper' => true,
 
// determines whether or not to display the widgets title on the frontend
'do_title'	=> false,
 
// string : if you set a filename here, it will be loaded as the view
// when using a file the following array will be given to the file :
// array('widget'=>array(),'params'=>array(),'sidebar'=>array(),
// alternatively, you can return an html string here that will be used
'view' => false,
// If you desire to change the size of the widget administrative options
// area
'width'	=> 750,
'height' => 350,
// Shortcode button row
'buttonrow' => 4,
// The image to use as a representation of your widget.
// Whatever you place here will be used as the img src
// so we have opted to use a basencoded image.
'thumbnail' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAgAAAQABAAD//gAEKgD/2wBDAAUDBAQEAwUEBAQFBQUGBwwIBwcHBw8LCwkMEQ8SEhEPERETFhwXExQaFRERGCEYGh0dHx8fExciJCIeJBweHx7/2wBDAQUFBQcGBw4ICA4eFBEUHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh7/wgARCAAUABQDACIAAREBAhEB/8QAGQAAAgMBAAAAAAAAAAAAAAAAAQUDBAYH/8QAFwEBAQEBAAAAAAAAAAAAAAAAAgMAAf/EABcBAQEBAQAAAAAAAAAAAAAAAAIDAAH/2gAMAwAAARECEQAAAd1NnV5p0q2ldY0qLuHjnILl/8QAGhAAAgMBAQAAAAAAAAAAAAAAAwQBAgUAEv/aAAgBAAABBQLR0hiYH7sFM9GV3U7S6pkPCNj1iFWVhH6Eqknv/8QAGREBAAMBAQAAAAAAAAAAAAAAAQACERAh/9oACAECEQE/AVzwlqmyq5z/xAAYEQACAwAAAAAAAAAAAAAAAAAAARARMf/aAAgBAREBPwHSxx//xAAqEAACAQEFBQkAAAAAAAAAAAABAgMABBESFDEFITJBoRATNEJRYnGB4f/aAAgBAAAGPwLuDao7MBxO28/AFZix7RzCjUOVKn7GlJMmjdKlezrJng96EEYcB9b+WtSQWjwRcNKEbCG/BRZFwxu5ZB7eVAteHXhdTcRV0888yjyud3Ts/8QAHxAAAgIBBAMAAAAAAAAAAAAAAREAITFBUXGBkaGx/9oACAEAAAE/IT5Q1rM+kycOGaO+dyAIDSloFg6sEeYz27IWsc8FbS1EVOtm+wVF+JsJNo4D7gEf5hMxwbYr8gA+4AghQn//2gAMAwAAARECEQAAEKOMiP/EABwRAQABBAMAAAAAAAAAAAAAAAEAEBEhMUGh8P/aAAgBAhEBPxB2BixwN/dQDCCWdap//8QAGREBAQEAAwAAAAAAAAAAAAAAAREAECGx/9oACAEBEQE/EAir35hTAvH/xAAbEAEBAQEBAQEBAAAAAAAAAAABESEAQTFRYf/aAAgBAAABPxCJWQrsBIigoSQIrhnchRFVYhuqGUnUIQxKKomKBKYynCVjmiAqAKsLYfICkc2VqFCsBRICVCCxg02iPAgD85qI1G76DsfRo+nGcCQ4aTe/KP5xAAGAfDv/2Q==',
/* The field options that you have available to you. Please
* contribute additional field options if you create any.
*
*/
'fields' => array(
// You should always offer a widget title
array(
'name' => 'LiveHelpNow Account#',
'desc' => '',
'id' => 'clientid',
'type' => 'text',
'default' => ''
),
array(
'name' => 'Chat Window',
'desc' => '',
'id' => 'livehelpnow_lhnWindowN',
'type' => 'text',
'default' => '0'
),
array(
'name' => 'Enable automatic chat invitation',
'desc' => '',
'id' => 'livehelpnow_lhnInviteEnabled',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
array(
'name' => 'HelpOut tab color theme',
'desc' => '',
'id' => 'livehelpnow_lhnTheme',
'type' => 'select',
'options' => array(
'default' => 'default',
'red' => 'red',
'orange' => 'orange',
'yellow' => 'yellow',
'green' => 'green',
'blue' => 'blue',
'purple' => 'purple'
)
),
array(
'name' => 'Enable slideout panel',
'desc' => 'Uncheck if you will only be using the Live Chat system',
'id' => 'livehelpnow_lhnHPPanel',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
//Enable chat button:	Uncheck to hide the 'chat with us' option
array(
'name' => 'Enable chat button',
'desc' => 'Uncheck to hide the "chat with us" option',
'id' => 'livehelpnow_lhnHPChatButton',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
//Enable ticket button:	Uncheck to hide the 'submit a ticket' option
array(
'name' => 'Enable ticket button',
'desc' => 'Uncheck to hide the "submit a ticket" option',
'id' => 'livehelpnow_lhnHPTicketButton',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
//Enable callback button:	Uncheck to hide the 'request callback' option
array(
'name' => 'Enable callback button',
'desc' => 'Uncheck to hide the "request callback" option',
'id' => 'livehelpnow_lhnHPCallbackButton',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
//Knowledge base search:	Uncheck to hide the Knowledge Base search bar, and skip to "More options"
array(
'name' => 'Knowledge base search',
'desc' => 'Uncheck to hide the Knowledge Base search bar, and skip to "More options"',
'id' => 'livehelpnow_lhnHPKnowledgeBase',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
//Enable More options panel:	Uncheck to display the "More options" slider automatically
array(
'name' => 'Enable More options panel',
'desc' => 'Uncheck to display the "More options" slider automatically',
'id' => 'livehelpnow_lhnHPMoreOptions',
'type' => 'checkbox',
'options' => array(
'on' => ''
)
),
//"Search" title  Find answers lhnLO_helpPanel_knowledgeBase_find_answers
array(
'name' => '"Search" title',
'desc' => '',
'id' => 'lhnLO_helpPanel_knowledgeBase_find_answers',
'type' => 'text',
'default' => 'Find answers'
),
//"Search" message  Please search our knowledge base for answers or click [More options] lhnLO_helpPanel_knowledgeBase_please_search
array(
'name' => '"Search" message',
'desc' => '',
'id' => 'lhnLO_helpPanel_knowledgeBase_please_search',
'type' => 'text',
'default' => 'Please search our knowledge base for answers or click [More options]'
),
//No Results Found message  No results found for	 lhnLO_helpPanel_typeahead_noResults_message
array(
'name' => 'No Results Found message',
'desc' => '',
'id' => 'lhnLO_helpPanel_typeahead_noResults_message',
'type' => 'text',
'default' => 'No results found for'
),
//Article Views label   No results found for	 lhnLO_helpPanel_typeahead_result_views
array(
'name' => 'Article Views label',
'desc' => '',
'id' => 'lhnLO_helpPanel_typeahead_result_views',
'type' => 'text',
'default' => 'view'
),
array(
'name' => 'Code',
'desc' => 'Enter big text here',
'id' => 'textarea_id',
'type' => 'textarea',
'default' => 'Default value 2'
),
)
);
 
/**
* Widget HTML
*
* If you want to have an all inclusive single widget file, you can do so by
* dumping your css styles with base_encoded images along with all of your
* html string, right into this method.
*
* @param array $widget
* @param array $params
* @param array $sidebar
*/
function html($widget = array(), $params = array(), $sidebar = array())
{
?>
<!-- Your widget html goes here -->
<?php //print_r($params);?>
<?php
$userID = get_current_user_id();
$user_data = get_userdata($userID);
?>
<script type="text/javascript">
	var lhnCustom1 = '<?php echo  urlencode($user_data->user_email); ?>'; 
	var lhnCustom2 = '<?php echo  urlencode($user_data->user_firstname." ".$user_data->user_lastname); ?>'; 
	var lhnCustom3 = '';
	var lhnPlugin = 'WP-<?php echo get_bloginfo('version'); ?>-Chat'; 
</script>
<?php
}
}