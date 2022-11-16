<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderSummary;
use App\Models\Order;
use App\Models\Tenant;

class OrderController extends Controller
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

        $orders = Order::orderBy('id', 'DESC');
     
        if (request('search') != '') {
            $orders = $orders->search(request('search'), null, true, true)->distinct();
        }

        $orders = $this->getSearch($orders);  
        $users = Tenant::getActiveUser();

       if(isset($_GET['end_date']))
       {
            $orders->end_date = $_GET['end_date'];
       }	

        $orders = $orders->paginate($row); //display 10 records
    
        return view('order.index',compact('orders','users'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $orders = Order::findorfail($id);
        $summary = OrderSummary::findorfail($id);
        return view('order.show',compact('orders','summary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function getSearch($query)
    {
        if(request('datetime')  > 0 || request('end_date') > 0)
        {
            $from_date = request('datetime');
            $to_date = request('end_date');
            $query = $query->whereBetween('datetime', [$from_date, $to_date]);
        }

        if ( request('tenant_account_no') != '' )
        $query = $query->where('tenant_account_no', 'like', '%'.request('tenant_account_no').'%');

        if ( request('type') != '' )
        $query = $query->where('type', 'like', '%'.request('type').'%');

        if ( request('status') != '' )
        $query = $query->where('status', 'like', '%'.request('status').'%');

        return $query; 
    }
}
