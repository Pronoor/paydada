<?php $base_path = 'https://paydada.com/'?>

<link href="https://paydada.com/mail/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php print $base_path ; ?>Document_files/style.css">
    <!-- MetisMenu CSS -->
    <link href="https://paydada.com/mail/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="https://paydada.com/mail/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="https://paydada.com/mail/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="https://paydada.com/mail/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://paydada.com/mail/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	 <link href="https://paydada.com/mail/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="https://paydada.com/mail/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://paydada.com/mail/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="https://paydada.com/mail/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="https://paydada.com/mail/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://paydada.com/mail/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;height: 148px;">
            <div class="navbar-header" style="width: 40%">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
				<a class="navbar-brand" href="https://paydada.com/mail/admin/index"><!--<?=isset($_GET['logotitle'])?$_GET['logotitle']:''?> partners with ProNoor for secure Financial Transactions--></a>

            </div>
            <!-- /.navbar-header -->
			
		
<a  href="https://www.paydada.com">
<h1 style='color: blue;'>PayDada</h1>
<center><p style='margin-left:-154px'>Home Of Secure Connections</p></center>

</a>


            <ul class="nav navbar-top-links navbar-right" style='margin-top: -98px;'>
			<a class="btn btn-primary" href="https://pronoor.com" style="width:auto;height:auto">Home</a>&nbsp;&nbsp;
				Hello, <strong>Guest</strong>
				
                <li class="dropdown">
				
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
										<ul class="dropdown-menu dropdown-user">
						<li><a href="https://paydada.com/mail/?url=admin/login"><i class="fa fa-sign-out fa-fw"></i> Login</a>
						<li><a href="https://paydada.com/mail/?url=admin/register"><i class="fa fa-sign-out fa-fw"></i> Register</a>
<!--						<li><a href="#"><i class="fa fa-dashboard fa-fw"></i> Financial Accounts</a></li>-->
<!--						<li><a href="#"><i class="fa fa-dashboard fa-fw"></i> Deposit</a></li>-->
<!--						<li><a href="#"><i class="fa fa-dashboard fa-fw"></i> Withdrawal</a></li>-->
<!--						<li><a href="#"><i class="fa fa-dashboard fa-fw"></i> Financial Transactions</a></li>-->
<!--						<li><a href="#"><i class="fa fa-dashboard fa-fw"></i> Financial Activity</a></li>-->
					</ul>
					                    <!-- /.dropdown-user -->
					
                </li>
				
                <!-- /.dropdown -->
            </ul>
			
            <!-- /.navbar-top-links -->

            <br>
			 <span class='pull-right mobile_image' style=''><p><strong>US$</strong></p><img width='248px' src='https://pronoor.com/images/imgpsh_fullsize.jpg'></span>
			
        </nav>
		<div id="page-wrapper"style='min-height: 1507px;margin:0 0 0 0'>

            <div class="row">
                <div class="col-lg-12">
				
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<?php if(isset($_GET['error'])) {?>
                    <div class="alert alert-danger"><?php echo $_GET['error']?></div>
                <?php } elseif(isset($_GET['success'])) {?>
                    <div class="alert alert-success">Payment made successfully </div>
                <?php } ?>
			<center><h1 style=''>PAYDADA PAY</H1></center>
			<center><div class="col-lg-8 col-md-push-2">
                                  
				
				
				
<?php 
global $user;
/*$other_database  = array(
			  'database' => 'ebinti_emailnew',
			  'username' => 'ebinti_shopping_cart', // assuming this is necessary
			  'password' => 'Ebiti@10', // assuming this is necessary
			  'host' => 'localhost', // assumes localhost
			  'port' => '3306', // assumes localhost
			  'driver' => 'mysql', // replace with your database driver
		  );*/
$other_database  = array(
			  'database' => 'pronoor_emailnew',
			  'username' => 'pronoor_email', // assuming this is necessary
			  'password' => 'Pronoremail@10', // assuming this is necessary
			  'host' => 'localhost', // assumes localhost
			  'port' => '3306', // assumes localhost
			  'driver' => 'mysql', // replace with your database driver
		  );

Database::addConnectionInfo('mail', 'default', $other_database );
db_set_active('mail');
 $mail_data = db_select('user', 'n')
        ->fields('n')
        ->condition('email', $user->mail, '=')
        ->execute()
        ->fetchAssoc();

		 $credit_data = db_select('credit_cards', 'n')
        ->fields('n')
        ->condition('user_id',  $mail_data['id'], '=')
        ->execute()
        ->fetchAll();
		db_set_active();
		
		?>
<div id=""><div id="page">
  <div class="checkout-panel">
  <form action='<?php print $base_path; ?>' method='post'>
    <div class="panel-body">
   
<?php 
session_start();
 if(isset($_POST['redirect_url'])):
	$_SESSION['redirect_url']=$_POST['redirect_url'];
 endif;
 if(isset($_GET['redirect_url'])):
	$_SESSION['redirect_url']=$_GET['redirect_url'];
 endif;
 
if(!isset($_SESSION['redirect_url'])):
	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$_SESSION['redirect_url']=$actual_link.'?success';
