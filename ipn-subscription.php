<?php
/*
ipn.php - example code used for the tutorial:

PayPal IPN with PHP
How To Implement an Instant Payment Notification listener script in PHP
http://www.micahcarrick.com/paypal-ipn-with-php.html

(c) 2011 - Micah Carrick
*/

// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors_subscription.log');

// intantiate the IPN listener
include('ipnlistener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = false;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

if ($verified) {

    $errmsg = '';   // stores errors from fraud checks
    
    // 1. Make sure the payment status is "Completed" 
    if ($_POST['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        exit(0); 
    }

    // 2. Make sure seller email matches your primary account email.
    if ($_POST['receiver_email'] != 'ikpress.finance@gmail.com') {
        $errmsg .= "'receiver_email' does not match: ";
        $errmsg .= $_POST['receiver_email']."\n";
    }
/////////////////establish db Connection	
			$conn = mysql_connect('localhost', 'ikpress_ci', '1xWL5F)omX4t');
			
			if(!$conn)
			{
				error_log("db connection error"); 
				exit(0);		
			}
			$sell = mysql_select_db('ikpress_ci');
			
			
			if(!$sell)
			{
				error_log("db selection error"); 
				exit(0);		
			}		
/////////////////establish db Connection ends			

		
        	$custom 		= mysql_real_escape_string($_POST['custom']);		
		
/*			$custom = explode("**",$custom);
			
			$article_id	= $custom[0];
			$file_name	= $custom[1];
			$hours	= $custom[2];
			$id	= $custom[3];
			$link	= $custom[4];	*/		
			
			$sel_sql = "SELECT * FROM `subscriptions` WHERE 1 AND `order_id` = '$custom'";
			$sel_rs	= mysql_query($sel_sql);
			$sel_result = mysql_fetch_assoc($sel_rs);
			
			
			error_log($sel_sql); 
    
    // 3. Make sure the amount(s) paid match
    if ($_POST['mc_gross'] != $sel_result['mc_gross']) {
        $errmsg .= "'mc_gross' does not match: ";
        $errmsg .= $_POST['mc_gross']."\n";
    }
    
    // 4. Make sure the currency code matches
    if ($_POST['mc_currency'] != 'USD') {
        $errmsg .= "'mc_currency' does not match: ";
        $errmsg .= $_POST['mc_currency']."\n";
    }
/*	
    if ($hours != $sel_result['validity_hours']) {
        $errmsg .= "'validity_hours' does not match: ";
        $errmsg .= $hours."\n";
    }	
	
    if ($file_name != $sel_result['file_name']) {
        $errmsg .= "'file_name' does not match: ";
        $errmsg .= $file_name."\n";
    }		*/

    // 5. Ensure the transaction is not a duplicate.


    $txn_id = mysql_real_escape_string($_POST['txn_id']);
    $sql = "SELECT COUNT(*) FROM subscriptions WHERE txn_id = '$txn_id'";
    $r = mysql_query($sql);
    
    if (!$r) {
        error_log(mysql_error());
        exit(0);
    }
    
    $exists = mysql_result($r, 0);
    mysql_free_result($r);
    
    if ($exists) {
        $errmsg .= "'txn_id' has already been processed: ".$_POST['txn_id']."\n";
    }
    
    if (!empty($errmsg)) {

        // manually investigate errors from the fraud checking
        $body = "IPN failed fraud checks: \n$errmsg\n\n";
        $body .= $listener->getTextReport();
        mail('manishdak@hotmail.com', 'IPN Fraud Warning', $body);
        
    } else {
		
    
        // add this order to a table of completed orders
        $payer_email 	= mysql_real_escape_string($_POST['payer_email']);
		
        
$sql = "UPDATE  `subscriptions` SET 
`txn_id` = '$txn_id',
`payer_email` = '$payer_email',
`update_date` = now()
WHERE `order_id` = '$id'";
        
        if (!mysql_query($sql)) {
            error_log(mysql_error());
            exit(0);
        }

        // send user an email with a link to their digital download
       // $to = filter_var($_POST['payer_email'], FILTER_SANITIZE_EMAIL);

$s = '<HTML>
 <HEAD>
  <TITLE> International Knowledge Press - Subscription Order Confirmation</TITLE>
 </HEAD>
 <BODY>
  <P>Dear customer,</P>

<P>Thanks for your order and payment. </P>

<P>If you find any difficulty to download the paper, please reach us here: <A HREF="mailto:contact@ikpress.org">contact@ikpress.org</A></P>

<P>We\'ll be happy to help you.<BR />
If you require any assistance, please feel free to contact us. Our sales team will be at your disposal.</P>

<P>Thank you again for your valuable order.</P>

<p><STRONG>Sales Team</STRONG><BR />
International Knowledge Press</P>

<p>EUROPE<BR />
International Knowledge Press<BR />
S107, 3 Hardman Square,<BR />
Spinningfields, Manchester, M3 3EB, UK<BR />
Fax: +44 (0)161 667 4459<BR />
Email: <A HREF="mailto:contact@ikpress.org">contact@ikpress.org</A></P>

<p>ASIA PACIFIC<BR />
International Knowledge Press<BR />
N. S. Road, Tarakeswar, Hooghly, PIN-712410<BR />
West Bengal, India<BR />
Email: <A HREF="mailto:contact@ikpress.org">contact@ikpress.or</A></P>
 </BODY>
</HTML>

';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: IKP Admin <admin@ikpress.org>' . "\r\n";
$headers .= 'Reply-To: IKP Admin <admin@ikpress.org>' . "\r\n";

			mail($payer_email,"Order for Link - www.ikpress.org",$s,$headers,'-fadmin@ikpress.org');
			mail("contact.ikpress@gmail.com","Copy of Order for Link - www.ikpress.org",$s,$headers,'-fadmin@ikpress.org');			



    }
    
} else {
    // manually investigate the invalid IPN
    mail('manishdak@hotmail.com', 'Invalid IPN', $listener->getTextReport());
}
	
?>
