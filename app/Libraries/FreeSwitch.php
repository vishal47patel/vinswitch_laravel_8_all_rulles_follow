<?php

namespace App\Libraries;

use App\Models\SipAccount;
use Exception;
use Illuminate\Support\Facades\Auth;
use SocketConnection;

class FreeSwitch
{
    public static function checkExtStatus() 
	{
        if (Auth::check() && Auth::user()->role == 'ADMIN') {
            // return Auth::user()->role;
			$extension = SipAccount::all();
        }else{
			$extension = SipAccount::where('account_number', Auth::user()->accountNumber)->get();
		}		
		$arr = array();

		$freeswitchService='freeswitch';
		if(shell_exec("ps -ef | grep -v grep | grep $freeswitchService | wc -l") > 0 )
		{	

			try{

				$command = "/usr/local/freeswitch/bin/fs_cli -x 'sofia status profile internal reg' | grep 'Auth-User:' | awk '{print $2}'";
				$result = shell_exec($command);

				$result_array = explode("\n",trim($result));

				foreach($extension as $ext)
				{
					if(in_array($ext->username, $result_array))
					{
						$res = self::checkExtBusyStatus($ext->username);

						if($res == 1)
						{
							$arr[$ext->username]['status'] = 2;
						}
						else
						{
							$arr[$ext->username]['status'] = 1;
						}
					}
					else
					{
						$arr[$ext->username]['status'] = 0;
					}			
				}

				return $arr;
			}catch (Exception $e){
				foreach($extension as $ext)
				{
					$arr[$ext->username]['status'] = 0;
				}
				return $arr;
			}
		}else{
			foreach($extension as $ext)
			{
				$arr[$ext->username]['status'] = 0;
			}
			return $arr;
		}
	} 


	public static function checkExtBusyStatus($ext) 
	{
		try{

			$command = "/usr/local/freeswitch/bin/fs_cli -x 'show calls' | grep $ext@ | awk '{print NR}'";
			$result = shell_exec($command);

			if($result != 1) {
				$ext_command = "/usr/local/freeswitch/bin/fs_cli -x 'show calls' | grep $ext, | awk '{print NR}'";
				$result = shell_exec($ext_command);

			}
		}catch(Exception $e){
			$result = 0;
		}

		return $result;	
	}



	public function aclNodeCommand()
	{
		$freeswitchService='freeswitch';
		if(shell_exec("ps -ef | grep -v grep | grep $freeswitchService | wc -l") > 0 )
		{
			try {
				$command = "/usr/local/freeswitch/bin/fs_cli -rx 'reloadacl'";
				$result = shell_exec($command);
				return true;
			}catch (Exception $e) {
				return false;
			}
		}else{
			return true;
		}	
		
	}

	public function gatewayCommand($register,$name)
	{
		$freeswitchService='freeswitch';
		if(shell_exec("ps -ef | grep -v grep | grep $freeswitchService | wc -l") > 0 )
		{

			try {

				if (!empty($register)) {
					if ($register == TRUE) {
						
						$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external register $name'";
						$result = shell_exec($command);
					}
					else if ($register == FALSE) {
						
						$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external unregister $name'";
						$result = shell_exec($command);
					}					
				}

				$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external rescan'";
				$result = shell_exec($command);
				
				return true;
			}catch (Exception $e) {
				return false;
			}
		}else{
			return true;
		}
	}


	public function EditgatewayCommand($register,$name)
	{
		$freeswitchService='freeswitch';
		if(shell_exec("ps -ef | grep -v grep | grep $freeswitchService | wc -l") > 0 )
		{

			try {

				$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external killgw $name'";
				$result = shell_exec($command);

				if (!empty($register)) {
					if ($register == TRUE) {
										
						$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external register $name'";
						$result = shell_exec($command);
					}
					else if ($register == FALSE) {
						
						$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external unregister $name'";
						$result = shell_exec($command);
					}
					
				}

				$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external rescan'";
				$result = shell_exec($command);
				
				return true;
			}catch (Exception $e) {
				return false;
			}
		}else{
			return true;
		}	
	}


	public function deletegatewayCommand($name)
	{
		$freeswitchService='freeswitch';
		if(shell_exec("ps -ef | grep -v grep | grep $freeswitchService | wc -l") > 0 )
		{

			try {

				$command = "/usr/local/freeswitch/bin/fs_cli -rx 'sofia profile external killgw $name'";
				$result = shell_exec($command);

				return true;
			}catch (Exception $e) {
				return false;
			}
		}else{
			return true;
		}	
		
	}

	public function activecallCounts()
	{
		$switch_cmd = "api show calls as json";
        $fp = SocketConnection::_event_socket_create();
        if ($fp) {
        	$json = SocketConnection::_event_socket_request($fp, $switch_cmd);
        	$result = json_decode($json, "true");

        	$inbound_count = array();
        	$outbound_count = array();

        	if ($result['row_count'] > 0) {

        		$inbound_count = array_map(function ($data){
        			if ($data['b_direction'] == 'inbound') {
        				return $data;
        			}

        		}, $result['rows']);

        		$inbound_count = array_map(function ($data){
        			if ($data['b_direction'] == 'outbound') {
        				return $data;
        			}

        		}, $result['rows']);
        		
        	}

        	//return $result['row_count'];

        	return array('inbound_count'=>count(array_filter($inbound_count)),'outbound_count'=>count(array_filter($outbound_count)));
        }else{
        	return 0;
        }       
		
	}

	public function GetFreeswitchVersion()
	{
		$switch_cmd = "api version";
        $fp = SocketConnection::_event_socket_create();
        if ($fp) {
        	$switch_version = SocketConnection::_event_socket_request($fp, $switch_cmd);
        	preg_match("/FreeSWITCH Version (\d+\.\d+\.\d+(?:\.\d+)?).*\(.*?(\d+\w+)\s*\)/", $switch_version, $matches);
            $switch_version = $matches[1];
            $switch_bits = $matches[2];

        	return $switch_version."(".$switch_bits.")";
        }else{
        	return false;
        }       
		
	}

}