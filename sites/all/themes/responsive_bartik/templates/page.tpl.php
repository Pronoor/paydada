<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head, and body tags are not in this template. Instead
 * they can be found in the html.tpl.php template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on
 *   the menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node entity, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */

$id = $user->uid;

if (isset($_GET['mode'])):
    $_SESSION['mode'] = $_GET['mode'];
endif;


if (isset($_POST['pronoor_pay_submit'])):
    //$exp_date=explode('/',$_POST['date']);

    $other_database = array(
        'database' => 'pronoor_emailnew',
        'username' => 'pronoor_email', // assuming this is necessary
        'password' => 'Pronoremail@10', // assuming this is necessary
        'host' => 'localhost', // assumes localhost
        'port' => '3306', // assumes localhost
        'driver' => 'mysql', // replace with your database driver
    );

    Database::addConnectionInfo('mail', 'default', $other_database);
    db_set_active('mail');
    $explode = explode('@', $_POST['email']);

    if (isset($user->mail)):
        $email = $user->mail;
    else:
        $email = $_POST['email'];
    endif;
    $email = $_POST['email'];

    if (isset($_POST['card_number'])):

        $_SESSION['credit_form_data'] = $_POST;
        unset($_SESSION['credit_form_data']['card_number']);
        unset($_SESSION['credit_form_data']['month']);
        unset($_SESSION['credit_form_data']['year']);
        unset($_SESSION['credit_form_data']['cvv']);

        $credit_card = responsive_bartik_get_enscrypt($_POST['card_number']);

        $card_holder = ($_POST['card_holder']);
        $cvv = responsive_bartik_get_enscrypt($_POST['cvv']);
        $exp_month = '';
        $exp_year = '';
        //echo '<pre>';print_r($_POST);exit;
        if (isset($_POST['month'])):
            $exp_month = responsive_bartik_get_enscrypt($_POST['month']);
        endif;

        if (isset($_POST['year'])):
            $exp_year = responsive_bartik_get_enscrypt($_POST['year']);
        endif;

        $mail_data = db_select('user', 'n')
            ->fields('n')
            ->condition('username', $explode[0], '=')
            ->execute()
            ->fetchAssoc();
        $phone = '+' . $_POST['phone'] . '-' . $_POST['phone1'];

        if (!empty($mail_data['id'])) {
            $user_id = $mail_data['id'];
        } else {
            $user_id = 0;
        }

        //if(!empty($mail_data)):

        if ($user_id == 0) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $user_id = db_insert('user')
                ->fields(array(
                    'username' => $explode[0],
                    'email' => $explode[0] . '@ebinti.com',
                    'alternative_email' => $email,
                    'telephone_number' => $phone,
                    'country' => $_POST['country'],
                    'city' => $_POST['city'],
                    'state' => $_POST['state'],
                    'postcode' => $_POST['zip_code'],
                    'address' => $_POST['billing_address'],
                    'ip_address' => $ip_address
                ))->execute();

        }
        db_insert('credit_cards')
            ->fields(array(
                'user_id' => $user_id,
                'card_number' => $credit_card,
                'email' => $email,
                'card_holder' => $card_holder,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'cvv' => $cvv,
                'phone_number' => $phone,
                'country' => $_POST['country'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'zip_code' => $_POST['zip_code'],
                'billing_address' => $_POST['billing_address']
            ))->execute();
    //endif;

    else:
        $mail_data = db_select('user', 'n')
            ->fields('n')
            ->condition('email', $email, '=')
            ->execute()
            ->fetchAssoc();


        $credit_info = db_select('credit_cards', 'n')
            ->fields('n')
            ->condition('id', $_POST['card_number_select'], '=')
            ->execute()
            ->fetchAssoc();
        if ($mail_data['id'] == $credit_info['user_id']):
            $credit_card = $credit_info['card_number'];
            $card_holder = $credit_info['card_holder'];
            $cvv = $credit_info['cvv'];
            $exp_month = $credit_info['exp_month'];
            $exp_year = $credit_info['exp_year'];
        endif;
    endif;

    $_SESSION['card_number'] = $credit_card;
    $_SESSION['card_name'] = $card_holder;
    $_SESSION['exp_month'] = $exp_month;
    $_SESSION['exp_year'] = $exp_year;
    $_SESSION['security_code'] = $cvv;
    db_set_active();
    $key_value = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    $pass = $key_value;

    //$encrypted_text =Crypt::encrypt(MCRYPT_DES, $key_value, $pass, MCRYPT_ENCRYPT);
    $encrypted_text = crypt($key_value, $pass);
    $id1 = urlencode(base64_encode($encrypted_text));

    if (isset($_POST['nasty_thing'])):
        $amount = responsive_bartik_get_descrypt($_POST['nasty_thing']);
    else:
        $amount = $_POST['amount'];
    endif;

    $redirect = 'https://www.paydada.com/shopping_cart?email=' . $email . '&username=' . $explode[0] . '&key=' . $key_value . '&encrypt_pass=' . urlencode($id1) . '&amount=' . $amount . '&token=&f_id=&type=pronoor_mail';
    header('location:' . $redirect);

endif;
if (isset($_GET['email']) && isset($_GET['amount'])):
    if (isset($_SESSION['escrow'])):
        unset($_SESSION['escrow']);
    endif;
    $amount = $_GET['amount'];
    $url_id = $_GET['encrypt_pass'];
    //$decrypted_pass = mcrypt_ecb(MCRYPT_DES,$_GET['key'], $url_id, MCRYPT_DECRYPT);

    $EncKey = $_GET['key'];
    $str = mcrypt_decrypt(MCRYPT_DES, $EncKey, base64_decode($url_id), MCRYPT_MODE_ECB);
    # Strip padding out.
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    if ($pad && $pad < $block && preg_match(
            '/' . chr($pad) . '{' . $pad . '}$/', $str
        )
    ) {
        $decrypted_pass = substr($str, 0, strlen($str) - $pad);
    } else {
        $decrypted_pass = $str;
    }

    //$existing_user = user_authenticate($_GET['username'],$decrypted_pass);
    $existing_user1 = user_load_by_name($_GET['username']);

    if (isset($_GET['token'])):
        $_SESSION['token'] = $_GET['token'];
        //responsive_bartik_commerce_checkout_pane_info_alter();
    endif;

    if (isset($_GET['escrow'])):
        $_SESSION['escrow'] = 1;
    else:
        unset($_SESSION['escrow']);
    endif;

    if (isset($_GET['dp'])):
        $_SESSION['dp'] = 1;
    else:
        unset($_SESSION['dp']);
    endif;


    if ($existing_user1):
        //$edit = array('pass' => $decrypted_pass);

        // Save the account with the new password.
        //user_save($_GET['username'], $edit);
        $id = $user->uid;

        if (isset($_GET['type']) && $_GET['type'] == 'center'):
            $softral_database = array(
                'database' => 'netnoor_netmednoor',
                'username' => 'netnoor_userus', // assuming this is necessary
                'password' => 'dclick#007', // assuming this is necessary
                'host' => '192.187.108.34', // assumes localhost
                'driver' => 'mysql', // replace with your database driver
            );
        else:
            $softral_database = array(
                'database' => 'softral_db',
                'username' => 'softral_usr', // assuming this is necessary
                'password' => 'softral@10', // assuming this is necessary
                'host' => 'localhost', // assumes localhost
                'driver' => 'mysql', // replace with your database driver
            );

        endif;
        // replace 'YourDatabaseKey' with something that's unique to your module
        Database::addConnectionInfo('softral', 'default', $softral_database);
        db_set_active('softral');

        $softral_data = db_select('users', 'n')
            ->fields('n')
            ->condition('email', $_GET['username'], '=')
            ->execute()
            ->fetchAssoc();

        $softral = db_select('card_info', 'n')
            ->fields('n')
            ->condition('user_id', $softral_data['id'], '=')
            ->condition('financial_accounts_id', $_GET['f_id'], '=')
            ->execute()
            ->fetchAssoc();

        $softral_name = db_select('financial_accounts', 'n')
            ->fields('n')
            ->condition('user_id', $softral_data['id'], '=')
            ->condition('id', $_GET['f_id'], '=')
            ->execute()
            ->fetchAssoc();
        //print_r($softral);exit;

        db_set_active();

        if (isset($_GET['type']) && $_GET['type'] == 'center'):
            $label = "Mednoor Center Escrow";
            $_SESSION['type'] = 'center';
        elseif (isset($_GET['type']) && $_GET['type'] == 'pronoor_mail'):
            $label = "Ebinti Cart";
            $_SESSION['type'] = 'pronoor_mail';
        elseif (!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] == 'softral')):
            $label = "Softral Escrow";
            $_SESSION['type'] = 'softral';
        else:
            $label = $_GET['type'];
            $_SESSION['type'] = $_GET['type'];
        endif;

        if ($_SESSION['type'] != 'pronoor_mail'):
            $_SESSION['card_number'] = $softral['card_number'];
            $_SESSION['card_name'] = $softral_name['person_name'];
            $_SESSION['exp_month'] = $softral['exp_month'];
            $_SESSION['exp_year'] = $softral['exp_year'];
            $_SESSION['security_code'] = $softral['security_code'];
        endif;
        responsive_bartik_create_product($_GET['username'], $id, $amount, $label);
    //responsive_bartik_user_login_credentials($_GET['username'],'','',$id);
    else:
        $id = $user->uid;
        $user_info = array(
            'name' => $_GET['username'],
            'pass' => $decrypted_pass,
            'mail' => $_GET['email'],
            'status' => 1,
            'language' => 'en',
            'init' => $_GET['email'],
            'roles' => array(2 => 'authenticated user'),
            'access' => time()
        );
        // echo '<pre>';print_R($id);exit;
        $softral_database = array(
            'database' => 'pronoor_softral',
            'username' => 'pronoor_softral', // assuming this is necessary
            'password' => 'softral@10', // assuming this is necessary
            'host' => 'localhost', // assumes localhost
            'driver' => 'mysql', // replace with your database driver
        );
        // replace 'YourDatabaseKey' with something that's unique to your module
        Database::addConnectionInfo('softral', 'default', $softral_database);
        db_set_active('softral');

        $softral_data = db_select('users', 'n')
            ->fields('n')
            ->condition('email', $_GET['username'], '=')
            ->execute()
            ->fetchAssoc();

        $softral = db_select('card_info', 'n')
            ->fields('n')
            ->condition('user_id', $softral_data['id'], '=')
            ->condition('financial_accounts_id', $_GET['f_id'], '=')
            ->execute()
            ->fetchAssoc();

        $softral_name = db_select('financial_accounts', 'n')
            ->fields('n')
            ->condition('user_id', $softral_data['id'], '=')
            ->condition('id', $_GET['f_id'], '=')
            ->execute()
            ->fetchAssoc();

        db_set_active();


        $save = user_save(NULL, $user_info);

        if (isset($_GET['type']) && $_GET['type'] == 'center'):
            $label = "Mednoor Center Escrow";
            $_SESSION['type'] = 'center';
        elseif (isset($_GET['type']) && $_GET['type'] == 'pronoor_mail'):
            $label = "Pronoor Cart";
            $_SESSION['type'] = 'pronoor_mail';
        elseif (!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] == 'softral')):
            $label = "Softral Escrow";
            $_SESSION['type'] = 'softral';
        else:
            $label = $_GET['type'];
            $_SESSION['type'] = $_GET['type'];
        endif;

        if ($_SESSION['type'] != 'pronoor_mail'):
            $_SESSION['card_number'] = $softral['card_number'];
            $_SESSION['card_name'] = $softral_name['person_name'];
            $_SESSION['exp_month'] = $softral['exp_month'];
            $_SESSION['exp_year'] = $softral['exp_year'];
            $_SESSION['security_code'] = $softral['security_code'];
        endif;

        responsive_bartik_create_product($_GET['username'], $id, $amount, $label);

        //$GLOBALS['user'] = $save;
        //drupal_save_session(TRUE);
        //user_login_finalize();
    endif;

