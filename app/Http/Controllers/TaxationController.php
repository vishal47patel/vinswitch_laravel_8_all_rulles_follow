<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxation;
use App\Http\Requests\TaxationStoreRequest;
use App\Http\Requests\TaxationUpdateRequest;

class TaxationController extends Controller
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

        $taxations = Taxation::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $taxations = $taxations->search(request('search'), null, true, true)->distinct();
        }

        $taxations = $this->getSearch($taxations);  

        $taxations = $taxations->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['taxation_list','taxation_create']),
            'update' => hasPermission(['taxation_list','taxation_update']),
            'delete' => hasPermission(['taxation_list','taxation_delete'])
        ];
        
        return view('taxation.index',compact('taxations', 'operationPermission'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taxation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxationStoreRequest $request)
    {
        $input = $request->all();
        $taxations = Taxation::create($input);
        return redirect()->route('taxation.index')->with('success','taxation created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taxations = Taxation::findorfail($id);
        return view('taxation.edit',compact('taxations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaxationUpdateRequest $request, $id)
    {
        $taxations = Taxation::where('id', $id)->first();
        $taxations->name = $request->name;
        $taxations->rate = $request->rate;
        $taxations->update();
        
        return redirect()->route('taxation.index')
                        ->with('success','taxations updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taxations = Taxation::find($id)->delete();
        return redirect()->route('taxation.index')
                        ->with('success','taxation deleted successfully');
    }
    private function getSearch($query)
    {
        if ( request('name') != '' )
        $query = $query->where('name', 'like', '%'.request('name').'%');

        if ( request('rate') != '' )
        $query = $query->where('rate', 'like', '%'.request('rate').'%');

        return $query; 
    }
}