endif;
$_SESSION['redirect_url']="https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?success";
?>

	<div class="row">
						<div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group" <?php if(isset($_POST['cart_price'])):?>style='padding-top:11px'<?php endif;?>>
								<!--<label for="exampleInputEmail1">Amount:<span class='required'>*</span></label>-->
								<!--<input type="text" placeholder="msg" name="msg" id="email" class="form-control"  value="" />-->
								<?php if(isset($_POST['cart_price'])):?>
									<input type="hidden" name="nasty_thing" id="nasty_thing" value='<?php echo responsive_bartik_get_enscrypt($_POST['cart_price']);?>' class="form-control" /><span style=''><input type='text' style='width:40%;background-color:gainsboro' value="$<?php echo $_POST['cart_price'];?>" readonly /></strong></span>
								<?php else:?>
									<input type="text" name="amount" id="amount" placeholder="Enter amount" required class="form-control" value="<?php if(isset($_SESSION['credit_form_data']['amount'])):echo $_SESSION['credit_form_data']['amount'];endif;?>"/>
								<?php endif;?>
							</div>
						</div>
						
						<div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group">
								<!--<label for="exampleInputEmail1">Email:<span class='required'>*</span></label>-->
								<!--<input type="text" placeholder="msg" name="msg" id="email" class="form-control"  value="" />-->
								<input type="email" name="email" id="email" placeholder="Enter email" required class="form-control" value="<?php if(isset($_SESSION['credit_form_data']['email'])):echo $_SESSION['credit_form_data']['email'];endif;?>"/>
							</div>
						</div>
				
					</div>

     <div class="row">
						<div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group">
						<!--  <label for="cardholder">Cardholder's Name</label>-->
						  <input type="text" required id="cardholder" name='card_holder' placeholder='Cardholder name' class="warning" value="<?php if(isset($credit_data[0]->card_holder)):echo $credit_data[0]->card_holder;elseif(isset($credit_holder_name[0]->person_name)):echo $credit_holder_name[0]->person_name;elseif(isset($_SESSION['credit_form_data']['card_holder'])):echo $_SESSION['credit_form_data']['card_holder'];endif;?>">
		  </div>
		  </div>

         <div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group">
			<!--<label for="cardnumber">Card Number</label>-->
		  <?php $credit_condition=0;if(!empty($credit_data)):$credit_condition=1;
			?> 
			<select name='card_number_select' class="warning" style="width:88%" id='card_number_select'>
			<?php foreach($credit_data as $credit):?>
				<option value='<?php echo $credit->id;?>'><?php echo responsive_bartik_get_half_enscrypt($credit->card_number);?></option>
			<?php endforeach;?>
			</select><a href="void:javascript();" class="btn next-btn anchor_add_credit" id="add_credit" style="
    float: right;
    display: inline;
    width: 9%;
    padding: 12px;
">+</a>
			<?php else:?>
			<a href="void:javascript();" class="btn next-btn anchor_add_credit" id="add_credit" style="
    float: right;
    display: inline;
    width: 9%;
    padding: 12px;display:none
