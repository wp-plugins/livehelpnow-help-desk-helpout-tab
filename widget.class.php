<?php
/**
* @package WordPress
* @subpackage LiveHelpNow Help Desk Widget Class
* @version 1.2.4
*/
/**
* Protection
*
* This string of code will prevent hacks from accessing the file directly.
*/
defined('ABSPATH') or die("Cannot access pages directly.");
 
/**
* Initializing
*
* The directory separator is different between linux and microsoft servers.
* Thankfully php sets the DIRECTORY_SEPARATOR constant so that we know what
* to use.
*/
defined("DS") or define("DS", DIRECTORY_SEPARATOR);
 
/**
* This abstract class is not intended to be called directly. This class is a worker class that must
* be extended by another class. The class that you will be working with is called Empty_Widget
* and exists at the bottom of this file.
*Livehelpnow
*/
if (!class_exists('Livehelpnow_Widget_Abstract')):
abstract class Livehelpnow_Widget_Abstract extends WP_Widget
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
'name' => false,
'description' => 'Single Widget Class handles all of the widget responsibility, all that you need to do is create the html and change the description. RedRokk',
'do_wrapper' => true,
'do_title'	=> false,
'view' => false,
'width'	=> 350,
'height' => 350,
'buttonrow' => 4,
'thumbnail' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAgAAAQABAAD//gAEKgD/2wBDAAUDBAQEAwUEBAQFBQUGBwwIBwcHBw8LCwkMEQ8SEhEPERETFhwXExQaFRERGCEYGh0dHx8fExciJCIeJBweHx7/2wBDAQUFBQcGBw4ICA4eFBEUHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh7/wgARCAAUABQDACIAAREBAhEB/8QAGQAAAgMBAAAAAAAAAAAAAAAAAQUDBAYH/8QAFwEBAQEBAAAAAAAAAAAAAAAAAgMAAf/EABcBAQEBAQAAAAAAAAAAAAAAAAIDAAH/2gAMAwAAARECEQAAAd1NnV5p0q2ldY0qLuHjnILl/8QAGhAAAgMBAQAAAAAAAAAAAAAAAwQBAgUAEv/aAAgBAAABBQLR0hiYH7sFM9GV3U7S6pkPCNj1iFWVhH6Eqknv/8QAGREBAAMBAQAAAAAAAAAAAAAAAQACERAh/9oACAECEQE/AVzwlqmyq5z/xAAYEQACAwAAAAAAAAAAAAAAAAAAARARMf/aAAgBAREBPwHSxx//xAAqEAACAQEFBQkAAAAAAAAAAAABAgMABBESFDEFITJBoRATNEJRYnGB4f/aAAgBAAAGPwLuDao7MBxO28/AFZix7RzCjUOVKn7GlJMmjdKlezrJng96EEYcB9b+WtSQWjwRcNKEbCG/BRZFwxu5ZB7eVAteHXhdTcRV0888yjyud3Ts/8QAHxAAAgIBBAMAAAAAAAAAAAAAAREAITFBUXGBkaGx/9oACAEAAAE/IT5Q1rM+kycOGaO+dyAIDSloFg6sEeYz27IWsc8FbS1EVOtm+wVF+JsJNo4D7gEf5hMxwbYr8gA+4AghQn//2gAMAwAAARECEQAAEKOMiP/EABwRAQABBAMAAAAAAAAAAAAAAAEAEBEhMUGh8P/aAAgBAhEBPxB2BixwN/dQDCCWdap//8QAGREBAQEAAwAAAAAAAAAAAAAAAREAECGx/9oACAEBEQE/EAir35hTAvH/xAAbEAEBAQEBAQEBAAAAAAAAAAABESEAQTFRYf/aAAgBAAABPxCJWQrsBIigoSQIrhnchRFVYhuqGUnUIQxKKomKBKYynCVjmiAqAKsLYfICkc2VqFCsBRICVCCxg02iPAgD85qI1G76DsfRo+nGcCQ4aTe/KP5xAAGAfDv/2Q==',
'fields' => array(
array(
'name' => 'LiveHelpNow Account#',
'desc' => '',
'id' => 'account',
'type' => 'text',
'default' => ''
),
array(
'name' => 'Chat Window ID',
'desc' => '',
'id' => 'livehelpnow_lhnWindowN',
'type' => 'text',
'default' => '0'
),
array(
'name' => 'Invitation Window ID',
'desc' => '',
'id' => 'livehelpnow_lhnInviteN',
'type' => 'text',
'default' => '0'
),
array(
'name' => 'Department ID',
'desc' => '',
'id' => 'livehelpnow_lhnDepartmentN',
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
//Enable slideout panel lhnHPPanel
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
abstract function html($widget = array(), $params = array(), $sidebar = array());
/* *****************************************
* NO NEED TO MODIFY ANYTHING BELOW THIS POINT
*/
/**
* Constructor
*
* Registers the widget details with the parent class, based off of the options
* that were defined within the widget property. This method does not need to be
* changed.
*/
function __construct()
{
//Initializing
$this->_file = basename(__file__);
$this->_class = $this->get_called_class();
$this->widget['name'] = isset($this->widget['name']) && $this->widget['name']
? $this->widget['name']
: ucwords(str_replace('_',' ',sanitize_title(get_class($this))));
// widget actual processes
parent::WP_Widget(
$id = $this->_class,
$name = $this->widget['name'],
$widget_options = array(
'description' => $this->widget['description']
),
$control_options = array(
'width'	=> isset($this->widget['width']) && $this->widget['width']?$this->widget['width']:250,
'height'	=> isset($this->widget['height']) && $this->widget['height']?$this->widget['height']:200,
)
);
// expanding the potential
add_action( 'init', array(&$this, 'set_wysiwyg_button'));
add_action( "after_plugin_row_$this->_file", array(&$this, 'get_plugin_support'));
add_filter( "{$this->_class}_params", array(&$this, 'set_defaults') );
add_filter( "plugin_action_links_$this->_file", array(&$this, 'set_plugin_links'));
add_shortcode( $this->_class, array(&$this, 'shortcode') );
}

/**
* Method returns the called class
*
*/
function get_called_class()
{
if (function_exists('get_called_class')) {
return get_called_class();
}
$called_class = false;
$objects = array();
$traces = debug_backtrace();
foreach ($traces as $trace)
{
if (isset($trace['object'])) {
if (is_object($trace['object'])) {
$objects[] = $trace['object'];
}
}
}
if (count($objects)) {
$called_class = get_class($objects[0]);
}
return $called_class;
}
/**
* Widget View
*
* This method determines what view method is being used and gives that view
* method the proper parameters to operate. This method does not need to be
* changed.
*
* @param array $sidebar
* @param array $params
*/
function widget($sidebar = array(), $params = array())
{
//initializing variables
$sidebar = wp_parse_args($sidebar, array(
'before_widget' => '',
'before_title' => '',
'after_title' => '',
'after_widget' => '',
));
$this->widget['number'] = $this->number;
$params = apply_filters( "{$this->_class}_params", $params, $this );
$sidebar = apply_filters( "{$this->_class}_sidebar", $sidebar, $this );
//print_r($params);die();
$params['title'] = isset($params['title']) && $params['title']
? $params['title']
: '';
$params['title'] = trim(apply_filters( "{$this->_class}_title", $params['title'] ));
$do_wrapper = (isset($this->widget['do_wrapper']) && $this->widget['do_wrapper']);
$do_title = (isset($this->widget['do_title']) && $this->widget['do_title']);
if ( $do_wrapper )
echo $sidebar['before_widget'];
if ( $do_title && $params['title'] )
echo $sidebar['before_title'] . $params['title'] . $sidebar['after_title'];
//loading a file that is isolated from other variables
if (file_exists($this->widget['view']))
$this->getViewFile($widget, $params, $sidebar);
elseif ($this->widget['view'])
echo $this->widget['view'];
else $this->html($this->widget, $params, $sidebar);
if ( $do_wrapper )
echo $sidebar['after_widget'];

echo $params['textarea_id'];//die();

}
/**
* Compress the content and return it
*
* @param $buffer
*/
function compress($buffer)
{
/* remove comments */
//$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
$buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
/* remove tabs, spaces, newlines, etc. */
$buffer = str_replace(array("\r\n", "\r", "\n", "\t", ' ', ' ', ' '), '', $buffer);
return $buffer;
}
/**
*
* @param array $atts
* @param string $content
*/
function shortcode( $atts = array(), $content = '' )
{
$fields = array();
foreach((array)$this->widget['fields'] as $field)
{
$meta = $atts[$field['id']];
$fields[$field['id']] = $meta ?$meta :$field['default'];
}
ob_start();
$this->widget(array(), $fields);
$html = ob_get_clean();
 
return $this->compress($html);
}
/**
* Administration Form
*
* This method is called from within the wp-admin/widgets area when this
* widget is placed into a sidebar. The resulting is a widget options form
* that allows the administration to modify how the widget operates.
*
* You do not need to adjust this method what-so-ever, it will parse the array
* parameters given to it from the protected widget property of this class.
*
* @param array $instance
* @param boolean $shortcode
* @return boolean
*/
function form( $instance = array(), $shortcode = false )
{
// initializing
$fields = $this->widget['fields'];
$defaults = array(
'name' => '',
'desc' => '',
'id' => '',
'type' => 'text',
'options'	=> array(),
'default'	=> '',
'value'	=> '',
'class'	=> '',
'multiple'	=> '',
'args'	=> array(
'hide_empty' => 0,
'name' => 'element_name',
'hierarchical' => true
),
);
// reasons to fail
if (!empty($fields))
{
do_action("{$this->_class}_before");
foreach ($fields as $field)
{
// initializing the individual field
$field = wp_parse_args($field, $defaults);
$field['args'] = wp_parse_args($field['args'], $defaults['args']);
extract($field);
$field['args']['name'] = $element_name = $id;
// grabbing the meta value
if (array_key_exists($id, $instance))
@$meta = esc_attr($instance[$id]);
else
$meta = $default;
if (!$shortcode)
{
$field['args']['name'] = $element_name = $this->get_field_name($id);
$id = $this->get_field_id($id);
}





switch ($type) : default: ?>
<?php case 'text': ?>
<p>
<label for="<?php echo $id; ?>" style="width:215px;display:inline-block;">
	<?php echo $name; ?> :
</label>
<?php
//$str = "dfhd@ffs@dfskfk@asas";
   //$substr_count = substr_count($id,"clientid");
   //echo ($substr_count);
//print_r($matches);//die('OOPPP');
/*if (preg_match("/^clientid/", $id)) {
    echo "¬хождение найдено.";die();
}*/
if(substr_count($id,"clientid") == 1){
$meta = str_replace("lhn", "", strtolower($meta));
if(trim(is_numeric(str_replace("-1","",$meta)))) { 
	$numstatus = "<font color='green'><b>Accepted</b></font> &nbsp;&nbsp;&nbsp; <a href=\"http://www.livehelpnow.net/alerter\" target=\"_blank\">Please make sure you download our Alterer Software</a>"; 
} else { 
	$numstatus = "<font color='red'><b>Invalid</b></font> &nbsp;&nbsp;&nbsp; <a href=\"http://www.livehelpnow.net/lnd/trial.aspx\" target=\"_blank\">Sign Up</a>";
}
$clientid = $meta;
}
if(substr_count($id,"livehelpnow_lhnWindowN") == 1){
if(trim(is_numeric($meta))) { 
	$numstatus1 = "<font color='green'><b>Accepted</b></font>"; 
} else { 
	$numstatus1 = "<font color='red'><b>Invalid</b></font>"; 
}
$lhnWindowN = $meta;
}
if(substr_count($id,"livehelpnow_lhnInviteN") == 1){
if(trim(is_numeric($meta))) { 
	$numstatus3 = "<font color='green'><b>Accepted</b></font>"; 
} else { 
	$numstatus3 = "<font color='red'><b>Invalid</b></font>"; 
}
$lhnInviteN = $meta;
}
if(substr_count($id,"livehelpnow_lhnDepartmentN") == 1){
if(trim(is_numeric($meta))) { 
	$numstatus2 = "<font color='green'><b>Accepted</b></font>"; 
} else { 
	$numstatus2 = "<font color='red'><b>Invalid</b></font>"; 
}
$lhnDepartmentN = $meta;
}
//lhnLO_helpPanel_knowledgeBase_find_answers
if(substr_count($id,"lhnLO_helpPanel_knowledgeBase_find_answers") == 1){
$lhnLO_helpPanel_knowledgeBase_find_answers = $meta;
}
//lhnLO_helpPanel_knowledgeBase_please_search
if(substr_count($id,"lhnLO_helpPanel_knowledgeBase_please_search") == 1){
$lhnLO_helpPanel_knowledgeBase_please_search = $meta;
}
//lhnLO_helpPanel_typeahead_noResults_message
if(substr_count($id,"lhnLO_helpPanel_typeahead_noResults_message") == 1){
$lhnLO_helpPanel_typeahead_noResults_message = $meta;
}
//lhnLO_helpPanel_typeahead_result_views
if(substr_count($id,"lhnLO_helpPanel_typeahead_result_views") == 1){
$lhnLO_helpPanel_typeahead_result_views = $meta;
}
if(substr_count($id,"livehelpnow_lhnTheme") == 1){
$lhnTheme = $meta;
}
?>
<input <?php if(substr_count($id,"clientid") == 1){echo 'style="width: 100px;"';} if(substr_count($id,"livehelpnow_lhnWindowN") == 1){echo 'style="width: 100px;"';} if(substr_count($id,"livehelpnow_lhnInviteN") == 1){echo 'style="width: 100px;"';} if(substr_count($id,"livehelpnow_lhnDepartmentN") == 1){echo 'style="width: 100px;"';} ?> id="<?php echo $id; ?>" name="<?php echo $element_name; ?>" value="<?php echo $meta; ?>" type="<?php echo $type; ?>" class="text large-text <?php echo $class; ?>" />
<?php 
if(substr_count($id,"clientid") == 1){
	echo $numstatus; 
}
if(substr_count($id,"livehelpnow_lhnWindowN") == 1){
	echo $numstatus1;
}
if(substr_count($id,"livehelpnow_lhnInviteN") == 1){
	echo $numstatus3;
}
if(substr_count($id,"livehelpnow_lhnDepartmentN") == 1){
	echo $numstatus2;
}
?>
<br/>
<span class="description"><?php echo $desc; ?></span>
</p>
<?php break; ?>
<?php case 'textarea': ?>
<p style="display:none;">
<?php
/*if($options['livehelpnow_lhnInviteEnabled']=='on'){
		$lhnInviteEnabled = 1;
}else{
		$lhnInviteEnabled = 0;
}
$lhnWindowN = $options['livehelpnow_lhnWindowN'];
$lhnTheme = $options['livehelpnow_lhnTheme'];$lhnHPPanel
*/	


	$script_code = <<<EOT
<script type="text/javascript" data-cfasync="false">
	var lhnAccountN = "$clientid";
	var lhnInviteEnabled = $lhnInviteEnabled;
	var lhnWindowN = $lhnWindowN;
	var lhnInviteN = $lhnInviteN; 
	var lhnDepartmentN = $lhnDepartmnetN;
	var lhnTheme = '$lhnTheme'; 
	var lhnHPPanel = $lhnHPPanel; 
	var lhnHPKnowledgeBase = $lhnHPKnowledgeBase; 
	var lhnHPMoreOptions = $lhnHPMoreOptions; 
	var lhnHPChatButton = $lhnHPChatButton; 
	var lhnHPTicketButton = $lhnHPTicketButton; 
	var lhnHPCallbackButton = $lhnHPCallbackButton; 
	var lhnLO_helpPanel_knowledgeBase_find_answers = "$lhnLO_helpPanel_knowledgeBase_find_answers";
	var lhnLO_helpPanel_knowledgeBase_please_search = "$lhnLO_helpPanel_knowledgeBase_please_search";
	var lhnLO_helpPanel_typeahead_noResults_message = "$lhnLO_helpPanel_typeahead_noResults_message";
	var lhnLO_helpPanel_typeahead_result_views = "$lhnLO_helpPanel_typeahead_result_views";
</script>
<script src="//www.livehelpnow.net/lhn/widgets/helpouttab/lhnhelpouttab-current.min.js" type="text/javascript" data-cfasync="false" id="lhnscriptho"></script>

EOT;

$meta = $script_code;

?>
<label for="<?php echo $id; ?>" style="display:inline-block;width:215px;">

	<?php echo $name; ?> :
	
</label>

<textarea cols="63" rows="9" style="height:500px;" id="<?php echo $id; ?>" name="<?php echo $element_name; ?>" class="large-text <?php echo $class; ?>">

<?php echo trim($meta); ?>

</textarea>

<br/>

<span class="description"><?php echo $desc; ?></span>
<br/>
<!--span style="margin-left: 450px; margin-top: 24px; position: absolute;"><b>Click Save once to Update code preview.<br/>  
Click Save Again to save the configuration.</b></span-->
<br/>

</p>
<?php break; ?>
<?php case 'select_capabilities': ?>
<?php $options = $type=='select_capabilities' ?$this->get_options_capabilities() :$options; ?>
<?php case 'select_roles': ?>
<?php $options = $type=='select_roles' ?$this->get_options_roles() :$options; ?>
<?php case 'select_menu': ?>
<?php $options = $type=='select_menu' ?$this->get_options_menus() :$options; ?>
<?php case 'select_posts': ?>
<?php $options = $type=='select_posts' ?$this->get_options_posts( $args ) :$options; ?>
<?php case 'select_users': ?>
<?php $options = $type=='select_users' ?$this->get_options_users() :$options; ?>
<?php case 'select_categories': ?>
<?php case 'select': ?>
<p style="clear:both;">
	<label for="<?php echo $id; ?>" style="display:inline-block;width:215px;">
		<?php echo $name; ?> :
	</label>
<?php if ($type == 'select_categories'): ?>
<?php wp_dropdown_categories($args); ?>
<?php else: ?>
<?php
if($id=='widget-livehelpnow_widget-3-livehelpnow_lhnTheme'){
	$lhnTheme = $meta;
}
?>
<select <?php echo $multiple ?"MULTIPLE SIZE='$multiple'" :''; ?> id="<?php echo $id; ?>" name="<?php echo $element_name; ?>" class="<?php echo $class; ?>">
	<?php foreach ((array)$options as $_value => $_name): ?>
		<?php $_value = !is_int($_value)?$_value:$_name; ?>
		<option value="<?php echo $_value; ?>" <?php echo $meta == $_value?' selected="selected"' :''; ?>>
			<?php echo $_name; ?>
		</option>
	<?php endforeach; ?>
</select>
<?php endif; ?>
<br/>
<span class="description"><?php echo $desc; ?></span>
</p>
<?php break; ?>
<?php case 'radio': ?>
<p>
<?php echo $name; ?> :
</p>
<p>
<?php foreach ((array)$options as $_value => $_name): ?>
<input name="<?php echo $element_name; ?>" id="<?php echo $id; ?>"
value="<?php echo $_value; ?>" type="<?php echo $type; ?>"
<?php echo $meta == $_value?'checked="checked"' :''; ?>
class="<?php echo $class; ?>" />
<label class="<?php echo $element_name; ?>" for="<?php echo $id; ?>">
<?php echo $_name; ?>
</label>
<?php endforeach; ?>
<br/>
<span class="description"><?php echo $desc; ?></span>
</p>
<?php break; ?>
<?php case 'checkbox': ?>
<p style="clear:both;">
<p style="float: left;width:200px;margin:0px;">
<?php echo $name; ?> :
</p>
<p>
<!-- first hidden input forces this item to be submitted
via javascript, when it is not checked -->
<input style="float:left;" type="hidden" name="<?php echo $element_name; ?>" value="" />
<?php foreach ((array)$options as $_value => $_name): ?>
	<input style="float: left; margin-left: 20px; margin-right: 10px;" value="<?php echo $_value; ?>" type="<?php echo $type; ?>" name="<?php echo $element_name; ?>" id="<?php echo $id; ?>" <?php echo $meta == $_value? 'checked="checked"' :''; ?> class="<?php echo $class; ?>" />
	<label class="<?php echo $element_name; ?>" for="<?php echo $id; ?>">
		<?php 
		if(substr_count($id,"livehelpnow_lhnInviteEnabled") == 1){
			if($meta=='on'){
				$lhnInviteEnabled = 1;
			}else{
				$lhnInviteEnabled = 0;
			}
		}
		if(substr_count($id,"livehelpnow_lhnHPPanel") == 1){
			if($meta=='on'){
				$lhnHPPanel = 'true';
			}else{
				$lhnHPPanel = 'false';
			}
		}
		if(substr_count($id,"livehelpnow_lhnHPChatButton") == 1){
			if($meta=='on'){
				$lhnHPChatButton = 'true';
			}else{
				$lhnHPChatButton = 'false';
			}
		}
		if(substr_count($id,"livehelpnow_lhnHPTicketButton") == 1){
			if($meta=='on'){
				$lhnHPTicketButton = 'true';
			}else{
				$lhnHPTicketButton = 'false';
			}
		}
		if(substr_count($id,"livehelpnow_lhnHPCallbackButton") == 1){
			if($meta=='on'){
				$lhnHPCallbackButton = 'true';
			}else{
				$lhnHPCallbackButton = 'false';
			}
		}
		if(substr_count($id,"livehelpnow_lhnHPKnowledgeBase") == 1){
			if($meta=='on'){
				$lhnHPKnowledgeBase = 'true';
			}else{
				$lhnHPKnowledgeBase = 'false';
			}
		}
		if(substr_count($id,"livehelpnow_lhnHPMoreOptions") == 1){
			if($meta=='on'){
				$lhnHPMoreOptions = 'true';
			}else{
				$lhnHPMoreOptions = 'false';
			}
		}
		echo $_name; 
		
		?>
	</label>
<?php endforeach; ?>
<span class="description"><?php echo $desc; ?></span>
</p>
</p>
<?php break; ?>
<?php case 'title': ?>
<h3 style="border: 1px solid #ddd;
padding: 10px;
background: #eee;
border-radius: 2px;
color: #666;
margin: 0;"><?php echo $name; ?></h3>
<?php break; ?>
<?php case 'hidden': ?>
<input
id="<?php echo $id; ?>" name="<?php echo $element_name; ?>"
value="<?php echo $meta; ?>" type="<?php echo $type; ?>"
style="visibility:hidden;" />
<?php break; ?>
<?php case 'custom': ?>
<?php echo $default; ?>
<?php break; ?>
<?php endswitch;
}
do_action("{$this->_class}_after");
}
return true;
}
/**
* Returns an options list of menus
*/
function get_options_posts( $args = array() )
{
// initializing
$options = array();
$posts = get_posts($args);
foreach((array)$posts as $post) {
$options[$post->slug] = $post->name;
}
return $options;
}
/**
* Returns an options list of menus
*/
function get_options_menus()
{
// initializing
$options = array();
$menus = get_terms('nav_menu');
foreach($menus as $menu) {
$options[$menu->slug] = $menu->name;
}
return $options;
}
/**
* Returns an options list of users
*/
function get_options_users()
{
// initializing
global $wpdb;
$options = array();
$query = $wpdb->prepare("SELECT $wpdb->users.ID, $wpdb->users.display_name FROM $wpdb->users");
$results = $wpdb->get_results( $query );
foreach ((array)$results as $result)
{
$options[$result->ID] = $result->display_name;
}
return $options;
}
/**
* Returns an options list of capabilities
*/
function get_options_capabilities()
{
// initializing
global $wpdb;
$options = array();
$roles = get_option($wpdb->prefix . 'user_roles');
foreach ((array)$roles as $role)
{
if(!isset($role['capabilities'])) continue;
foreach ((array)$role['capabilities'] as $cap => $v)
{
$options[$role['name']."::$cap"] = $role['name']."::$cap";
}
}
return $options;
}
/**
* Returns an options list of roles
*/
function get_options_roles()
{
// initializing
global $wpdb;
$options = array();
$roles = get_option($wpdb->prefix . 'user_roles');
foreach ((array)$roles as $role)
{
$options[] = $role['name'];
}
return $options;
}
/**
* Method adds a WYSIWYG button to the editor
*
*/
function set_wysiwyg_button()
{
// bail early and bail often
if ((!current_user_can('edit_posts')
&& !current_user_can('edit_pages'))
|| get_user_option('rich_editing') != 'true')
return;
// display the javascript
$this->view_preview();
$this->view_javascript();
$this->view_config();
// hooking it up
add_filter( 'mce_external_plugins', array(&$this, 'set_wysiwyg_js'));
add_filter( "mce_buttons_{$this->widget['buttonrow']}", array(&$this, 'set_wysiwyg_button_callback'));
}
/**
* Method displays the administrative preview for this given widget
*
*/
function view_preview()
{//die();
// fail early, fail often
if (!array_key_exists("{$this->_class}_Preview", $_GET))
return;
// sending the headers
header("Content-type: text/html; charset=UTF-8");
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header('Expires: ' . gmdate('D, d M Y H:i:s', strtotime('-1 years')) . ' GMT');
// the actual PREVIEW code

$this->widget(array(), $_GET);
//die();
}
/**
* Method displays the Administrative configurations for this shortcode
*
*/
function view_config()
{
	// fail early, fail often
	if (!array_key_exists("{$this->_class}_Config", $_GET))
	return;
	// sending the headers
	header("Content-type: text/html; charset=UTF-8");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header('Expires: ' . gmdate('D, d M Y H:i:s', strtotime('-1 years')) . ' GMT');
	// the actual HTML code
	?>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $this->widget['name']; ?></title>
		<link rel="stylesheet" href="<?php echo site_url('wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css'); ?>">
		<script type="text/javascript" src="<?php echo site_url('/wp-includes/js/tinymce/tiny_mce_popup.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('/wp-includes/js/tinymce/utils/mctabs.js'); ?>"></script>
	</head>
	<body onload="tinyMCEPopup.resizeToInnerSize();" role="application" dir="ltr" class="forceColors">
	<form onsubmit="tinyMCEPopup.restoreSelection();tinyMCEPopup.editor.<?php echo $this->_class; ?>_Command(this);tinyMCEPopup.close();return false;" id="popup_form" action="#">
	<div class="tabs" role="tablist" tabindex="-1">
		<ul>
			<li id="general_tab" class="current" aria-controls="general_panel" role="tab" tabindex="0">
				<span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;" tabindex="-1">General</a></span>
			</li>
			<li id="preview_tab" aria-controls="preview_panel" role="tab" tabindex="-1">
				<span><a href="javascript:tinyMCEPopup.editor.<?php echo $this->_class; ?>_Preview(document.getElementById('popup_form'),document.getElementById('preview_inner_div'));mcTabs.displayTab('preview_tab','preview_panel');" onmousedown="return false;" tabindex="-1">Preview</a></span>
			</li>
		<!-- IF YOU WANT TO IMPLEMENT A HELP TAB
			<li id="help_tab" aria-controls="help_panel" role="tab" tabindex="-1">
				<span><a href="javascript:mcTabs.displayTab('help_tab','help_panel');" onmousedown="return false;" tabindex="-1">Help</a></span>
			</li> -->
		</ul>
	</div>
	<div class="panel_wrapper">
			<div id="general_panel" style="height:auto;" class="panel current">
				<fieldset>
					<legend>Widget Options</legend>
						<?php $this->form(array(),true); ?>
				</fieldset>
				<div style="clear:both;width:100%;"></div>
			</div>
		<div id="preview_panel" style="height:auto;" class="panel">
			<fieldset>
				<legend>Widget Preview</legend>
				<div id="preview_inner_div"></div>
			</fieldset>
			<div style="clear:both;width:100%;"></div>
		</div>
		<div id="help_panel" style="height:auto;" class="panel">
			<fieldset>
				<legend>Help</legend>
			</fieldset>
			<div style="clear:both;width:100%;"></div>
		</div>
	</div>
	<div class="mceActionPanel">
		<input type="submit" id="insert" name="insert" value="Insert">
		<input type="button" id="cancel" name="cancel" value="Cancel" onclick="tinyMCEPopup.close();">
	</div>
	</form>
</body>
</html>
<?php
//die();
}
/**
* Method displays the javascript for the shortcode
*
*/
function view_javascript()
{
// fail early, fail often
if (!array_key_exists("{$this->_class}_Javascript", $_GET))
return;
// sending the headers
$expires = 60*60*24*14;
header("Content-type: text/javascript");
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
// the actual JS code
?>
(function() {
tinymce.create('tinymce.plugins.<?php echo $this->_class; ?>', {
mceTout : 0,
init : function(editor, site_url)
{
// Create the WYSIWYG button
editor.addButton('<?php echo $this->_class; ?>', {
title : '<?php echo $this->widget['name']; ?>',
image : '<?php echo $this->widget['thumbnail']; ?>',
onclick : function() {
editor.windowManager.open({
file : site_url + '/?<?php echo $this->_class; ?>_Config=true',
width : (<?php echo $this->widget['width']; ?> + 30) + editor.getLang('example.delta_width', 0),
height : (<?php echo $this->widget['height']; ?> + 35) + editor.getLang('example.delta_height', 0),
inline : 1
}, {
plugin_url : site_url,
some_custom_arg : '' // Custom argument
});
}
});
// The command to add the shortcode
editor.<?php echo $this->_class; ?>_Command = function(form) {
tinyMCEPopup.restoreSelection();
var insert = '[<?php echo $this->_class ?> ';
jQuery.each( jQuery(form).serializeArray(), function(k, f){
insert += f.name + '="'+ f.value +'" ';
});
insert += ']';
editor.execCommand('mceInsertContent', false, insert);
};
// Preview the shortcode/widget
editor.<?php echo $this->_class; ?>_Preview = function(form, wrapper) {
jQuery.get(site_url + '/?<?php echo $this->_class; ?>_Preview=true',
jQuery(form).serializeArray(),
function(data){
jQuery(wrapper).html(data);
}
);
};
},
createControl : function(n, cm) {
return null;
},
getInfo : function() {
return {
longname : "<?php echo $this->widget['name']; ?> Shortcode",
author : 'RedRokk',
authorurl : 'http://redrokk.com',
infourl : 'http://redrokk.com',
version : "1.0.0"
};
}
});
tinymce.PluginManager.add('<?php echo $this->_class; ?>',
tinymce.plugins.<?php echo $this->_class; ?>);
})();
<?php
//die();
}


function set_plugin_links( $actions )
{
// Update the database for show options
$key = "RedRokk_Plugin_Info";
if (array_key_exists($key, $_GET)) {
update_user_option(get_current_user_id(), $key, $_GET[$key], true);
}
// set the link for show options
if (get_user_option($key, get_current_user_id())) {
$actions['info'] = '<a href="'
. site_url("/wp-admin/plugins.php?$key=0")
. '" alt="Display the widget information on this page">Show Info</a>';
}
else {
$actions['info'] = '<a href="'
. site_url("/wp-admin/plugins.php?$key=true")
. '" alt="Hide the widget information on this page">Hide Info</a>';
}
// update the database for show link
$key = "{$this->_class}_Link";
if (array_key_exists($key, $_GET)) {
update_user_option(get_current_user_id(), $key, $_GET[$key], true);
}
// set the link for show link
if (get_user_option($key, get_current_user_id())) {
$actions['publiclink'] = '<a href="'
. site_url("/wp-admin/plugins.php?$key=0")
. '" alt="Display the link to redrokk below the widget">Show Link</a>';
}
else {
$actions['publiclink'] = '<a href="'
. site_url("/wp-admin/plugins.php?$key=true")
. '" alt="Hide the link to redrokk below the widget">Hide Link</a>';
}
return $actions;
}
/**
* This is a tiny contribution to our cause, I thank you for leaving this intact.
* Please add your own support blurb, in addition to ours as you see fit.
*
* @return string
*/
function get_plugin_support()
{
// initializing
global $redrokk_display_once;
if (!isset($redrokk_display_once) && !get_user_option("RedRokk_Plugin_Info", get_current_user_id()))
{
$redrokk_display_once = true;
$title = "Red Rokk Interactive &trade;";
$descriptionencode = urlencode($description);
$description = "The WordPress Total Widget Control Plugin is an amazing plugin!";
$descriptionencode = urlencode($description);
$url = 'http://redrokk.com';
$urlencode = urlencode($url);
ob_start();
?>
<tr>
<td><hr style="margin: 0 0 10px;border: none;border-bottom: 1px dashed #CCC;width:100%;clear:both"/>
</td>
<td>
<hr style="margin: 0 0 10px;border: none;border-bottom: 1px dashed #CCC;width:100%;clear:both"/>
<a href="<?php echo $url; ?>" style="text-decoration:none;">
<img src="<?php echo $this->screen_icon; ?>"
height="41px" width="194px"
style="margin:15px 20px 30px 0;position:relative;float:left;" />
</a>
</td>
<td>
<hr style="margin: 0 0 10px;border: none;border-bottom: 1px dashed #CCC;width:100%;clear:both"/>
<div style="position:relative;float:right;width:200px;">
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $urlencode ?>&amp;layout=box_count&amp;show_faces=false&amp;width=50&amp;action=like&amp;colorscheme=light&amp;height=65"
scrolling="no"
frameborder="0"
style="border:none; overflow:hidden; width:50px; height:65px;margin-bottom: -5px;"
allowTransparency="true" ></iframe>
<a href="http://twitter.com/share" class="twitter-share-button"
data-url="<?php echo $url ?>"
data-text="<?php echo $description ?>"
data-count="vertical"
data-via="jonathonbyrd">
Tweet</a>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<a href="http://digg.com/submit?url=<?php echo $urlencode ?>&bodytext=Total%20Widget%20Control%20allows%20you%20to%20customize%20any%20and%20every%20page%20of%20your%20WordPress%20website."
class="DiggThisButton DiggMedium">
<img src="http://developers.diggstatic.com/sites/all/themes/about/img/digg-btn.jpg"
alt="Digg <?php echo $title; ?>"
title="Digg <?php echo $title; ?>" />
<?php echo $title; ?></a>
<script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script>
</div>
<p>
<a href="<?php echo $url; ?>" style="text-decoration:none;">
<h4 style="margin:20px 0 0px;"><?php echo $title; ?></h4>
</a>
<?php echo $title; ?> is a software development firm that accepts
projects of all sizes. We contribute back to the community as much
as possible by providing amazing plugins with exceptional API's for
developers.
</p>
</td>
</tr>
<?php
echo ob_get_clean();
}
}
/**
* Method adds our button to the WYSIWYG array of buttons
*
* @params array $buttons
*/
function set_wysiwyg_button_callback( $buttons )
{
array_push($buttons, $this->_class);
return $buttons;
}
/**
* Method adds the required Javascript to the WYSIWYG
*
* @params array $scripts
*/
function set_wysiwyg_js( $scripts = array() )
{
$scripts[$this->_class] = site_url("/?{$this->_class}_Javascript=true");
return $scripts;
}
 
/**
* Get the View file
*
* Isolates the view file from the other variables and loads the view file,
* giving it the three parameters that are needed. This method does not
* need to be changed.
*
* @param array $widget
* @param array $params
* @param array $sidebar
*/
function getViewFile($widget, $params, $sidebar) {
require $this->widget['view'];
}
 
/**
*
* @param $params
*/
function set_defaults( $params = array() )
{
// initializing
$defaults = array();
foreach ((array)$this->widget['fields'] as $key => $field)
{
if (!isset($field['default'])) continue;
$defaults[$field['id']] = $field['default'];
}
$params = wp_parse_args($params, $defaults);
return $params;
}
/**
* Update the Administrative parameters
*
* This function will merge any posted paramters with that of the saved
* parameters. This ensures that the widget options never get lost. This
* method does not need to be changed.
*
* @param array $new_instance
* @param array $old_instance
* @return array
*/
function update($new_instance, $old_instance)
{
$whiteLabel = "";
if(substr($new_instance['clientid'],-2) == "-1"){
	$whiteLabel = "var lhnWhiteLabel = true;";
}
$clientid = str_replace("-1","",$new_instance['clientid']);
//var_dump($new_instance);exit;
$new_instance['textarea_id'] = "<script type=\"text/javascript\" data-cfasync=\"false\">
	var lhnAccountN = '".$clientid."';
	var lhnInviteEnabled = ". ($new_instance['livehelpnow_lhnInviteEnabled'] == "on" ? "1" : "0")."; 
	var lhnWindowN = ". ($new_instance['livehelpnow_lhnWindowN'] == "" ? "0" : $new_instance['livehelpnow_lhnWindowN']) ."; 
	var lhnInviteN = ". ($new_instance['livehelpnow_lhnInviteN'] == "" ? "0" : $new_instance['livehelpnow_lhnInviteN']) ."; 
	var lhnDepartmentN = ". ($new_instance['livehelpnow_lhnDepartmentN'] == "" ? "0" : $new_instance['livehelpnow_lhnDepartmentN']) ."; 
	var lhnTheme = '".$new_instance['livehelpnow_lhnTheme']."'; 
	var lhnHPPanel = ".($new_instance['livehelpnow_lhnHPPanel'] =="on" ? "true" :  "false")."; 
	var lhnHPKnowledgeBase = ".($new_instance['livehelpnow_lhnHPKnowledgeBase'] =="on" ? "true" :  "false")."; 
	var lhnHPMoreOptions = ".($new_instance['livehelpnow_lhnHPMoreOptions'] =="on" ? "true" :  "false")."; 
	var lhnHPChatButton = ".($new_instance['livehelpnow_lhnHPChatButton'] =="on" ? "true" :  "false")."; 
	var lhnHPTicketButton = ".($new_instance['livehelpnow_lhnHPTicketButton'] =="on" ? "true" :  "false")."; 
	var lhnHPCallbackButton = ".($new_instance['livehelpnow_lhnHPCallbackButton'] =="on" ? "true" :  "false")."; 
	var lhnLO_helpPanel_knowledgeBase_find_answers = \"".str_replace('"', '&quot;', $new_instance['lhnLO_helpPanel_knowledgeBase_find_answers'])."\";
	var lhnLO_helpPanel_knowledgeBase_please_search = \"".str_replace('"', '&quot;', $new_instance['lhnLO_helpPanel_knowledgeBase_please_search'])."\";
	var lhnLO_helpPanel_typeahead_noResults_message = \"".str_replace('"', '&quot;', $new_instance['lhnLO_helpPanel_typeahead_noResults_message'])."\";
	var lhnLO_helpPanel_typeahead_result_views = \"".str_replace('"', '&quot;', $new_instance['lhnLO_helpPanel_typeahead_result_views'])."\";
</script>
<script src='//www.livehelpnow.net/lhn/widgets/helpouttab/lhnhelpouttab-current.min.js' type='text/javascript'  data-cfasync='false' id='lhnscriptho'></script>
";
$instance = wp_parse_args($new_instance, $old_instance);
return $instance;
}
 
}
endif;