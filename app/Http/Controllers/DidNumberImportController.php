<?php

namespace App\Http\Controllers;

use App\Http\Requests\DidNumberImportRequest;
use App\Imports\NumbersImport;
use App\Models\Country;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class DidNumberImportController extends Controller
{
     // import number view
     public function index(){
        $services = Service::get();
        $countries = Country::get();
        return view('did_numbers.import', compact('services', 'countries'));
    }

    // import number store
    public function importStore(DidNumberImportRequest $request){
        $import = new NumbersImport;
        
        try {
            Excel::import($import, $request->import_number);
            
        } catch (Exception $e) {        
            return redirect()->route('numbers.index')->with('danger', 'Duplicate entry or Somthing Wrong!');            
        }
       
        if($import->getRowCount() > 0){
            return redirect()->route('numbers.index')->with('success', 'Number imported successfully.');
        }else{
            return redirect()->route('numbers.index')->with('danger', 'Somthing Wrong!');
        }         
    }

    // download sample file
    public function fileDownload(){

        $path = public_path('\sample\Number_sample_file.csv');
    	$fileName = 'Number_sample_file.csv';
    	return Response::download($path, $fileName, ['Content-Type: application/csv']);
    
    }
}