">+</a>
			 <input type="text" name='card_number' placeholder='Card number' id="cardnumber" class="warning"> <p class="log"></p>
			<?php endif;?>
			<span class='add_credit'></span>
			</div></div>
		</div>
			
			<div class="row">
						<div class="pull-left col-xs-12 col-sm-12 col-md-3 col-lg-3" >
							<div class="form-group">
              <!--<label for="date">Valid thru</label>-->
              <!--<input type="text" required id="date" name='date' placeholder="MM / YYYY" class="warning" value="<?php if(isset($credit_data[0]->exp_month)):echo responsive_bartik_get_descrypt($credit_data[0]->exp_month).'/'.responsive_bartik_get_descrypt($credit_data[0]->exp_year);endif;?>">-->
			  <?php if(isset($credit_data[0]->exp_month)): 
					$month=responsive_bartik_get_descrypt($credit_data[0]->exp_month);
				else:
					$month='';
				endif;?>
			  <select name="month" class="warning" style='width:40%;float:left;padding-right:3px'>
				<option value='01' <?php if(01==$month):echo "selected='selected'";endif;?>>1</option>
				<option value='02' <?php if(02==$month):echo "selected='selected'";endif;?>>2</option>
				<option value='03' <?php if(03==$month):echo "selected='selected'";endif;?>>3</option>
				<option value='04' <?php if(04==$month):echo "selected='selected'";endif;?>>4</option>
				<option value='05' <?php if(05==$month):echo "selected='selected'";endif;?>>5</option>
				<option value='06' <?php if(06==$month):echo "selected='selected'";endif;?>>6</option>
				<option value='07' <?php if(07==$month):echo "selected='selected'";endif;?>>7</option>
				<option value='08' <?php if(08==$month):echo "selected='selected'";endif;?>>8</option>
				<option value='09' <?php if(09==$month):echo "selected='selected'";endif;?>>9</option>
				<option value='10' <?php if(10==$month):echo "selected='selected'";endif;?>>10</option>
				<option value='11' <?php if(11==$month):echo "selected='selected'";endif;?>>11</option>
				<option value='12' <?php if(12==$month):echo "selected='selected'";endif;?>>12</option>
			  </select>
			  <?php if(isset($credit_data[0]->exp_month)): 
					$year=responsive_bartik_get_descrypt($credit_data[0]->exp_year);
				else:
					$year='';
				endif;
				?>
			  <select name="year" class="warning" style='width:55%;'>
				<?php 
				for($i = date('Y') ; $i < date('Y')+10; $i++){
					print '<option value="'.$i.'"'.($i === $year ? ' selected="selected"' : '').'>'.$i.'</option>';
				  } ?>
			  </select>
			  </div>
			  </div>
			  <div class="pull-left col-xs-12 col-sm-12 col-md-3 col-lg-3" >
			  			<div class="form-group">
              <!--<label for="verification">CVV / CVC *</label>-->
              <input type="text" required placeholder='CVV' style="width:96%" name='cvv' id="verification" class="warning">
            </div>
            
            </div>

            <div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" ><div class="form-group">
				     <input type="text" required placeholder='Billing address' id="billing_address" name='billing_address' class="warning" value="<?php if(isset($credit_data[0]->address)):echo $credit_data[0]->address;elseif(isset($_SESSION['credit_form_data']['billing_address'])):echo $_SESSION['credit_form_data']['billing_address'];endif;?>"></div>
          </div>
          </div>
		  
		 <div class="row">
						<div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group">
             <!-- <label for="date">Country</label>-->
              <select id="country" name='country' class="green_light_border country" required="">
																	<option value="Afghanistan" title="AF">Afghanistan</option>
																	<option value="Albania" title="AL">Albania</option>
																	<option value="Algeria" title="DZA">Algeria</option>
																	<option value="American Samoa" title="ASM">American Samoa</option>
																	<option value="Andorra" title="AND">Andorra</option>
																	<option value="Angola" title="AO">Angola</option>
																	<option value="Anguilla" title="AIA">Anguilla</option>
																	<option value="Antarctica" title="ATA">Antarctica</option>
																	<option value="Antigua and Barbuda" title="ATG">Antigua and Barbuda</option>
																	<option value="Argentina" title="ARG">Argentina</option>
																	<option value="Armenia" title="ARM">Armenia</option>
																	<option value="Aruba" title="ABW">Aruba</option>
																	<option value="Austalia" title="AUS">Austalia</option>
																	<option value="Austria" title="AUT">Austria</option>
																	<option value="Azerbaijan" title="AZE">Azerbaijan</option>
																	<option value="Bahamas" title="BHS">Bahamas</option>
																	<option value="Bahrain" title="BHR">Bahrain</option>
																	<option value="Bangladesh" title="BD">Bangladesh</option>
																	<option value="Barbados" title="BRB">Barbados</option>
																	<option value="Belarus" title="BLR">Belarus</option>
																	<option value="Belgium" title="BEL">Belgium</option>
																	<option value="Belize" title="BLZ">Belize</option>
																	<option value="Benin" title="BEN">Benin</option>
																	<option value="Bermuda" title="BMU">Bermuda</option>
																	<option value="Bhutan" title="BTN">Bhutan</option>
																	<option value="Bolivia" title="BOL">Bolivia</option>
																	<option value="Bosnia and Herzegovina" title="BIH">Bosnia and Herzegovina</option>
																	<option value="Botswana" title="BWA">Botswana</option>
																	<option value="Brazil-" title="BRA">Brazil-</option>
																	<option value="British Indian Ocean Territory" title="IOT">British Indian Ocean Territory</option>
																	<option value="British Virgin Islands" title="VGB">British Virgin Islands</option>
																	<option value="Brunei" title="BRN">Brunei</option>
																	<option value="Bulgaria" title="BGR">Bulgaria</option>
																	<option value="Burkina Faso" title="BFA">Burkina Faso</option>
																	<option value="Burundi" title="BDI">Burundi</option>
																	<option value="Cambodia" title="KHM">Cambodia</option>
																	<option value="Cameroon" title="CMR">Cameroon</option>
																	<option value="Canada" title="CAN">Canada</option>
																	<option value="Cape Verde" title="CPV">Cape Verde</option>
																	<option value="Cayman Islands" title="CYM">Cayman Islands</option>
																	<option value="Central African Republic" title="CAF">Central African Republic</option>
																	<option value="Chad" title="TCD">Chad</option>
																	<option value="Chile" title="CHL">Chile</option>
																	<option value="China" title="CHN">China</option>
																	<option value="Christmas Island" title="CXR">Christmas Island</option>
																	<option value="Cocos Islands" title="CCK">Cocos Islands</option>
																	<option value="Colombia" title="COL">Colombia</option>
																	<option value="Comoros" title="COM">Comoros</option>
																	<option value="Cook Islands" title="COK">Cook Islands</option>
																	<option value="Costa Rica" title="CRI">Costa Rica</option>
																	<option value="Croatia" title="HRV">Croatia</option>
																	<option value="Cuba" title="CUB">Cuba</option>
																	<option value="Curacao" title="CUW">Curacao</option>
																	<option value="Cyprus" title="CYP">Cyprus</option>
																	<option value="Czech Republic" title="CZE">Czech Republic</option>
																	<option value="Democratic Republic of the Congo" title="COD">Democratic Republic of the Congo</option>
																	<option value="Denmark" title="DNK">Denmark</option>
																	<option value="Djibouti" title="DJI">Djibouti</option>
																	<option value="Dominica" title="DMA">Dominica</option>
																	<option value="Dominican Republic" title="DOM">Dominican Republic</option>
																	<option value="East Timor" title="TLS">East Timor</option>
																	<option value="Ecuador" title="ECU">Ecuador</option>
																	<option value="Egypt" title="EGY">Egypt</option>
																	<option value="El Salvador" title="SLV">El Salvador</option>
																	<option value="Equatorial Guinea" title="GNQ">Equatorial Guinea</option>
																	<option value="Eritrea" title="ERI">Eritrea</option>
																	<option value="Estonia" title="EST">Estonia</option>
																	<option value="Ethiopia" title="ETH">Ethiopia</option>
																	<option value="Falkland Islands" title="FLK">Falkland Islands</option>
																	<option value="Faroe Islands" title="FRO">Faroe Islands</option>
																	<option value="Fiji" title="FJI">Fiji</option>
																	<option value="Finland" title="Fin">Finland</option>
																	<option value="France" title="FRA">France</option>
																	<option value="French Polynesia" title="PYF">French Polynesia</option>
																	<option value="Gabon" title="GAB">Gabon</option>
																	<option value="Gambia" title="GMB">Gambia</option>
																	<option value="Georgia" title="GEO">Georgia</option>
																	<option value="Germany" title="GER">Germany</option>
																	<option value="Ghana" title="GHA">Ghana</option>
																	<option value="Gibraltar" title="GIB">Gibraltar</option>
																	<option value="Greece" title="GRC">Greece</option>
																	<option value="Greenland" title="GRL">Greenland</option>
																	<option value="Grenada" title="GRD">Grenada</option>
																	<option value="Guam" title="GUM">Guam</option>
																	<option value="Guatemala" title="GTM">Guatemala</option>
																	<option value="Guernsey" title="GGY">Guernsey</option>
																	<option value="Guinea" title="GIN">Guinea</option>
																	<option value="Guinea-Bissau" title="GNB">Guinea-Bissau</option>
																	<option value="Guyana" title="GUY">Guyana</option>
																	<option value="Haiti" title="HTI">Haiti</option>
																	<option value="Honduras" title="HND">Honduras</option>
																	<option value="Hong Kong" title="HKG">Hong Kong</option>
																	<option value="Hungary" title="HUN">Hungary</option>
																	<option value="Iceland" title="ISL">Iceland</option>
																	<option value="India" title="IND">India</option>
																	<option value="Indonesia" title="IDN">Indonesia</option>
																	<option value="Iran" title="IRN">Iran</option>
																	<option value="Iraq" title="IRQ">Iraq</option>
																	<option value="Ireland" title="IRL">Ireland</option>
																	<option value="Isle of Man" title="IMN">Isle of Man</option>
																	<option value="Israel" title="ISR">Israel</option>
																	<option value="Italy" title="ITA">Italy</option>
																	<option value="Ivory Coast" title="CIV">Ivory Coast</option>
																	<option value="Jamaica" title="JAM">Jamaica</option>
																	<option value="Japan" title="JPN">Japan</option>
																	<option value="Jersey" title="JEY">Jersey</option>
																	<option value="Jordan" title="JOR">Jordan</option>
																	<option value="Kazakhstan" title="KAZ">Kazakhstan</option>
																	<option value="Kenya" title="KEN">Kenya</option>
																	<option value="Kiribati" title="KIR">Kiribati</option>
																	<option value="Kosovo" title="XKX">Kosovo</option>
																	<option value="Kuwait" title="KWT">Kuwait</option>
																	<option value="Kyrgyzstan" title="KGZ">Kyrgyzstan</option>
																	<option value="Laos" title="LAO">Laos</option>
																	<option value="Latvia" title="LVa">Latvia</option>
																	<option value="Lebanon" title="LBN">Lebanon</option>
																	<option value="Lesotho" title="LSO">Lesotho</option>
																	<option value="Liberia" title="LBR">Liberia</option>
																	<option value="Libya" title="LBY">Libya</option>
																	<option value="Liechtenstein" title="LIE">Liechtenstein</option>
																	<option value="Lithuania" title="LTU">Lithuania</option>
																	<option value="Luxembourg" title="LUX">Luxembourg</option>
																	<option value="Macau" title="MAC">Macau</option>
																	<option value="Macedonia" title="MKD">Macedonia</option>
																	<option value="Malawi" title="MWI">Malawi</option>
																	<option value="Malaysia" title="MYS">Malaysia</option>
																	<option value="Maldives" title="MDV">Maldives</option>
																	<option value="Mali" title="MLI">Mali</option>
																	<option value="Malta" title="MLT">Malta</option>
																	<option value="Marshall Islands" title="MHL">Marshall Islands</option>
																	<option value="Mauritania" title="MRT">Mauritania</option>
																	<option value="Mauritius" title="MUS">Mauritius</option>
																	<option value="Mayotte" title="MYT">Mayotte</option>
																	<option value="Mexico" title="Mex">Mexico</option>
																	<option value="Micronesia" title="FSM">Micronesia</option>
																	<option value="Moldova" title="MDA">Moldova</option>
																	<option value="Monaco" title="MCO">Monaco</option>
																	<option value="Mongolia" title="MNG">Mongolia</option>
																	<option value="Montenegro" title="MNE">Montenegro</option>
																	<option value="Montserrat" title="MSR">Montserrat</option>
																	<option value="Morocco" title="MAR">Morocco</option>
																	<option value="Mozambique" title="MOZ">Mozambique</option>
																	<option value="Myanmar" title="MMR">Myanmar</option>
																	<option value="Namibia" title="NAM">Namibia</option>
																	<option value="Nauru" title="NRU">Nauru</option>
																	<option value="Nepal" title="NPL">Nepal</option>
																	<option value="Netherlands" title="NLD">Netherlands</option>
																	<option value="Netherlands Antilles" title="ANT">Netherlands Antilles</option>
																	<option value="New Caledonia" title="NCL">New Caledonia</option>
																	<option value="New Zealand" title="NZL">New Zealand</option>
																	<option value="Nicaragua" title="NIC">Nicaragua</option>
																	<option value="Niger" title="NER">Niger</option>
																	<option value="Nigeria" title="NGA">Nigeria</option>
																	<option value="North Korea" title="PRK">North Korea</option>
																	<option value="North Mariana Islands" title="MNP">North Mariana Islands</option>
																	<option value="Norway" title="NOR">Norway</option>
																	<option value="Oman" title="OMN">Oman</option>
																	<option value="Pakistan" title="PK">Pakistan</option>
																	<option value="Palau" title="PLW">Palau</option>
																	<option value="Palestine" title="PSE">Palestine</option>
																	<option value="Panama" title="PAN">Panama</option>
																	<option value="Papua New Guinea" title="PNG">Papua New Guinea</option>
																	<option value="Paraguay" title="PRY">Paraguay</option>
																	<option value="Peru" title="PER">Peru</option>
																	<option value="Philippines" title="PHL">Philippines</option>
																	<option value="Pitcairn" title="PCN">Pitcairn</option>
																	<option value="Poland" title="POL">Poland</option>
																	<option value="Portugal" title="PRT">Portugal</option>
																	<option value="Puerto Rico" title="PRI">Puerto Rico</option>
																	<option value="Qatar" title="QAT">Qatar</option>
																	<option value="Republic of the Congo" title="COG">Republic of the Congo</option>
																	<option value="Romania" title="ROU">Romania</option>
																	<option value="Russia" title="RU">Russia</option>
																	<option value="Rwanda" title="RWA">Rwanda</option>
																	<option value="Saint Barthelemy" title="BLM">Saint Barthelemy</option>
																	<option value="Saint Helena" title="SHN">Saint Helena</option>
																	<option value="Saint Kitts and Nevis" title="KNA">Saint Kitts and Nevis</option>
																	<option value="Saint Lucia" title="LCA">Saint Lucia</option>
																	<option value="Saint Martin" title="MAF">Saint Martin</option>
																	<option value="Saint Pierre and Miquelon" title="SPM">Saint Pierre and Miquelon</option>
																	<option value="Saint Vincent and the Grenadines" title="VCT">Saint Vincent and the Grenadines</option>
																	<option value="Samoa" title="WSM">Samoa</option>
																	<option value="San Marino" title="SMR">San Marino</option>
																	<option value="Sao Tome and Principe" title="STP">Sao Tome and Principe</option>
																	<option value="Saudi Arabia" title="SAU">Saudi Arabia</option>
																	<option value="Seirra Leone" title="SLE">Seirra Leone</option>
																	<option value="Senegal" title="SEN">Senegal</option>
																	<option value="Serbia" title="SRB">Serbia</option>
																	<option value="Seychelles" title="SYC">Seychelles</option>
																	<option value="Singapore" title="SGP">Singapore</option>
																	<option value="Sint Maarten" title="SXM">Sint Maarten</option>
																	<option value="Slovakia" title="SVK">Slovakia</option>
																	<option value="Slovania" title="SVN">Slovania</option>
																	<option value="Solomon Islands" title="SLB">Solomon Islands</option>
																	<option value="Somalia" title="SOM">Somalia</option>
																	<option value="South Africa" title="SA">South Africa</option>
																	<option value="South Korea" title="KOR">South Korea</option>
																	<option value="South Sudan" title="SSD">South Sudan</option>
																	<option value="Spain" title="ESP">Spain</option>
																	<option value="Sri Lanka" title="LKA">Sri Lanka</option>
																	<option value="Sudan" title="SDN">Sudan</option>
																	<option value="Suriname" title="SUR">Suriname</option>
																	<option value="Svalbard and Jan Mayen" title="SJM">Svalbard and Jan Mayen</option>
																	<option value="Swaziland" title="SWZ">Swaziland</option>
																	<option value="Sweden" title="SWE">Sweden</option>
																	<option value="Switzerland" title="CHE">Switzerland</option>
																	<option value="Syria" title="SYR">Syria</option>
																	<option value="Taiwan" title="TWN">Taiwan</option>
																	<option value="Tajikistan" title="TJK">Tajikistan</option>
																	<option value="Tanzania" title="TZA">Tanzania</option>
																	<option value="Thailand" title="THA">Thailand</option>
																	<option value="Togo" title="TGO">Togo</option>
																	<option value="Tokelau" title="TKL">Tokelau</option>
																	<option value="Tonga" title="TON">Tonga</option>
																	<option value="Trinidad and Tobago" title="TTO">Trinidad and Tobago</option>
																	<option value="Tunisia" title="TUN">Tunisia</option>
																	<option value="Turkey" title="TK">Turkey</option>
																	<option value="Turks and Caicos Islands" title="TCA">Turks and Caicos Islands</option>
																	<option value="Turmenistan" title="TKM">Turmenistan</option>
																	<option value="Tuvalu" title="TUV">Tuvalu</option>
																	<option value="U.S. Virgine Islands" title="VIR">U.S. Virgine Islands</option>
																	<option value="Uganda" title="UGA">Uganda</option>
																	<option value="Ukrain" title="UKR">Ukrain</option>
																	<option value="United Arab Emirates" title="ARE">United Arab Emirates</option>
																	<option value="United Kingdom" title="UK">United Kingdom</option>
																	<option value="Uruguay" title="URY">Uruguay</option>
																	<option value="USA" title="USA" selected="selected">USA</option>
																	<option value="Uzbeckistan" title="UZB">Uzbeckistan</option>
																	<option value="Vanuatu" title="VUT">Vanuatu</option>
																	<option value="Vatican" title="VAT">Vatican</option>
																	<option value="Venezuela" title="VEN">Venezuela</option>
																	<option value="Vietnam" title="VNM">Vietnam</option>
																	<option value="Wallis and Futuna" title="WLF">Wallis and Futuna</option>
																	<option value="Western Sahara" title="ESH">Western Sahara</option>
																	<option value="Yemen" title="YEM">Yemen</option>
																	<option value="Zambia" title="ZMB">Zambia</option>
																	<option value="Zimbabwe" title="ZWE">Zimbabwe</option>
																</select>
																
																<select class="form-control country_code" id="country_code" required="required" name="country_code" style='display:none'><option value="">Select Country Code</option><option value="Afghanistan">93</option><option value="Åland Islands">358</option><option value="Albania">355</option><option value="Algeria">213</option><option value="American Samoa">1</option><option value="Andorra">376</option><option value="Angola">244</option><option value="Anguilla">1</option><option value="Antarctica">672</option><option value="Antigua and Barbuda">1</option><option value="Argentina">54</option><option value="Armenia">374</option><option value="Aruba">297</option><option value="Australia">61</option><option value="Austria">43</option><option value="Azerbaijan">994</option><option value="Bahamas">1</option><option value="Bahrain">973</option><option value="Bangladesh">880</option><option value="Barbados">1</option><option value="Belarus">375</option><option value="Belgium">32</option><option value="Belize">501</option><option value="Benin">229</option><option value="Bermuda">1</option><option value="Bhutan">975</option><option value="Bolivia, Plurinational State of">591</option><option value="Bonaire, Sint Eustatius and Saba">599</option><option value="Bosnia and Herzegovina">387</option><option value="Botswana">267</option><option value="Bouvet Island">47</option><option value="Brazil">55</option><option value="British Indian Ocean Territory">246</option><option value="Brunei Darussalam">673</option><option value="Bulgaria">359</option><option value="Burkina Faso">226</option><option value="Burundi">257</option><option value="Cambodia">855</option><option value="Cameroon">237</option><option value="Canada">1</option><option value="Cape Verde">238</option><option value="Cayman Islands">1</option><option value="Central African Republic">236</option><option value="Chad">235</option><option value="Chile">56</option><option value="China">86</option><option value="Christmas Island">61</option><option value="Cocos (Keeling) Islands">61</option><option value="Colombia">57</option><option value="Comoros">269</option><option value="Congo">242</option><option value="Congo, the Democratic Republic of the">243</option><option value="Cook Islands">682</option><option value="Costa Rica">506</option><option value="Côte d'Ivoire">225</option><option value="Croatia">385</option><option value="Cuba">53</option><option value="Curaçao">599</option><option value="Cyprus">357</option><option value="Czech Republic">420</option><option value="Denmark">45</option><option value="Djibouti">253</option><option value="Dominica">1</option><option value="Dominican Republic">1</option><option value="Ecuador">593</option><option value="Egypt">20</option><option value="El Salvador">503</option><option value="Equatorial Guinea">240</option><option value="Eritrea">291</option><option value="Estonia">372</option><option value="Ethiopia">251</option><option value="Falkland Islands (Malvinas)">500</option><option value="Faroe Islands">298</option><option value="Fiji">679</option><option value="Finland">358</option><option value="France">33</option><option value="French Guiana">594</option><option value="French Polynesia">689</option><option value="French Southern Territories">33</option><option value="Gabon">241</option><option value="Gambia">220</option><option value="Georgia">995</option><option value="Germany">49</option><option value="Ghana">233</option><option value="Gibraltar">350</option><option value="Greece">30</option><option value="Greenland">299</option><option value="Grenada">1</option><option value="Guadeloupe">590</option><option value="Guam">1</option><option value="Guatemala">502</option><option value="Guernsey">44</option><option value="Guinea">224</option><option value="Guinea-Bissau">245</option><option value="Guyana">592</option><option value="Haiti">509</option><option value="Heard Island and McDonald Islands">61</option><option value="Holy See (Vatican City State)">39</option><option value="Honduras">504</option><option value="Hong Kong">852</option><option value="Hungary">36</option><option value="Iceland">354</option><option value="India">91</option><option value="Indonesia">62</option><option value="Iran, Islamic Republic of">98</option><option value="Iraq">964</option><option value="Ireland">353</option><option value="Isle of Man">44</option><option value="Israel">972</option><option value="Italy">39</option><option value="Jamaica">1</option><option value="Japan">81</option><option value="Jersey">44</option><option value="Jordan">962</option><option value="Kazakhstan">7</option><option value="Kenya">254</option><option value="Kiribati">686</option><option value="Korea, Democratic People's Republic of">850</option><option value="Korea, Republic of">82</option><option value="Kuwait">965</option><option value="Kyrgyzstan">996</option><option value="Lao People's Democratic Republic">856</option><option value="Latvia">371</option><option value="Lebanon">961</option><option value="Lesotho">266</option><option value="Liberia">231</option><option value="Libya">218</option><option value="Liechtenstein">423</option><option value="Lithuania">370</option><option value="Luxembourg">352</option><option value="Macao">853</option><option value="Macedonia, the former Yugoslav Republic of">389</option><option value="Madagascar">261</option><option value="Malawi">265</option><option value="Malaysia">60</option><option value="Maldives">960</option><option value="Mali">223</option><option value="Malta">356</option><option value="Marshall Islands">692</option><option value="Martinique">596</option><option value="Mauritania">222</option><option value="Mauritius">230</option><option value="Mayotte">262</option><option value="Mexico">52</option><option value="Micronesia, Federated States of">691</option><option value="Moldova, Republic of">373</option><option value="Monaco">377</option><option value="Mongolia">976</option><option value="Montenegro">382</option><option value="Montserrat">1</option><option value="Morocco">212</option><option value="Mozambique">258</option><option value="Myanmar">95</option><option value="Namibia">264</option><option value="Nauru">674</option><option value="Nepal">977</option><option value="Netherlands">31</option><option value="New Caledonia">687</option><option value="New Zealand">64</option><option value="Nicaragua">505</option><option value="Niger">227</option><option value="Nigeria">234</option><option value="Niue">683</option><option value="Norfolk Island">672</option><option value="Northern Mariana Islands">1</option><option value="Norway">47</option><option value="Oman">968</option><option value="Pakistan">92</option><option value="Palau">680</option><option value="Palestinian Territory, Occupied">970</option><option value="Panama">507</option><option value="Papua New Guinea">675</option><option value="Paraguay">595</option><option value="Peru">51</option><option value="Philippines">63</option><option value="Pitcairn">649</option><option value="Poland">48</option><option value="Portugal">351</option><option value="Puerto Rico">1</option><option value="Qatar">974</option><option value="Réunion">262</option><option value="Romania">40</option><option value="Russian Federation">7</option><option value="Rwanda">250</option><option value="Saint Barthélemy">590</option><option value="Saint Helena, Ascension and Tristan da Cunha">290</option><option value="Saint Kitts and Nevis">1</option><option value="Saint Lucia">1</option><option value="Saint Martin (French part)">590</option><option value="Saint Pierre and Miquelon">508</option><option value="Saint Vincent and the Grenadines">1</option><option value="Samoa">685</option><option value="San Marino">378</option><option value="Sao Tome and Principe">239</option><option value="Saudi Arabia">966</option><option value="Senegal">221</option><option value="Serbia">381</option><option value="Seychelles">248</option><option value="Sierra Leone">232</option><option value="Singapore">65</option><option value="Sint Maarten (Dutch part)">721</option><option value="Slovakia">421</option><option value="Slovenia">386</option><option value="Solomon Islands">677</option><option value="Somalia">252</option><option value="South Africa">27</option><option value="South Georgia and the South Sandwich Islands">44</option><option value="South Sudan">211</option><option value="Spain">34</option><option value="Sri Lanka">94</option><option value="Sudan">249</option><option value="Suriname">597</option><option value="Svalbard and Jan Mayen">47</option><option value="Swaziland">268</option><option value="Sweden">46</option><option value="Switzerland">41</option><option value="Syrian Arab Republic">963</option><option value="Taiwan, Province of China">886</option><option value="Tajikistan">992</option><option value="Tanzania, United Republic of">255</option><option value="Thailand">66</option><option value="Timor-Leste">670</option><option value="Togo">228</option><option value="Tokelau">690</option><option value="Tonga">676</option><option value="Trinidad and Tobago">1</option><option value="Tunisia">216</option><option value="Turkey">90</option><option value="Turkmenistan">993</option><option value="Turks and Caicos Islands">1</option><option value="Tuvalu">688</option><option value="Uganda">256</option><option value="Ukraine">380</option><option value="United Arab Emirates">971</option><option value="United Kingdom">44</option><option value="USA" selected="selected">1</option><option value="United States Minor Outlying Islands">1</option><option value="Uruguay">598</option><option value="Uzbekistan">998</option><option value="Vanuatu">678</option><option value="Venezuela, Bolivarian Republic of">58</option><option value="Viet Nam">84</option><option value="Virgin Islands, British">1</option><option value="Virgin Islands, U.S.">1</option><option value="Wallis and Futuna">681</option><option value="Western Sahara">212</option><option value="Yemen">967</option><option value="Zambia">260</option><option value="Zimbabwe">263</option></select>
            </div>

           
		   
          </div>
		  
		  <div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding:0">
							<div class="form-group">
		    <input type="tel" size="3" id="code" value='1' name="phone" readonly style='width:22%;background-color:gainsboro'>-(<input type="tel" size="3" name='phone1' id='phone1' style='width:60%' required value="<?php if(isset($_SESSION['credit_form_data']['phone1'])):echo $_SESSION['credit_form_data']['phone1'];endif;?>">) 
          
			 </div>
			 </div>
			 </div>
		  