endif;

if (isset($_GET['email']) && isset($_GET['node'])):

    $node = $_GET['node'];

    $url_id = $_GET['encrypt_pass'];

    $EncKey = $_GET['key'];
    $str = mcrypt_decrypt(MCRYPT_DES, $EncKey, base64_decode($url_id), MCRYPT_MODE_ECB);
    # Strip padding out.
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    if ($pad && $pad < $block && preg_match(
            '/' . chr($pad) . '{' . $pad . '}$/', $str
        )
    ) {
        $decrypted_pass = substr($str, 0, strlen($str) - $pad);
    } else {
        $decrypted_pass = $str;
    }

    //$existing_user = user_authenticate($_GET['username'],$decrypted_pass);
    $existing_user1 = user_load_by_name($_GET['username']);
    //print_r($existing_user1);exit;
    if ($existing_user1):
        //$edit = array('pass' => $decrypted_pass);

        // Save the account with the new password.
        //user_save($_GET['username'], $edit);
        $id = $user->uid;
        //echo '<prE>';print_R($_POST);exit;
        responsive_bartik_user_login_credentials($_GET['username'], $decrypted_pass, $node, $id);
    else:
        $id = $user->uid;
        $user_info = array(
            'name' => $_GET['username'],
            'pass' => $decrypted_pass,
            'mail' => $_GET['email'],
            'status' => 1,
            'language' => 'en',
            'init' => $_GET['email'],
            'roles' => array(2 => 'authenticated user'),
            'access' => time()
        );


        $save = user_save(NULL, $user_info);
        //echo '<pre>';print_R($_POST);exit;
        responsive_bartik_user_login_credentials($_GET['username'], $decrypted_pass, $node, $id);
        //$GLOBALS['user'] = $save;
        //drupal_save_session(TRUE);
        //user_login_finalize();
    endif;
