<?php

namespace App\Http\Controllers;

use App\Http\Requests\DidNumberImportRequest;
use App\Http\Requests\DidNumberStoreRequest;
use App\Http\Requests\DidNumberUpdateRequest;
use App\Models\DidNumber;
use App\Models\Service;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DidNumberController extends Controller
{
    // number list page
    public function index(Request $request)
    {
        $row = 10;
        if (request('row') != '')
            $row = request('row');

        $dids = DidNumber::orderBy('id', 'DESC');

        if (request('search') != '') {
            $dids = $dids->search(request('search'), null, true, true)->distinct();
        }
        
        $dids = $this->getSearch($dids);
        $dids = $dids->paginate($row);

        $operationPermission = [
            'create' => hasPermission(['did_number_list', 'did_number_create']),
            'update' => hasPermission(['did_number_list', 'did_number_update']),
            'delete' => hasPermission(['did_number_list', 'did_number_delete'])
        ];

        $services = Service::get();
        $countries = Country::get();

        return view('did_numbers.index', compact('dids', 'operationPermission', 'services', 'countries'));
    }

    // number create page
    public function create()
    {
        $services = Service::get();
        $countries = Country::get();
        return view('did_numbers.create', compact('services', 'countries'));
    }

    // number create
    public function store(DidNumberStoreRequest $request)
    {       
        unset($request['_token']);
        $input = $request->all();
        $input['sms_capable'] = (isset($input['sms_capable']) && $input['sms_capable'] == 'YES') ? 'YES' : 'NO';
        DidNumber::create($input);
        return redirect()->route('numbers.index')->with('success', 'Number created successfully.');
    }
    // number edit page
    public function edit($id, DidNumber $didNumber)
    {
        $did = $didNumber->find($id);        
        if (empty($did)) {           
            return redirect()->route('numbers.index')->with('danger', 'Somthing Wrong!');
        }
        $services = Service::get();
        $countries = Country::get();
        return view('did_numbers.edit', compact('did', 'services', 'countries'));
    }

    // number update
    public function update($id, DidNumberUpdateRequest $request, DidNumber $didNumber)
    {
        unset($request['_token']);
        $input = $request->all();
        $input['sms_capable'] = (isset($input['sms_capable']) && $input['sms_capable'] == 'YES') ? 'YES' : 'NO';
        $didNumber->where('id', $id)->update($input);
        return redirect()->route('numbers.index')
            ->with('success', 'Number updated successfully');
    }

    // delete number
    public function destroy($id, DidNumber $didNumber)
    {
        $did = $didNumber->find($id);        
        if (empty($did)) {           
            return redirect()->route('numbers.index')->with('danger', 'Somthing Wrong!');
        }
        $did->delete();
        return redirect()->route('numbers.index')
                        ->with('success','Number deleted successfully');
    }

    // get state - selected country's states
    public function getStates($id)
    {
        $data['states'] = [];
        $data['states'] = State::where('Country', $id)->get();
        return $data;
    }

    // get cities - selected state's cities
    public function getCities($id)
    {
        $data['cities'] = [];
        $data['cities'] = City::where('state_id', $id)->get();
        return $data;
    }

    // Number listing page update status and sms capable
    public function actionUpdatestatus($id, $column, $value = '', DidNumber $didNumber, Request $request)
    {
        $did_number = $didNumber->find($id);
        if (empty($did_number)) {           
            return redirect()->route('numbers.index')->with('danger', 'Somthing Wrong!');
        }
        $role = Auth::user()->role;
        if ($did_number) {
            if ($role == 'ADMIN') {
                if ($column == 'sms_capable') {
                    $did_number->sms_capable = ($value == "YES") ? "NO" : "YES";
                    $column = "Sms Capability";
                } else if ($column == 'status') {
                    $did_number->status = ($value == "ALLOCATED") ? "PORT OUT" : $did_number->status;
                    $column = 'Status';
                }

                if ($did_number->save()) {
                    return redirect()->route('numbers.index')
                        ->with('success', $column . ' updated successfully');
                }
            } else {
                $msg = 'Unauthorized';
                return redirect()->route('numbers.index')
                    ->with('danger', 'Status not updated');
            }
        }
    }

    // search 
    private function getSearch($query)
    {
        if (request('number_did') != '')
            $query = $query->where('number_did', 'like', '%' . request('number_did') . '%');

        if (request('number_service_type') != '')
            $query = $query->where('number_service_type', 'like', '%' . request('number_service_type') . '%');

        if (request('number_channel_limit') != '')
            $query = $query->where('number_channel_limit', 'like', '%' . request('number_channel_limit') . '%');

        if (request('number_country') != '')
            $query = $query->where('number_country', 'like', '%' . request('number_country') . '%');

        if (request('number_state') != '')
            $query = $query->where('number_state', 'like', '%' . request('number_state') . '%');

        if (request('number_area') != '')
            $query = $query->where('number_area', 'like', '%' . request('number_area') . '%');

        if (request('number_description') != '')
            $query = $query->where('number_description', 'like', '%' . request('number_description') . '%');

        return $query;
    }
}