<div class="row">
						<div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group">
              <!--<label for="date">City</label>-->
              <input type="text"  required id="city" name="city" placeholder="City" class="warning" value="<?php if(isset($credit_data[0]->city)):echo $credit_data[0]->city;elseif(isset($_SESSION['credit_form_data']['city'])):echo $_SESSION['credit_form_data']['city'];endif;?>">
            </div>
            </div>
			
       
        <div class="pull-left col-xs-12 col-sm-12 col-md-6 col-lg-6" >
							<div class="form-group">
              <!--<label for="date">State</label>-->
              <input type="text" required id="state" style='width:50%' name="state" placeholder="State" class="warning" value="<?php if(isset($credit_data[0]->state)):echo $credit_data[0]->state;elseif(isset($_SESSION['credit_form_data']['state'])):echo $_SESSION['credit_form_data']['state'];endif;?>">
			  
              <input type="text" required id="zip_code" style='width:48%' name="zip_code" placeholder="Zip code" class="warning"  value="<?php if(isset($credit_data[0]->zipcode)):echo $credit_data[0]->zipcode;elseif(isset($_SESSION['credit_form_data']['zip_code'])):echo $_SESSION['credit_form_data']['zip_code'];endif;?>">
            </div>
            </div>
			
			
        </div>
		
		 
		 <div class="panel-footer" style="background:none">
      <button class="btn next-btn" type="submit" value='1' id='pronoor_pay_submit' name='pronoor_pay_submit'>Submit</button> <a href='javascript:void(0);' class="" data-toggle="modal" data-target="#myModal" style='width: 100%;
    /* display: inline-block; */
    /* vertical-align: middle; */
    text-align: left;
    padding-left: 20px;'>RETURN AND REFUND POLICY</a>
    </div>
    </div>
	</form>

   
  </div></center>
