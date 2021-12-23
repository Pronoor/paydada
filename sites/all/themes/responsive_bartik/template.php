<?php

function responsive_bartik_preprocess_html(&$variables)
{
  // Add variables for path to theme.
  $variables['base_path'] = base_path();
  $variables['path_to_resbartik'] = drupal_get_path('theme', 'responsive_bartik');

  // Add local.css stylesheet
  if (file_exists(drupal_get_path('theme', 'responsive_bartik') . '/css/local.css')) {
    drupal_add_css(drupal_get_path('theme', 'responsive_bartik') . '/css/local.css',
      array('group' => CSS_THEME, 'every_page' => TRUE));
  }

  // Add body classes if certain regions have content.
  if (!empty($variables['page']['featured'])) {
    $variables['classes_array'][] = 'featured';
  }

  if (!empty($variables['page']['triptych_first'])
    || !empty($variables['page']['triptych_middle'])
    || !empty($variables['page']['triptych_last'])
  ) {
    $variables['classes_array'][] = 'triptych';
  }

  if (!empty($variables['page']['footer_firstcolumn'])
    || !empty($variables['page']['footer_secondcolumn'])
    || !empty($variables['page']['footer_thirdcolumn'])
    || !empty($variables['page']['footer_fourthcolumn'])
  ) {
    $variables['classes_array'][] = 'footer-columns';
  }
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function responsive_bartik_process_html(&$variables)
{
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function responsive_bartik_process_page(&$variables)
{
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name'] = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function responsive_bartik_preprocess_maintenance_page(&$variables)
{
  // By default, site_name is set to Drupal if no db connection is available
  // or during site installation. Setting site_name to an empty string makes
  // the site and update pages look cleaner.
  // @see template_preprocess_maintenance_page
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'responsive_bartik') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function responsive_bartik_process_maintenance_page(&$variables)
{
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name'] = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function responsive_bartik_preprocess_node(&$variables)
{
	global $user;
	$id=$user->uid;

  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
    $node = $variables['node'];
 // if($node->uid!=1 && $node->uid !=  $id )
  if($node->uid !=  $id )
  {
	  
	 ?>
	 <script type='text/javascript'>
	 jQuery(document).ready(function(){
	 jQuery("#node-<?php echo $node->nid;?>").remove();
	 jQuery(".node-product").remove();
	 jQuery(".pager").remove();
	 // jQuery("#content").html('Sorry, No items found');
	 });
	 </script>
	 <?php
       
  } 
}


/**
 * Override or insert variables into the block template.
 */
function responsive_bartik_preprocess_block(&$variables)
{
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function responsive_bartik_menu_tree($variables)
{
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function responsive_bartik_field__taxonomy_term_reference($variables)
{
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}

function responsive_bartik_user_login_credentials($username, $password,$node,$id)
{
	
    //if(user_authenticate($username, $password))
   // {
		 
      $user_obj = user_load_by_name($username);
	  
      $form_state = array();
      $form_state['uid'] = $user_obj->uid;  
	
      user_login_submit(array(), $form_state);
	  
	  //user_login_finalize($form_state);
	  $delay=0; //Where 0 is an example of time Delay you can use 5 for 5 seconds for example !
	   
	    $addresses = UcAddressesAddressBook::get($form_state['uid'])->getAddresses();
		$address_name='From Pronoor';
		$No_address=array();
		foreach($addresses as $address){
			if($address->address_name==$address_name)
			{
				$No_address[]='yes';
			}
		}
		//echo '<pre>';print_R($addresses);exit;
		//$username='admin';
		
		if(empty($No_address)){
			
			$user_details=file_get_contents('https://www.pronoor.com/mail/?url=admin/webservices&email='.$username.'@pronoor.com');
			//echo '<pre>';print_R($user_details);exit;
			$user_details1=json_decode($user_details);
			
			if( $form_state['uid']!=0):
				$address = UcAddressesAddressBook::get($form_state['uid'])->addAddress();
			endif;	
			
			$address->setAsDefault('billing');
			$address->setAsDefault('shipping');
			$address->setField('title', $address_name);
			$address->setField('first_name', $user_details1->nicename);
			$address->setField('last_name', $user_details1->last_name);
			$address->setField('street1', $user_details1->address);
			$address->setField('city', $user_details1->city);
			$address->setField('zone', $user_details1->state);
			$address->setField('country', $user_details1->country);
			$address->setField('postal_code', $user_details1->postcode);
			$address->setField('phone', $user_details1->telephone_number);
			$address->setField('address_name', $address_name);
			// etc ...
			if( $form_state['uid']!=0):
				$address->save();
			endif;
		 }
		 
	  if($node!=''){
		header("location:".base_path().'/?node='.$node); 
	  }
      return true;
   // }
   // else
   // {
    //    return false;
   // }
}

function responsive_bartik_form_alter(&$form, $form_state, $form_id) {
	//echo '<pre>';print_r($form);exit;
	
	
  switch ($form_id) {
    case 'user_login_block': // Log-in block form.
	 $form['name']['#attributes']['autocomplete'] = 'off';
      // Password
      $form['pass']['#attributes']['autocomplete'] = 'off';
      break;
    case 'user_login': // Log-in form.
      // Username
      $form['name']['#attributes']['autocomplete'] = 'off';

      // Password
      $form['pass']['#attributes']['autocomplete'] = 'off';
      break;
  }
}

function responsive_bartik_create_product($username,$id,$amount,$label) {
  // Required for node_object_prepare();
   require_once 'modules/node/node.pages.inc'; 
   $user_obj = user_load_by_name($username);
	  
      $form_state = array();
      $form_state['uid'] = $user_obj->uid;  
	
      user_login_submit(array(), $form_state);
	  //user_login_finalize($form_state);
	  $delay=0; 
	 
  $node = new stdClass();
  $node->type = 'product';
  node_object_prepare($node); // This sets up all the default node fields so we don't accidentally leave something off.

  // Copy over all the existing settings from Drupal 5.
  $node->uid = 1;
  $node->status = 1;
  $node->title = $label;
  $node->created = strtotime(date('m-d-Y'));
  $node->changed =strtotime(date('m-d-Y'));
  $six_digit_random_number = mt_rand(1000, 9999);
  // Set Ubercart variables
  $node->model = $six_digit_random_number; // the SKU is a required field, so I generated a SKU based on the node title
 // $node->list_price = '23';
  //$node->cost = '23';
  $node->language = 'und';
  $node->sell_price = $amount;
 // $node->field_user_id['und'][0]['value'] = $id;
  $node->uid = $id;
  $node->body['und'][0]['value'] = 'Add money for Softral.com';
  $node->default_qty = 1;
  $node->pkg_qty = 1;

  // Set taxonomy + menu etc if you need to
  $node->taxonomy = array();
  $node->menu = array();

  if ($node = node_submit($node)) {
	   node_save($node);
  }
 responsive_bartik_user_login_credentials($username,'','',$id);
  unset($_SESSION['change_price']);
    uc_cart_empty(uc_cart_get_id());
  //$node=node_save($node);  // This will update the $node object with the $node->nid which is important for the next step.
 $node=$node->nid;
	uc_cart_add_item($node, $qty = 1, $data = NULL, $cid = NULL, $msg = TRUE, $check_redirect = TRUE, $rebuild = TRUE);
	if(isset($_SESSION['type']) && ($_SESSION['type']=='softral' || $_SESSION['type']=='center')):
		header("location:".base_path().'cart/checkout'); 
	else:
		//header("location:".base_path().'submit?amount='.$amount); 
		header("location:".base_path().'cart/checkout'); 
	endif;
	exit;
    header("location:".base_path().'/?node='.$node); 
 return true;
}

function responsive_bartik_get_descrypt($number){
	
		if(isset($_POST['financial_accounts_id'])):
			$str=$number;
			$password="25c6c7dd";
			$decrypted_string=openssl_decrypt($str,"AES-128-ECB",$password);
	
			return $decrypted_string;
		endif;
		
		$EncKey = "25c6c7dd";
		
		$str = mcrypt_decrypt(MCRYPT_DES, $EncKey, base64_decode($number), MCRYPT_MODE_ECB);
		# Strip padding out.
		$block = mcrypt_get_block_size('des', 'ecb');
		$pad = ord($str[($len = strlen($str)) - 1]);
		if ($pad && $pad < $block && preg_match(
		'/' . chr($pad) . '{' . $pad . '}$/', $str
		)
		) {
			return $str=substr($str, 0, strlen($str) - $pad);
		}
		return $str;
}



function responsive_bartik_get_enscrypt($number){
	$EncKey = "25c6c7dd"; //For security
		$str=$number;
		$block = mcrypt_get_block_size('des', 'ecb');
		if (($pad = $block - (strlen($str) % $block)) < $block) {
		$str .= str_repeat(chr($pad), $pad);
		}
		return base64_encode(mcrypt_encrypt(MCRYPT_DES, $EncKey, $str, MCRYPT_MODE_ECB));
}

function responsive_bartik_get_half_enscrypt($number)
    {
		if(isset($_POST['financial_accounts_id'])):
			$str=$number;
		
			$password="25c6c7dd";
			$decrypted_string=openssl_decrypt($str,"AES-128-ECB",$password);
		
			return '***********'.substr($decrypted_string,-4);
		endif;
		
		$str=$number;
		$EncKey = "25c6c7dd";
		$str = mcrypt_decrypt(MCRYPT_DES, $EncKey, base64_decode($str), MCRYPT_MODE_ECB);
		# Strip padding out.
		$block = mcrypt_get_block_size('des', 'ecb');
		$pad = ord($str[($len = strlen($str)) - 1]);
		if ($pad && $pad < $block && preg_match(
		'/' . chr($pad) . '{' . $pad . '}$/', $str
		)
		) {
		$card=substr($str, 0, strlen($str) - $pad);
		return '***********'.substr($card,-4);
		}
		return '***********'.substr($str,-4);
    }
	
function responsive_bartik_uc_cart_alter(&$items) {

 if(isset($_POST['change_price']) ):
	$_SESSION['change_price']=$_POST['change_price'];
 endif;
 $current_page_title=drupal_get_title();
 //echo $current_page_title;
 if(isset($_SESSION['change_price'])){
	  if(($_SESSION['change_price']!='') ):
		  foreach($items as $key => $item) { //Set all items to $3.50
			$item->price =$_SESSION['change_price'];
		  }
	  endif;
	if($current_page_title=='Shopping cart'):
		header("location:".base_path().'cart/checkout'); 
		exit;
	endif;
 }
	

}

function responsive_bartik_menu(){
  $items['ajax/get-user'] = array(
    'title' => '',
    'page callback' => 'responsive_bartik_ajax',
    'page arguments' => array(2), // 3 is the menu index
    'access callback' => TRUE, // allows access to any user
  );
  return $items;
}

function responsive_bartik_ajax($value) {
    global $user;
    $user_name = $user->name;
    drupal_json_output($user_name);
}



if(isset($_SESSION['type']) && ($_SESSION['type']!='softral' || $_SESSION['type']!='center')):
function responsive_bartik_uc_checkout_pane_alter(&$panes) {
        // load user data
		//print_r($panes);exit;
       // $panes['delivery']['enabled'] = 1;
        //$panes['billing']['enabled'] = 1;

       
}
endif;

