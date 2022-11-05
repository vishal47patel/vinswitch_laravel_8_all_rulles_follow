<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SofiaGateway extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'sofia_id',
        'gateway_name',
        'gateway_param',
        'gateway_value',
        'gateway_id',
    ];

    public function addSofiaGateway($data,$id){
        $username = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'username')->first();
		if (empty($username)) {
			$username =new SofiaGateway();
			$username->gateway_name = $data['gateway_name'];	
		}
        $username->sofia_id = 2;
		$username->gateway_id = $id;
        $username->gateway_param = 'username';
		$username->gateway_value = $data['username'];
		$username->save();

        $password = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'password')->first();
		if (empty($password)) {
			$password =new SofiaGateway();
			$password->gateway_name = $data['gateway_name'];	
		}
        $password->sofia_id = 2;
		$password->gateway_id = $id;
        $password->gateway_param = 'password';
		$password->gateway_value = $data['password'];
		$password->save();

        $auth_username = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'auth_username')->first();
		if (empty($auth_username)) {
			$auth_username =new SofiaGateway();
			$auth_username->gateway_name = $data['gateway_name'];	
		}
        $auth_username->sofia_id = 2;
		$auth_username->gateway_id = $id;
        $auth_username->gateway_param = 'auth_username';
		$auth_username->gateway_value = $data['auth_username'];
		$auth_username->save();

        $realm = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'realm')->first();
		if (empty($realm)) {
			$realm =new SofiaGateway();
			$realm->gateway_name = $data['gateway_name'];	
		}
        $realm->sofia_id = 2;
		$realm->gateway_id = $id;
        $realm->gateway_param = 'realm';
		$realm->gateway_value = $data['realm'];
		$realm->save();

        $from_user = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'from_user')->first();
		if (empty($from_user)) {
			$from_user =new SofiaGateway();
			$from_user->gateway_name = $data['gateway_name'];	
		}
        $from_user->sofia_id = 2;
		$from_user->gateway_id = $id;
        $from_user->gateway_param = 'from_user';
		$from_user->gateway_value = $data['from_user'];
		$from_user->save();

        $from_domain = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'from_domain')->first();
		if (empty($from_domain)) {
			$from_domain =new SofiaGateway();
			$from_domain->gateway_name = $data['gateway_name'];	
		}
        $from_domain->sofia_id = 2;
		$from_domain->gateway_id = $id;
        $from_domain->gateway_param = 'from_domain';
		$from_domain->gateway_value = $data['from_domain'];
		$from_domain->save();

        $proxy = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'proxy')->first();
		if (empty($proxy)) {
			$proxy =new SofiaGateway();
			$proxy->gateway_name = $data['gateway_name'];	
		}
        $proxy->sofia_id = 2;
		$proxy->gateway_id = $id;
        $proxy->gateway_param = 'proxy';
		$proxy->gateway_value = $data['proxy'];
		$proxy->save();

        $register_proxy = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'register_proxy')->first();
		if (empty($register_proxy)) {
			$register_proxy =new SofiaGateway();
			$register_proxy->gateway_name = $data['gateway_name'];	
		}
        $register_proxy->sofia_id = 2;
		$register_proxy->gateway_id = $id;
        $register_proxy->gateway_param = 'register_proxy';
		$register_proxy->gateway_value = $data['register_proxy'];
		$register_proxy->save();

        $outbound_proxy = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'outbound_proxy')->first();
		if (empty($outbound_proxy)) {
			$outbound_proxy =new SofiaGateway();
			$outbound_proxy->gateway_name = $data['gateway_name'];	
		}
        $outbound_proxy->sofia_id = 2;
		$outbound_proxy->gateway_id = $id;
        $outbound_proxy->gateway_param = 'outbound_proxy';
		$outbound_proxy->gateway_value = $data['outbound_proxy'];
		$outbound_proxy->save();

        $expire_seconds = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'expire_seconds')->first();
		if (empty($expire_seconds)) {
			$expire_seconds =new SofiaGateway();
			$expire_seconds->gateway_name = $data['gateway_name'];	
		}
        $expire_seconds->sofia_id = 2;
		$expire_seconds->gateway_id = $id;
        $expire_seconds->gateway_param = 'expire_seconds';
		$expire_seconds->gateway_value = $data['expire_seconds'];
		$expire_seconds->save();

        $register = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'register')->first();
		if (empty($register)) {
			$register =new SofiaGateway();
			$register->gateway_name = $data['gateway_name'];	
		}
        $register->sofia_id = 2;
		$register->gateway_id = $id;
        $register->gateway_param = 'register';
		$register->gateway_value = $data['register'];
		$register->save();

        $retry_seconds = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'retry_seconds')->first();
		if (empty($retry_seconds)) {
			$retry_seconds =new SofiaGateway();
			$retry_seconds->gateway_name = $data['gateway_name'];	
		}
        $retry_seconds->sofia_id = 2;
		$retry_seconds->gateway_id = $id;
        $retry_seconds->gateway_param = 'retry_seconds';
		$retry_seconds->gateway_value = $data['retry_seconds'];
		$retry_seconds->save();

        $ping = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'ping')->first();
		if (empty($ping)) {
			$ping =new SofiaGateway();
			$ping->gateway_name = $data['gateway_name'];	
		}
        $ping->sofia_id = 2;
		$ping->gateway_id = $id;
        $ping->gateway_param = 'ping';
		$ping->gateway_value = $data['ping'];
		$ping->save();

        $caller_id_in_from = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'caller-id-in-from')->first();
		if (empty($caller_id_in_from)) {
			$caller_id_in_from =new SofiaGateway();
			$caller_id_in_from->gateway_name = $data['gateway_name'];	
		}
        $caller_id_in_from->sofia_id = 2;
		$caller_id_in_from->gateway_id = $id;
        $caller_id_in_from->gateway_param = 'caller-id-in-from';
		$caller_id_in_from->gateway_value = $data['caller_id_in_from'];
		$caller_id_in_from->save();

        $channels = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'channels')->first();
		if (empty($channels)) {
			$channels =new SofiaGateway();
			$channels->gateway_name = $data['gateway_name'];	
		}
        $channels->sofia_id = 2;
		$channels->gateway_id = $id;
        $channels->gateway_param = 'channels';
		$channels->gateway_value = $data['channels'];
		$channels->save();

        $hostname = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'hostname')->first();
		if (empty($hostname)) {
			$hostname =new SofiaGateway();
			$hostname->gateway_name = $data['gateway_name'];	
		}
        $hostname->sofia_id = 2;
		$hostname->gateway_id = $id;
        $hostname->gateway_param = 'hostname';
		$hostname->gateway_value = $data['hostname'];
		$hostname->save();

        $outbound_default = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'outbound_default')->first();
		if (empty($outbound_default)) {
			$outbound_default =new SofiaGateway();
			$outbound_default->gateway_name = $data['gateway_name'];	
		}
        $outbound_default->sofia_id = 2;
		$outbound_default->gateway_id = $id;
        $outbound_default->gateway_param = 'outbound_default';
		$outbound_default->gateway_value = $data['outbound_default'];
		$outbound_default->save();

        $prefix = SofiaGateway::where('gateway_id', $id)->where('gateway_param', 'prefix')->first();
		if (empty($prefix)) {
			$prefix =new SofiaGateway();
			$prefix->gateway_name = $data['gateway_name'];	
		}
        $prefix->sofia_id = 2;
		$prefix->gateway_id = $id;
        $prefix->gateway_param = 'prefix';
		$prefix->gateway_value = $data['prefix'];
		$prefix->save();

        return true;
    }
}