<input type='hidden' id='valid' />
<input type='hidden' id='length' />
<input type='hidden' id='luhn' />
  <script src="https://paydada.com/mail/js/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="<?php print $base_path ; ?>Document_files/jquery.creditCardValidator.js"></script>
  <script src="<?php print $base_path . $path_to_resbartik; ?>Document_files/script.js.download"></script>
<script>
$(function() {
$('.country').on('change', function() {
			$('.country_code').val($(this).val());
			country_code=($('.country_code option:selected').text());
			$('#code').attr('value',country_code);
			
      });
	  
	  $('#pronoor_pay_submit').on('click', function() {
			valid=$('#valid').val();
			id=$('.anchor_add_credit').attr('id');
			length=$('#length').val();
			luhn=$('#luhn').val();
			if((valid=='false' || length=='false' || luhn=='false') && (id=='remove_credit')){
				alert('Please enter valid credit card');
				return false;
			}
			
      }); 
	  
	  <?php if($credit_condition==0):?>
	  	$('#cardnumber').validateCreditCard(function(result) {
            $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name));
			$('#valid').val(result.valid);
			$('#length').val(result.length_valid);
			$('#luhn').val(result.luhn_valid);
        });
		<?php endif;?>
	$(document).on('click', '#add_credit', function(){
		    $(this).text('X');
			
		    $(this).attr('id','remove_credit');
			$('.add_credit').append('<input type="text" name="card_number" placeholder="Card number" id="cardnumber" class="warning"> <p class="log"></p>');
			$('#cardnumber').validateCreditCard(function(result) {
            $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name));
			$('#valid').val(result.valid);
			$('#length').val(result.length_valid);
			$('#luhn').val(result.luhn_valid);
			$('#date').val('');
			$('#cardholder').val('');
			$('#country').val('');
			$('#city').val('');
			$('#state').val('');
			$('#zip_code').val('');
			$('#code').val('');
			$('#phone1').val('');
			$('#phone2').val('');
			$('#phone3').val('');
        });
      });
	  
	 
