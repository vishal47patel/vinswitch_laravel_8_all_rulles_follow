<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SofiaRate;
use App\Models\SofiaRateplan; 
use App\Models\FailedRateFiles;   
use App\Http\Requests\SofiaRateStoreRequest;
use App\Http\Requests\SofiaRateImportRequest;
use Illuminate\Support\Facades\DB;

class SofiaRateController extends Controller
{
    public function index($id)
    {    
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $SofiaRates = SofiaRate::where('plan_id','=',$id)->orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $SofiaRates = $SofiaRates->search(request('search'), null, true, true)->distinct();
        }

        $SofiaRates = $SofiaRates->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['termination_rate_list','termination_rate_create']),
            'update' => hasPermission(['termination_rate_list','termination_rate_update']),
            'delete' => hasPermission(['termination_rate_list','termination_rate_delete'])
        ]; 

        $FailedRateFiles = FailedRateFiles::where('rateplan_id','=',$id)->orderBy('id', 'DESC')->get();

        $sofiarateplan = SofiaRateplan::where('id','=',$id)->first();

        return view('sofiaRate.index',compact('SofiaRates', 'operationPermission', 'FailedRateFiles','sofiarateplan'));
    }

    public function create($id)
    {
        $SofiaRate = SofiaRate::get();
        $sofiarateplan = SofiaRateplan::where('id',$id)->first();
        return view('sofiaRate.create',compact('SofiaRate','sofiarateplan'));
    }

    public function store(SofiaRateStoreRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);

        if($request->sale_percentage != "")
        {
            $sale_rate = bcdiv(($request->buy_rate * $request->sale_percentage) , 100,5);
            $input['sale_rate'] = bcadd($request->buy_rate, $sale_rate,5);
            $input['plan_id'] = $id;
        }

        SofiaRate::create($input);

        return redirect()->route('sofiaRate.index',$id)->with('success','Rate has been created successfully!');
    }
    public function edit($id)
    {   
        $sofiarate = SofiaRate::findorfail($id);
        $sofiarateplan = SofiaRateplan::where('status','=','ACTIVE')->where('id','=', $sofiarate->plan_id)->first();
        return view('sofiaRate.edit',compact('sofiarate','sofiarateplan'));
        
    }

    public function update(SofiaRateStoreRequest $request,$id)
    {
        $sofiarate = SofiaRate::where('id',$id)->first();
        $input = $request->except(['_token','_method']);
        if($request->sale_percentage != "")
        {
            $sale_rate = bcdiv(($request->buy_rate * $request->sale_percentage) , 100,5);
            $input['sale_rate'] = bcadd($request->buy_rate, $sale_rate,5);
            $input['plan_id'] = $sofiarate->plan_id;
        }

        $sofiarate->update($input);

        return redirect()->route('sofiaRate.index',$sofiarate->plan_id)->with('success','Rate plan has been updated successfully!');
       
    }

    public function destroy($id)
    {    
        $sofiarates = SofiaRate::findorfail($id);
        $SofiaRate = SofiaRate::where('id','=',$id)->delete();
        return redirect()->route('sofiaRate.index',$sofiarates->plan_id)->with('success','Rate plan has been deleted successfully');
    }

    public function import($id)
    {    
        $sofiarateplan = SofiaRateplan::where('id',$id)->first();
        return view('sofiaRate.import',compact('sofiarateplan'));
    }

    public function rate_import(SofiaRateImportRequest $request,$id)
    {  
        
        $sofiarates = SofiaRate::where('plan_id','=',$id)->first();
        $sale_percentage = $request->sale_percentage;

        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['import_csv']['name']) && in_array($_FILES['import_csv']['type'], $csvMimes)) {

            $tmpName = $_FILES['import_csv']['tmp_name'];
            $head = ['code','description','buy rate'];
           
            //check CSV file header
            $row = 1;
            $csvFile = file($tmpName);
            if($row == 1)
            {
                 // check there are no errors
                if($_FILES['import_csv']['error'] != 0)
                {
                    return redirect()->route('sofiaRate.index',$sofiarates->plan_id)->with('danger','There was a problem importing the file.');
                }   
                else
                {
                
                    $csv_filename = $_FILES['import_csv']['name']; 
                    $target_file = base_path(). "/public/rate_file/" . $csv_filename;

                    if (move_uploaded_file($_FILES["import_csv"]["tmp_name"], $target_file)) 
                    {

                        DB::connection()->getPdo()->exec("DROP TABLE IF EXISTS tmp_import_rateplan;"); 
                        $rate_data = DB::connection()->getPdo()->exec('CREATE TABLE tmp_import_rateplan (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            `code` varchar(20) NULL,
                            `description` varchar(100) NULL,
                            `buy_rate` decimal(10,2) NULL

                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;');

                        $query = sprintf("LOAD DATA LOCAL INFILE '%s' REPLACE INTO TABLE tmp_import_rateplan FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' IGNORE 1 LINES 
                            (@col1,@col2,@col3) set code=@col1, description=@col2, buy_rate=@col3", addslashes($target_file)
                        );

                        $load_csv = DB::connection()->getPdo()->exec($query);
                    
                        $total_record = $load_csv;
                          
                        $insert_file = "INSERT INTO `sofia_rate` (
                            `plan_id`, `code`, `description`, `buy_rate`,`sale_percentage`
                        ) 
                        select
                            $sofiarates->plan_id,
                            code,
                            description,
                            buy_rate,
                            $sale_percentage 
                        from 
                            tmp_import_rateplan;"; 

                        DB::select($insert_file);

                        unlink($target_file);


                        return redirect()->route('sofiaRate.index',$sofiarates->plan_id)->with('success','Rate plan has been uploaded successfully');

                    }
               
                    else 
                    {
                        return redirect()->route('sofiaRate.index',$sofiarates->plan_id)->with('danger','Failed to upload file');
                    }        

            
                }

            }

        }
    }

    public function downloadsampleFile()
    {    
        ob_clean();
        $filePath = public_path("/docs/rate_sample_file.csv");
        $headers = array('Content-Encoding: UTF-8','Content-Type: text/csv');
        $fileName = 'Rate_sample_file'.'.csv';
        return response()->download($filePath, $fileName, $headers);
    }

    public function rate_export()
    {    
        $headers = [
      'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',   
      'Content-type'  => 'text/csv',   
      'Content-Disposition' => 'attachment; filename="sofiarate.csv"',  
      'Expires' => '0',  
      'Pragma'  => 'public'
      ];
              
      $sofiarates = DB::select("SELECT `code`,`description`,`buy_rate` FROM `sofia_rate`;");

      if(isset($sofiarates) && !empty($sofiarates))
      {
          $query = json_decode(json_encode($sofiarates), true);

          # add headers for each column in the CSV download
          array_unshift($query, array_keys($query[0]));

          $callback = function() use ($query) {
          $FH = fopen('php://output', 'w');
            foreach ($query as $row) { 

              fputcsv($FH, $row);

            }
          fclose($FH);
          };

          return response()->stream($callback, 200, $headers);
      }
    }

    public function downloadFailedCsv($id)
    {

    }

    public function deleteFailedCsv($id)
    {
        $file = FailedRateFiles::select('rateplan_id')->where('id','=',$id)->first();
        $FailedRateFiles = FailedRateFiles::where('id','=',$id)->delete();
        return redirect()->route('sofiaRate.index',$file->rateplan_id)->with('success','Failed Rate plan file has been deleted successfully');
    }
}
