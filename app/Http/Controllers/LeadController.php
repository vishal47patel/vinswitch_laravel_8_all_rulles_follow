<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    //redirect to index page
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $leads = Lead::query()->orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $leads = $leads->where(function ($query) {
                $query->where(\DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%'.request('search').'%')
                      ->orWhere('phone', 'like', '%'.request('search').'%')
                      ->orWhere('email', 'like', '%'.request('search').'%');
            });
        }
        
        $leads = $leads->paginate($row); //display 10 records
        return view('leads.index',compact('leads'));    
    }

    public function import(Request $request)
    {
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        // Validate whether selected file is a CSV file
        if (!empty($_FILES['lead_file']['name']) && in_array($_FILES['lead_file']['type'], $csvMimes)) {

            $tmpName = $_FILES['lead_file']['tmp_name'];
            $head = ['first name','last name','email','country','tel_code','contact_no'];
           
            //check CSV file header
            $row = 1;
            $csvFile = file($tmpName);
            if($row == 1)
            {
                 // check there are no errors
                if($_FILES['lead_file']['error'] != 0)
                {
                    return redirect()->route('leads.index')->with('danger','There was a problem importing the file.');
                }   
                else
                {
                
                    $csv_filename = $_FILES['lead_file']['name']; 
                    $target_file = base_path(). "/public/uploads/" . $csv_filename;

                    if (move_uploaded_file($_FILES["lead_file"]["tmp_name"], $target_file)) 
                    {

                        DB::connection()->getPdo()->exec("DROP TABLE IF EXISTS tmp_import_leads;"); 
                        $leads_data = DB::connection()->getPdo()->exec('CREATE TABLE tmp_import_leads (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            `first_name` varchar(100) NULL,
                            `last_name` varchar(100) NULL,
                            `email` varchar(100) NULL,
                            `country` varchar(100) NULL,
                            `tel_code` varchar(100) NULL,
                            `contact_no` varchar(15) NULL

                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;');

                        $query = sprintf("LOAD DATA LOCAL INFILE '%s' REPLACE INTO TABLE tmp_import_leads FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' IGNORE 1 LINES 
                            (@col1,@col2,@col3,@col4,@col5,@col6) set first_name=@col1, last_name=@col2, email=@col3, country=@col4, tel_code=@col5,contact_no=@col6", addslashes($target_file)
                        );

                        $load_csv = DB::connection()->getPdo()->exec($query);
                    
                        $total_record = $load_csv;
                          
                        $contact_no = implode(',',(Lead::pluck('contact_no')->toArray()));

                        $insert_file = "INSERT INTO `leads` (
                            `contact_no`, `first_name`, `last_name`, `tel_code`, `email`, `country`
                        ) 
                        select
                            DISTINCT replace(
                                replace(contact_no, '-', ''),
                                ' ',
                                ''
                            ),
                            first_name,
                            last_name,
                            tel_code,
                            replace(email, 'N/A', NULL),
                            country 
                        from 
                            tmp_import_leads 
                        where 
                            (
                                LENGTH(contact_no) BETWEEN 10 AND 13
                                AND contact_no IS NOT NULL
                                and contact_no REGEXP '[A-Za-z0-9.,-]'
                                and contact_no Not like '%E%'";

                        if($contact_no != '')
                            $insert_file .= " and contact_no NOT IN (".$contact_no.")"; 

                        $insert_file .= ") ;"; 
                        DB::select($insert_file);

                        $counts = DB::select("SELECT COUNT(contact_no) as COUNT FROM `leads`;");

                        $success = $counts[0]->COUNT;

                        $failed = $total_record-$success;

                        unlink($target_file);


                        return redirect()->route('leads.index')->with('success','File Uploaded !! ' .$success.' Record inserted, ' .$failed.' Records Failed.');

                    }
               
                    else 
                    {
                        return redirect()->route('leads.index')->with('danger','Failed to upload file');
                    }        

            
                }

            }

        }

    }
    public function export()
    {
      
       $headers = [
      'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',   
      'Content-type'  => 'text/csv',   
      'Content-Disposition' => 'attachment; filename="leads.csv"',  
      'Expires' => '0',  
      'Pragma'  => 'public'
      ];
              
      $leads = DB::select("SELECT `first_name`,`last_name`,`email`,`country`,`tel_code`,`contact_no` FROM `leads`;");

      // if(isset($leads) && !empty($leads))
      // {
      //     $query = json_decode(json_encode($leads), true);

      //     # add headers for each column in the CSV download
      //     array_unshift($query, array_keys($query[0]));

      //     $callback = function() use ($query) {
      //     $FH = fopen('php://output', 'w');
      //       foreach ($query as $row) { 

      //         fputcsv($FH, $row);

      //       }
      //     fclose($FH);
      //     };

      //     return response()->stream($callback, 200, $headers);
      // }
      // else
      // {
      //   return redirect()->route('leads.index')->with('danger','Nothing to export');
      // }

    }
}