$(document).on('click', '#remove_credit', function(){
		  $(this).text('+');
		  $('.log').remove();
		    $(this).attr('id','add_credit');
		  $('#cardnumber').remove();
	  });
	  
	 
      });
	  (function ($) {
  Drupal.behaviors.ajax_example = {
    attach:function (context) {
 
      // If the site name is present set it to the username.
      $(document).on('change', '#card_number_select', function(){
		  val=$(this).val();
        $.ajax({
          url: 'ajax/credit/'+val,
		  type:'POST',
          success: function(data) {
 
			$('#date').val(data.exp_date);
			$('#cardholder').val(data.card_holder);
			$('#country').val(data.country).trigger('change');
			$('#city').val(data.city);
			$('#state').val(data.state);
			$('#zip_code').val(data.zip_code);
			$('#code').val(data.phone1);
			$('#phone1').val(data.phone2);
			$('#phone2').val(data.phone3);
			$('#phone3').val(data.phone4);
            // Change site name to current user name.
            $('#site-name a span').html(data + '.com');
         }
        });
      });
    }
  }
})(jQuery);
	   
	  </script>
				
			</div>
       
		    </div>
			
               <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0">
	<nav class="navbar" style="border-radius:0px">
    <div class="container center">
        <ul class="nav footer_menu">
          <!--<li class="navbar-text"><a href="index.php">Directory Home</a></li>
            <li class="navbar-text"><a href="index.php?page=6&type=15">Secure Mail</a></li>-->
                        <li class="navbar-text"><a href="https://paydada.com/index.php?page=6&amp;type=2">Contact Us</a></li>
			            <li class="navbar-text"><a href="https://paydada.com/index.php?page=6&amp;type=22">Terms &amp; Conditions</a></li>
			            <li class="navbar-text"><a href="https://paydada.com/index.php?page=6&amp;type=23">Privacy Policy</a></li>
			           
			            <li class="navbar-text"><a href="https://paydada.com/index.php?page=6&amp;type=32">About PWS</a></li>
			  
        </ul>
    </div>

    <div class="center footer_down">
        <p style="color:white">© 2014-18 Paydada Directory, Email &amp; Shopping Cart. All Rights Reserved. Paydada and MedNoor are Registered Trade Marks </p>
    </div>
