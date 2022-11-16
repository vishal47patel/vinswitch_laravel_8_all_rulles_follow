<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Registrations;
use App\Libraries\SocketConnection;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Array_order;

class RegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('registrations.index');
    }

    public function registration()
    {
        $profile = '';
        $search = '';
        $obj = new Registrations;
       // $obj->db = $this->db;
       $registrations = $obj->get($profile);
       //count the registrations
        $registration_count = 0;
        if (isset($registrations) && is_array($registrations)) {
            foreach ($registrations as $row) {
                    $registration_count++;
            }
        }

        $order = new Array_order();
       
        $registrations = $order->sort($registrations, 'sip-auth-realm', 'user');
        if(!Auth::user()->isAdmin){
        $accountNumber = Auth::user()->accountNumber;
        }
        $rows = array();
        if (isset($registrations)) {
    
            foreach ($registrations as &$row) {
                
                $user = substr($row['user'], 0, 3);
              
                //add the row to the array
                    if(!Auth::user()->isAdmin){
                        
                    if ($user == $accountNumber) {
    
                        $rows[] = $row;
                    }
                    else {
                    }
                }else{
                    $rows[] = $row;
                }
            }
          
            unset($results);
        }
        $onhover_pause_refresh = " onmouseover='refresh_stop();' onmouseout='refresh_start();'";
        $c = 0;
        $row_style["0"] = "row_style0";
        $row_style["1"] = "row_style1";
      //show content
        $table = "";          
        $activecallc =  "<b>Registrations (" . count($rows) . ")"."</b>";
        $table .=  "<br>\n";
        //show the results
        $table .=  "<div id='cmd_reponse'></div>\n";

        $table .=  "<table class='table table-striped table-bordered dataTable text-nowrap table-primary mb-1' height:100px;' width='100%'  border='0' cellpadding='0' cellspacing='0'>\n";
        $table .=  "<thead>\n";
        $table .=  "<tr>\n";
        $table .=  "<th class='text-blue'>User</th>\n";
        $table .=  "<th class='text-blue'>Agent</th>\n";
        
        $table .=  "<th class='text-blue'>Contact</th>\n";
        $table .=  "<th class='text-blue'>LAN IP</th>\n";
        $table .=  "<th class='text-blue'>IP</th>\n";
        $table .=  "<th class='text-blue'>Port</th>\n";
        $table .=  "<th class='text-blue'>Hostname</th>\n";
        $table .=  "<th class='text-blue'>Status</th>\n";
        $table .=  "<th class='text-blue'>Ping</th>\n";
        $table .=  "<th class='text-blue'>Profile</th>\n";
        $table .=  "<td class='list_control_icon'></td>\n";
        $table .=  "</tr>\n";
        $table .=  "</thead>\n";    
        
        foreach ($rows as &$row) {

         foreach ($row as $key => $value) {

             $key = str_replace("-","_",$key);
             $$key = $value;
             }

        $contact1 = explode('"',$contact);
        $contact2 = explode('<',$contact1[2]);
        $contact3 = explode(':',$contact2[1]);
        $contact4 = explode('@',$contact3[1]);

         $unregister = "unregister" ;

         $table .=  "<tr >\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$user."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$agent."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$contact4[0]."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$lan_ip."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$network_ip."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$network_port."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$host."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$status."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$ping_time."&nbsp;</td>\n";
         $table .=  "<td valign='top' class='".$row_style[$c]."'>".$sip_profile_name."&nbsp;</td>\n"; 
         
          $table .=  "<td class='list_control_icons'> <button type='button' class='btn btn-primary btn-sm' onclick = \"unregister('".$unregister ."','". $user."','".$agent."','".$sip_profile_name."')\">Unregister</button><a href='javascript:void(0);'\"></a></td>\n";
         $table .=  "</tr>\n";
     
     //alternate the row style
                $c = ($c) ? 0 : 1;
        }
        $table .=  "</td>\n";
        $table .=  "</tr>\n";
        $table .=  "</table>\n";
        $data = ['table' => $table,'activecallc' => $activecallc];
        echo json_encode($data);
    }

    public function unregister()
    {   
        
        $user = $_GET['user'];
        $sip_profile_name = $_GET['sip_profile_name'];  
        $command = "api sofia profile ".$sip_profile_name." flush_inbound_reg ".$user." reboot";
        $fp = SocketConnection::_event_socket_create();
        $response = SocketConnection::_event_socket_request($fp, $command);
    }  
}
