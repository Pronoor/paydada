<?php
//error_reporting(E_ALL);
global $user;
 $softral_database  = array(
			  'database' => 'ebinti_emailnew',
			  'username' => 'ebinti_shopping_cart', // assuming this is necessary
			  'password' => 'BkffRt9987k', // assuming this is necessary
			  'host' => 'localhost', // assumes localhost
			  'port' => '3306', // assumes localhost
			  'driver' => 'mysql', // replace with your database driver
		  );

Database::addConnectionInfo('softral', 'default', $softral_database);
db_set_active('softral');

  $softral_data = db_select('credit_cards', 'n')
        ->fields('n')
        ->condition('email', $user->mail, '=')
        ->execute()
        ->fetchAll();

		db_set_active();
		?>
		<div id="page-wrapper"><div id="page">
		 <div id="main-wrapper" class="clearfix"><div id="main" role="main" class="clearfix">


    <div id="" class="column"><div class="section">
	   <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
		<section class="panel transcation_dt">
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<table class="vertical">
                    	<tbody>
							<th>Transaction no</th>
							<th>Amount</th>
							<th>Country</th>
							<th>City</th>
							<th>State</th>
							<th>Zip code</th>
							<th>Date</th>
							
                        </tbody>
						
					<?php foreach($softral_data as $transaction):?>
                        <tr>
							<td>#<?php echo $transaction->tran_no;?></td>
							<td><?php echo $transaction->amount;?></td>
							<td><?php echo $transaction->country;?></td>
							<td><?php echo $transaction->city;?></td>
							<td><?php echo $transaction->state;?></td>
							<td><?php echo $transaction->zip_code;?></td>
							<td><?php echo $transaction->date;?></td>
                        </tr>
					<?php endforeach;?>
                        <?php if(count($softral_data)==0):?>
		   <tr>
                       <td colspan="5" style='text-align: center;'>
					Sorry, No Transactions found.
				 </td>
			 </tr>
	   <?php endif;?>
                    </table>
                </div>
               
            </div>
        </section> 
		</div>
		</div>
		</div>
		</div>
		</div>