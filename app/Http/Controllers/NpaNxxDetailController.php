<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\NpaNxxDetail;
use App\Models\NpaNxxMaster;
use App\Http\Requests\NpaNxxDetailImportRequest;

class NpaNxxDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $NpaNxxDetail = NpaNxxDetail::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $NpaNxxDetail = $NpaNxxDetail->search(request('search'), null, true, true)->distinct();
        }

        $operationPermission = [
            'import' => hasPermission(['npa_nxx_detail_list','npa_nxx_detail_import']),
            'delete' => hasPermission(['npa_nxx_detail_list','npa_nxx_detail_delete'])
        ];
        $NpaNxxDetail = $NpaNxxDetail->paginate($row); //display 10 records
        return view('NpaNxxDetail.index',compact('NpaNxxDetail', 'operationPermission'));    
    }
   
    public function import(Request $request,$id)
    {
        return view('NpaNxxDetail.import',compact('id'));
    }
   
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NpaNxxDetailImportRequest $request,$id)
    {
        $tmpName = $_FILES['lead_file']['tmp_name'];

        $row = 1;
        $success = 0;
        $error = 0;

        if (($handle = fopen($tmpName, 'r')) !== FALSE) {
           
            while (($data = fgetcsv($handle, 10000, "\t")) !== FALSE) {
                
                if ($row > 1) {
                    $newmodel = new NpaNxxDetail;
                    $newmodel->state = $data[0];
                    $newmodel->npanxx = $data[1];
                    $newmodel->lata = $data[2];
                    $newmodel->zipcode = $data[3];
                    $newmodel->zipcode_count = $data[4];
                    $newmodel->zipcode_freq = $data[5];
                    $newmodel->npa = $data[6];
                    $newmodel->nxx = $data[7];
                    $newmodel->flags = $data[8];
                    $newmodel->npanxx_id = $id;
                    if (($newmodel->state != '')) {

                        if ($newmodel->save()) {
                            $success++;
                        } else {
                            $error++;
                        }
                    } else {
                        $error++;
                    }
                }
                $row++;
            }
        }

        return redirect()->route('NpaNxxDetail.index',$id)
        ->with('success','NpaNxxDetail import successfully');

    }
    public function downloadfile()
    {
        $filepath = public_path('sample/npanxx-Detail_sample_file.csv');
        return response()->download($filepath);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $NpaNxxDetail = NpaNxxDetail::find($id)->delete();
        return redirect()->route('npaNxxMaster.index')
                        ->with('success','NpaNxxDetail deleted successfully');
    }
}