</nav>
</div>
		    </div>
			
              
            </div></center>
            <!-- /.row -->
          
        </div> 
</div>
            </div></center>
            <!-- /.row -->
          
        </div> 
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Return and Refund Policy</h3>
        </div>
        <div class="modal-body">
          <div class="mar">

        <p>Any porduct or service purchased through <a href="http://www.paydada.com">www.paydada.com</a> shopping cart is returnable or can be cancelled at any time during the service period. The refund is provided to the credit card charged at the time of transaction. Following are the rules for refund:<br><br>A: Total refund if caneclled and claimed within 30 days of the transaction, for any reason<br>B: Service or services cancelled after the first month will be refunded based on the prorated use including the first month provided that the refund is requested five buisness days before the billing cycle. <br>C: There is no refund for any software, shipped to you after the package is opened or the seal is broken of any such product.<br>D: Currently there is no product that has a shipping fee; However, if there is a shipping fee involved in future it will not be refunded.<br>E: Any service can be upgraded or down graded at any time without penalty. However, the change in cost will be effective from next billing cycle.<br>F: Any product can be excahnged within ninty days from the date of transaction.<br>G:Technical services and support not related to the items sold will be charged seperately according to the pre disclosed rate. Such a service is not available at this time.</p>
<p>&nbsp;</p>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


      		
<!--<script src="/bower_components/jquery/dist/jquery.min.js"></script>-->

		 <script>
  $(function() {
    jQuery( "#datepicker" ).datepicker({
	dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
	});
  });
  </script>
