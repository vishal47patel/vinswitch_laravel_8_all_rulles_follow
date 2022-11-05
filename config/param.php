<?php

use Illuminate\Support\Str;

return [

    'git_branch'=>'master',
	'web_url' => 'http://192.168.1.72/',
	'adminEmail'=>'vishal@vindaloosofttech.com',
	'linkExpireTime'=>'86400',
	'refresh_time'=>'5000',
	
	'vitelity'=> [
		'username' => 'paresh',
		'password' => 'paresh',
    ],

	'did'=> [
		'routesip' => '192.168.1.72',
		'type' => 'perminute',
    ],

	'vmPassword'=>'861000',
	
	'duedateInterval'=>'+15 days',
	'invoiceGenerateTime'=>'02:00:01',

	'logo'=>'https://192.168.1.72/images/logo.png',

	'fromAddress'=> [
		'address'=>'66 West Flagler Street',
		'city'=>'Suite 900',
		'state'=>'Miami',
		'country'=>'FL',
		'zip'=>'33130',
		'contact' =>'(702) 200-8967',
		'email' =>'billing@xyz.com',
    ],
	
	'paypal'=> [
		'fees' => '3.5',
		'url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
		'email' => 'sb-ct7fm6104913@business.example.com',
		'api_version' => '85.0',
		'paypal_endpoint' => 'https://api-3t.sandbox.paypal.com/nvp',
		'paypal_username' => 'sb-ct7fm6104913_api1.business.example.com',
		'paypal_password' => 'XXSLRHMH8NP99PT5',
		'paypal_signature' => 'AqKg005KvkMCrP11Y4hYn7PtzKWxABeLnUI24j3iSphsydMG7crhG30o',
		'express_checkout_url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout',
    ],
	
	'sms_length' => 160,
	
	'smsApi'=>[
		'token' => '71821bdd96e76b2f3cfd772458c1391cc626c483',
		'url' => 'https://api.thinq.com/account/14428/product/origination/sms/send',
		'username' => 'jentel',
    ],
		
	'sms_notification_from_did' => 9979940220,
	'pcap_file_delete_after_days' => 15,
	'notificationUrl' => 'http://64.251.31.224:8001',
	'min_payment_amount' => 10.00,//25.00,
	'portal_shortlink' => 'http://192.168.1.72/site/login',
	
	'thinq'=> [
		'vendor_id' => 2, //get from database vendor table 
		'sms_routing_id' => 4161, //get from thinq portal
    ],

	'SocketConnection' => [
       'host' => '127.0.0.1',
       'password' => 'ClueCon',
       'port' => '8021',
    ],	

   	'OsTicket' => [
       'api_url' => 'http://support.responsiveip.com/script/api_user_create.php',
       'change_password_api_url' => 'http://support.responsiveip.com/script/api_change_password.php',
       'admin_support_url' => 'http://support.responsiveip.com/scp/login.php',
       'user_support_url' => 'http://support.responsiveip.com/login.php',
       'auto_login_api_url' => 'http://support.responsiveip.com/script/api_login.php',
	
    ],	
	'defaultPageSize' => 10,
	'pageSizeOptions' => array(10 => 10, 20 => 20, 50 => 50, 100 => 100, 500 => 500),
	//'taxation_API_key' =>'T3$t_F2y79ovR8Wc65yY:',//testing key
	//'taxation_API_key' =>'F2y79ovR8Wc65yY:',
	'taxation_csv' =>'/var/www/html/vinswitch/csv/',
	'taxtion_cc_engine_mail' => 'pratik@vindaloosofttech.com',
	//'taxtion_engine_mail' => 'revenue@csilongwood.com',
	//'taxtion_engine_mail' => 'pooja@vindaloosofttech.com'//testing mail

	'stripe'=> [
		'fees' => '1.75',
		'publishable_key' => 'pk_test_VU4Vjunqt3SbfUYCeHBcTzuV',
		'secret_key' => 'sk_test_ea6zEbb9f4spqURrM08OiRyN',
    ],

];