endif;

$current_page_title = drupal_get_title();

if (isset($_SESSION['token']) && $current_page_title == 'Checkout'):
    ?>
    <script type='text/javascript'>
        jQuery(document).ready(function () {
            jQuery("#edit-panes-payment-payment-method-credit").attr("checked", "checked");
            //jQuery('#delivery-pane').hide();
            //jQuery('#billing-pane').hide();
            jQuery('#comments-pane').remove();
            jQuery('.fieldset-description').hide();
            jQuery('#line-items-div').hide();
            jQuery('.form-item-panes-payment-payment-method').hide();
            jQuery('.section .region-sidebar-first').remove();
            jQuery('#content').css({
                'margin-left': '0%',
                'width': '100%',
            });

            jQuery('<th class="change_price">Change Price</th>').insertAfter('#cart-pane th.products');
            jQuery('<td class="change_price"><input type="textbox" name="change_price" placeholder="Change Price" ><input type="submit" value="Update"></td>').insertAfter('#cart-pane td.products');
            jQuery('#cart-pane td.subtotal').attr('colspan', 4);
            jQuery('#payment-pane .fieldset-legend').html('Add CVV Number');

            <?php if((isset($_SESSION['escrow']) && $_SESSION['escrow'] != '') || (isset($_SESSION['type']) && ($_SESSION['type'] == 'center' || $_SESSION['type'] == 'softral'))):?>
            $body = jQuery("body");
            <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'center'):?>
            jQuery('#voyager-loader').show();
            <?php else:?>
            $body.addClass("loading");
            <?php endif;?>
            jQuery('.form-checkbox').attr('checked', true);
            jQuery('#edit-continue').click();
            <?php
            else:?>
            jQuery('#voyager-loader').show();
            jQuery('.form-checkbox').attr('checked', true);
            jQuery('#edit-continue').click();
            <?php
            endif;?>

        });
    </script>