<script src="https://paydada.com/mail/js/jquery.validate.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://paydada.com/mail/bower_components/bootstrap/dist/js/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="https://paydada.com/mail/bower_components/metisMenu/dist/metisMenu.min.js"></script>

		  <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script src="https://paydada.com/mail/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
				"lengthMenu": [[ 25, 50, -1], [ 25, 50, "All"]]
        });
		 var oTable = $('#dataTables-example').dataTable();
		 $('.total_categories').html(oTable.fnGetData().length);
		 
		  $('#dataTables-example_my_mails').DataTable({
                responsive: true,
				 "lengthMenu": [[ 25, 50, -1], [ 25, 50, "All"]],
				"columnDefs": [ { "targets": 0, "orderable": false } ]
        });
		 var oTable = $('#dataTables-example_my_mails').dataTable();
    });
    </script>
	

    <!-- Morris Charts JavaScript -->
    <!--<script src="https://paydada.com/mail/bower_components/raphael/raphael-min.js"></script>
    <script src="https://paydada.com/mail/bower_components/morrisjs/morris.min.js"></script>
    <script src="https://paydada.com/mail/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="https://paydada.com/mail/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
    function printdiv(printpage){
    var headstr = "<html><head><title></title></head><body>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
}
</script>
<style>#admin-menu{display:none}body{display:block;margin-top:0px !important}</style>