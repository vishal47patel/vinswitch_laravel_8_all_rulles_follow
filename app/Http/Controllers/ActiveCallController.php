<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\SocketConnection;

class ActiveCallController extends Controller
{
    public function index()
    {
        return view('cdr.activecall');
    }

    public function getActiveCall() {

    	$show = 'all';

		$switch_cmd = "api show channels as json";

		$fp = SocketConnection::_event_socket_create();

        $json = SocketConnection::_event_socket_request($fp, $switch_cmd);

        $results = json_decode($json, "true");

	    $rows = array();
        if (isset($results["rows"])) {
            foreach ($results["rows"] as &$row) {
                
                $cid_num = substr($row['cid_num'], 0, 3);
                $callee_num = substr($row['callee_num'], 0, 3);

                //get the domain
                if (strlen($row['context']) > 0 and $row['context'] != "public") {
                    if (substr_count($row['context'], '@') > 0) {
                        $context_array = explode('@', $row['context']);
                        $row['domain_name'] = $context_array[1];
                    }
                    else {
                        $row['domain_name'] = $row['context'];
                    }
                }
                else if (substr_count($row['presence_id'], '@') > 0) {
                    $presence_id_array = explode('@', $row['presence_id']);
                    $row['domain_name'] = $presence_id_array[1].' '.__line__.' '.$row['presence_id'];
                }
                $rows[] = $row;
            }
            unset($results);
        }

        $v_link_label_delete = "<i class='fa fa-ban fa-1x text-bold' style='color:red'></i>";

        //set the alternating color for each row
        $c = 0;
        $row_style["0"] = "row_style0";
        $row_style["1"] = "row_style1";

        //if the connnection is available then run it and return the results
        $table = "";
        $activecallc =  "<b>Live Calls (0)</b>";

        if (!$fp) {
            $table = "<div align='center'>"."Connection to Event Socket failed"."<br /></div>";
        }
	    else {
		    //define js function call var
			$onhover_pause_refresh = " onmouseover='refresh_stop();' onmouseout='refresh_start();'";
			
			$activecallc =  "<b>Live Calls (" . count($rows) . ")"."</b>";
			$table .=  "<br>\n";

		    //show the results
			$table .=  "<div id='cmd_reponse'></div>\n";

			$table .=  "<table class='table table-striped table-bordered dataTable text-nowrap table-primary mb-1' width='100%' border='0' cellpadding='0' cellspacing='0'>\n";
			$table .=  "<thead>\n";
			$table .=  "<tr>\n";
			$table .=  "<th class='text-blue'>Profile</th>\n";
			$table .=  "<th class='text-blue'>Created</th>\n";
			
			$table .=  "<th class='text-blue'>Number</th>\n";
			$table .=  "<th class='text-blue'>Cid-name</th>\n";
			$table .=  "<th class='text-blue'>Cid-number</th>\n";
			$table .=  "<th class='text-blue'>Destination</th>\n";
			$table .=  "<th class='text-blue'>App</th>\n";
			$table .=  "<th class='text-blue'>Codec</th>\n";
			$table .=  "<th class='text-blue'>Secure</th>\n";
			$table .=  "<td class='list_control_icon'></td>\n";
			$table .=  "</tr>\n";
			$table .=  "</thead>\n";	
				
			foreach ($rows as &$row) {
				//set the php variables
                foreach ($row as $key => $value) {
                    $$key = $value;
                }
				
				//get the sip profile
                $name_array = explode("/", $name);
                $sip_profile = $name_array[1];
                $sip_uri = $name_array[2];

				//get the number
                $temp_array = explode("@", $sip_uri);
                $tmp_number = $temp_array[0];
                $tmp_number = str_replace("sip:", "", $tmp_number);

				//remove the '+' because it breaks the call recording
                $cid_num = str_replace("+", "", $cid_num);

				// reduce too long app data
                if(strlen($application_data) > 20) {
                    $application_data = substr($application_data, 0, 20) . ' <b>...</b>';
                }

				//send the html
                $table .=  "<tr>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$sip_profile."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$created."&nbsp;</td>\n";
                
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$tmp_number."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$cid_name."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$cid_num."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$dest."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".((strlen($application) > 0) ? $application.":".$application_data : null)."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$read_codec.":".$read_rate." / ".$write_codec.":".$write_rate."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$secure."&nbsp;</td>\n";
                $table .=  "<td class='list_control_icons' title = 'Hangup' style='width: 5px; text-align: left;'><a href='javascript:void(0);' alt='hangup' onclick=\"hangup(escape('".$uuid."'));\">".$v_link_label_delete."</a></td>\n";
                $table .=  "</tr>\n";
				
				//alternate the row style
				$c = ($c) ? 0 : 1;
			}
			$table .=  "</td>\n";
			$table .=  "</tr>\n";
			$table .=  "</table>\n";
	    }

		$data = ['table' => $table,'activecallc' => $activecallc];
        echo json_encode($data);
    }

    public function hangup(Request $request) {
 
	    if ($request->uuid != "") {
            $uuid = $request->uuid;

            $switch_cmd = "uuid_kill ".$uuid ; 

            $fp = SocketConnection::_event_socket_create();

            $json = SocketConnection::_event_socket_request($fp, 'api '.$switch_cmd);

		}

		return true;
	}
}