<?php
elseif ($current_page_title == 'Review order'):
    ?>
    <script type='text/javascript'>
        jQuery(window).load(function () {
            setTimeout(function () {
                jQuery('#edit-submit').click();
            }, 200);

        });
    </script>
<?php
endif;


if (isset($_GET['node'])):

    ?>
    <script type='text/javascript'>
        jQuery(document).ready(function () {
            var node = "<?php echo $_GET['node'];?>";
            var select = jQuery("#uc-product-add-to-cart-form-" + node + " select").val();
            if (select == '') {
                return false;
            }
            jQuery("#edit-submit-" + node).click();
        });
    </script>
<?php
endif;
?>

<script type='text/javascript'>
    jQuery(window).load(function () {
        //jQuery("#edit-checkout--2").val("Complete Transaction");
        setTimeout(function () {
            jQuery("#edit-pass").attr('value', '');
        }, 500);

    });
</script>

<script type='text/javascript'>
    jQuery(document).ready(function () {


        jQuery(".node-add-to-cart").click(function () {
            var id = '<?php echo $id;?>';
            if (id == 0) {
                alert('Please sign in before using shopping cart.');
                return false;
            }
        });

        jQuery("#edit-panes-billing-copy-address").change(function () {
            var c = this.checked ? 'TRUE' : 'FALSE';
            if (c == 'TRUE') {
                /* jQuery('.form-item-panes-billing-address-billing-first-name input').attr('value',jQuery('#edit-panes-delivery-address-delivery-first-name').val());
               jQuery('.form-item-panes-billing-address-billing-house-number input').attr('value',jQuery('#edit-panes-delivery-address-delivery-house-number').val());
               jQuery('.form-item-panes-billing-address-billing-title input').attr('value',jQuery('#edit-panes-delivery-address-delivery-title').val());
               jQuery('.form-item-panes-billing-address-billing-last-name input').attr('value',jQuery('#edit-panes-delivery-address-delivery-last-name').val());
               jQuery('.form-item-panes-billing-address-billing-surname-prefix input').attr('value',jQuery('#edit-panes-delivery-address-delivery-surname-prefix').val());
               jQuery('.form-item-panes-billing-address-billing-company input').attr('value',jQuery('#edit-panes-delivery-address-delivery-company').val());
               jQuery('.form-item-panes-billing-address-billing-street1 input').attr('value',jQuery('#edit-panes-delivery-address-delivery-street1').val());
               jQuery('.form-item-panes-billing-address-billing-street2 input').attr('value',jQuery('#edit-panes-delivery-address-delivery-street2').val());
               jQuery('.form-item-panes-billing-address-billing-city input').attr('value',jQuery('#edit-panes-delivery-address-delivery-city').val());
               jQuery('.form-item-panes-billing-address-billing-zone select').attr('value',jQuery('#form-item-panes-delivery-address-delivery-zone select').val());
               jQuery('.form-item-panes-billing-address-billing-country select').attr('value',jQuery('#edit-panes-delivery-address-delivery-country').val());
               jQuery('.form-item-panes-billing-address-billing-postal-code input').attr('value',jQuery('#edit-panes-delivery-address-delivery-postal-code').val());
               jQuery('.form-item-panes-billing-address-billing-phone input').attr('value',jQuery('#edit-panes-delivery-address-delivery-phone').val());  */

            }

        });

    });

    function change_data_billing_info() {
        var c = jQuery("#edit-panes-billing-copy-address").is(':checked');
        if (c == true) {
            jQuery('.form-item-panes-billing-address-billing-first-name input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-first-name input').val());
            jQuery('.form-item-panes-billing-address-billing-ucxf-middle-name input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-ucxf-middle-name input').val());
            jQuery('.form-item-panes-billing-address-billing-house-number input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-house-number input').val());
            jQuery('.form-item-panes-billing-address-billing-title input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-title input').val());
            jQuery('.form-item-panes-billing-address-billing-last-name input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-last-name input').val());
            jQuery('.form-item-panes-billing-address-billing-surname-prefix input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-surname-prefix input').val());
            jQuery('.form-item-panes-billing-address-billing-company input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-company input').val());
            jQuery('.form-item-panes-billing-address-billing-street1 input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-street1 input').val());
            jQuery('.form-item-panes-billing-address-billing-street2 input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-street2 input').val());
            jQuery('.form-item-panes-billing-address-billing-city input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-city input').val());
            jQuery('.form-item-panes-billing-address-billing-zone select').attr('value', jQuery('.form-item-panes-delivery-address-delivery-zone select').val());
            jQuery('.form-item-panes-billing-address-billing-country select').attr('value', jQuery('.form-item-panes-delivery-address-delivery-country select').val());
            jQuery('.form-item-panes-billing-address-billing-postal-code input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-postal-code inpu').val());
            jQuery('.form-item-panes-billing-address-billing-phone input').attr('value', jQuery('.form-item-panes-delivery-address-delivery-phone input').val());
        }

    }
</script>

<style>
    .name-and-slogan {
        /* float: left; */
        margin: auto;
        padding: 20px 10px 8px;
        text-align: right;
    }

    .site-name {
        color: white;
        line-height: 1;
    }

    h1.site-name {
        margin: 0;
    }

    .site-name a {
        font-weight: normal;
        color: white;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .site-name {
            display: inline-grid
        }

        .spliter{
            display: none;
        }
    }
    #logo img{
        width: 100px !important;
    }
</style>
<div id="page-wrapper">
    <div id="page">
        <div id="voyager-loader" style="display: none;">
            <img src="http://i.stack.imgur.com/FhHRx.gif" alt="Voyager Loader">
        </div>

        <header id="header" role="banner"
                class="<?php print $secondary_menu ? 'with-secondary-menu' : 'without-secondary-menu'; ?>">
            <div class="section clearfix">
                <?php if ($secondary_menu): ?>
                    <nav id="secondary-menu" role="navigation" class="navigation">
                        <?php print theme('links__system_secondary_menu', array(
                            'links' => $secondary_menu,
                            'attributes' => array(
                                'id' => 'secondary-menu-links',
                                'class' => array('links', 'inline', 'clearfix'),
                            ),
                            'heading' => array(
                                'text' => t('Secondary menu'),
                                'level' => 'h2',
                                'class' => array('element-invisible'),
                            ),
                        )); ?>
                    </nav> <!-- /#secondary-menu -->
                <?php endif; ?>

                <?php if ($logo): ?>
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
                        <img width="100px" height="100px" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
                    </a>
                <?php endif; ?>

                <?php

                $site_name='Paydada Pay';

                if ($site_name || $site_slogan): ?>
                    <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) {
                        print ' class="element-invisible"';
                    } ?>>

                        <?php if ($site_name): ?>
                            <?php if ($title): ?>
                                <div id="site-name"<?php if ($hide_site_name) {
                                    print ' class="element-invisible"';
                                } ?>>
                                    <strong>
                                        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"
                                           rel="home"><span><?php print $site_name; ?></span></a>
                                    </strong>
                                </div>
                            <?php else: /* Use h1 when the content title is empty */ ?>
                                <h1 id="site-name"<?php if ($hide_site_name) {
                                    print ' class="element-invisible"';
                                } ?>>
                                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"
                                       rel="home"><span><?php print $site_name; ?></span></a>
                                </h1>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($site_slogan): ?>
                            <div id="site-slogan"<?php if ($hide_site_slogan) {
                                print ' class="element-invisible"';
                            } ?>>
                                <?php print $site_slogan; ?>
                            </div>
                        <?php endif; ?>

                    </div> <!-- /#name-and-slogan -->
                <?php endif; ?>
                <?php if ($id): ?>
                    <div class="name-and-slogan" style="margin: auto; text-align: right">
                        <div class="site-name" style="">
                            <span class="nav-link"><?php echo 'Hi '.$user->name ?></span>
                            <span class="spliter">|</span>
                            <a class="nav-link" href="/shopping_cart/user/<?php echo $id ?>">Home </a>
                            <span class="spliter">|</span>
                            <a class="nav-link" href="https://www.paydada.com/myprofile.php?id=<?php echo $id ?>">Profile </a>
                            <span class="spliter">|</span>
                            <a class="nav-link" href="https://www.paydada.com/shopping_cart/financial/transaction">
                                Financial Transactions </a>
                            <span class="spliter">|</span>
                            <a class="nav-link" href="https://www.paydada.com/shopping_cart/financial/activity"> Financial Activity</a>
                            <span class="spliter">|</span>
                            <a class="nav-link" href="/shopping_cart/user/logout">Log out</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php print render($page['header']); ?>

                <?php if ($main_menu): ?>
                    <nav id="main-menu" role="navigation" class="navigation">
                        <?php print theme('links__system_main_menu', array(
                            'links' => $main_menu,
                            'attributes' => array(
                                'id' => 'main-menu-links',
                                'class' => array('links', 'clearfix'),
                            ),
                            'heading' => array(
                                'text' => t('Main menu'),
                                'level' => 'h2',
                                'class' => array('element-invisible'),
                            ),
                        )); ?>
                    </nav> <!-- /#main-menu -->
                <?php endif; ?>
            </div>
        </header> <!-- /.section, /#header -->

        <?php
        $message = '';

        if ($messages): ?>
            <div id="messages">
                <div class="section clearfix">
                    <?php
                    print $messages;
                    $message = str_replace(' ', '', trim(strip_tags($messages)));
                    if (strpos($message, 'Errormessage') !== false):
                        if (isset($_SESSION['redirect_url'])):
                            $message1 = str_replace('', '', trim(strip_tags($messages)));
                            $explode = explode('Error message', $message1);
                            if (isset($explode[1])):
                                drupal_goto($_SESSION['redirect_url'], array('query' => array('error' => $explode[1])));
                                exit;
                            endif;
                        endif;
                    endif;
                    ?>
                </div>
            </div> <!-- /.section, /#messages -->
        <?php endif; ?>

        <?php

        if (isset($_SESSION['type']) && ($_SESSION['type'] == 'softral')):
            if (strpos($message, 'Wewereunabletoprocessyourcreditcardpayment') !== false || strpos($message, 'Youhaveenteredaninvalidcreditcardnumber') !== false):
                if (isset($_SESSION['escrow'])):
                    $paypal_url = 'https://www.softral.com/financial/save_escrow';
                else:
                    $paypal_url = 'https://www.softral.com/admin/financial/addmoneycredit';
                endif;
                echo "<html>\n";
                echo "<head><title>Credit card rejected...</title></head>\n";
                echo "<body onLoad=\"document.forms['paypal_form'].submit();\">\n";
                echo "<center><h2>Sorry, your credit card rejected.";
                echo " will be redirected</h2></center>\n";
                echo "<form method=\"post\" name=\"paypal_form\" ";
                echo "action=\"" . $paypal_url . "\">\n";

                echo "<input type=\"hidden\" name=\"price\" value=\"0\"/>\n";
                echo "<input type=\"hidden\" name=\"credit_card\" value=\"rejected\"/>\n";
                // echo "<input type=\"hidden\" name=\"email\" value=\"$order->primary_email\"/>\n";
                // echo "<input type=\"hidden\" name=\"_token\" value=\"$token\"/>\n";


                echo "<center><br/><br/>Sorry, your credit card rejected.";
                echo "You are redirecting within 5 seconds...<br/><br/>\n";
                /*echo "<input type=\"submit\" name=\"add_money_redirect\" value=\"Click Here\"></center>\n";*/

                echo "</form>\n";
                echo "</body></html>\n";
                exit;
            endif;
        endif;
        ?>

        <?php if ($page['featured']): ?>
            <div id="featured">
                <div class="section clearfix">
                    <?php print render($page['featured']); ?>
                </div>
            </div> <!-- /.section, /#featured -->
        <?php endif; ?>

        <div id="main-wrapper" class="clearfix">
            <div id="main" role="main" class="clearfix">

                <?php //print $breadcrumb; ?>

                <div id="content" class="column">
                    <div class="section">
                        <?php if ($page['highlighted']): ?>
                            <div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
                        <a id="main-content"></a>
                        <?php print render($title_prefix); ?>
                        <?php if ($title): ?>
                            <h1 class="title" id="page-title">
                                <?php print $title; ?>
                            </h1>
                        <?php endif; ?>
                        <?php print render($title_suffix); ?>
                        <?php if ($tabs): ?>
                            <div class="tabs">
                                <?php print render($tabs); ?>
                            </div>
                        <?php endif; ?>
                        <?php print render($page['help']); ?>
                        <?php if ($action_links): ?>
                            <ul class="action-links">
                                <?php print render($action_links); ?>
                            </ul>
                        <?php endif; ?>

                        <?php //if($id!=0): ?>
                        <?php print render($page['content']); ?>
                        <?php //else: ?>
                        <!--<div align="center" style="font-size: 19px; margin-top: 125px;">Please sign in before using shopping cart.</div>-->
                        <?php //endif; ?>

                        <?php print $feed_icons; ?>

                    </div>
                </div> <!-- /.section, /#content -->

                <?php if ($page['sidebar_first']): ?>
                    <div id="sidebar-first" class="column sidebar">
                        <div class="section">
                            <?php print render($page['sidebar_first']); ?>
                        </div>
                    </div> <!-- /.section, /#sidebar-first -->
                <?php endif; ?>

                <?php if ($page['sidebar_second']): ?>
                    <div id="sidebar-second" class="column sidebar">
                        <div class="section">
                            <?php print render($page['sidebar_second']); ?>
                        </div>
                    </div> <!-- /.section, /#sidebar-second -->
                <?php endif; ?>

            </div>
        </div> <!-- /#main, /#main-wrapper -->

        <?php if ($page['triptych_first'] || $page['triptych_middle'] || $page['triptych_last']): ?>
            <div id="triptych-wrapper">
                <div id="triptych" class="clearfix">
                    <?php print render($page['triptych_first']); ?>
                    <?php print render($page['triptych_middle']); ?>
                    <?php print render($page['triptych_last']); ?>
                </div>
            </div> <!-- /#triptych, /#triptych-wrapper -->
        <?php endif; ?>

        <div id="footer-wrapper">
            <div class="section">

                <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
                    <div id="footer-columns" class="clearfix">
                        <?php print render($page['footer_firstcolumn']); ?>
                        <?php print render($page['footer_secondcolumn']); ?>
                        <?php print render($page['footer_thirdcolumn']); ?>
                        <?php print render($page['footer_fourthcolumn']); ?>
                    </div> <!-- /#footer-columns -->
                <?php endif; ?>

                <?php if ($page['footer']): ?>
                    <footer id="footer" role="contentinfo" class="clearfix">
                        <?php print render($page['footer']); ?>
                    </footer> <!-- /#footer -->
                <?php endif; ?>
                <style>
                    #voyager-loader {
                        position: fixed;
                        z-index: 10000;
                        top: 0;
                        left: 0;
                        height: 100%;
                        width: 100%;
                        text-align: center;
                        background-color: white;
                        opacity: 0.99;
                    }
                </style>
                <?php /*if(isset($_SESSION['type']) && $_SESSION['type']=='center'):
		
	elseif(isset($_SESSION['type']) && $_SESSION['type']=='pronoor_mail'):
		?><style>.form-item-panes-payment-details-cc-owner, .form-item-panes-payment-details-cc-number, .form-item-panes-payment-details-cc-exp-month, .form-item-panes-payment-details-cc-exp-year, #payment-details p{display:block !important}
</style><?php
	elseif(!isset($_SESSION['type']) || (isset($_SESSION['type']) && $_SESSION['type']=='softral')):
		
	else:
		?><style>.form-item-panes-payment-details-cc-owner, .form-item-panes-payment-details-cc-number, .form-item-panes-payment-details-cc-exp-month, .form-item-panes-payment-details-cc-exp-year, #payment-details p{display:block !important}
</style><?php
	endif;*/ ?>


            </div>
        </div> <!-- /.section, /#footer-wrapper -->

    </div>
</div> <!-- /#page, /#page-wrapper -->
